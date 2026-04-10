<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\SurveyQuestion;
use App\Models\SurveyResponse;
use App\Models\SurveyAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::with(['questions', 'creator'])
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                      ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')
                      ->orWhere('ends_at', '>=', now());
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($surveys);
    }

    public function show($id)
    {
        $survey = Survey::with(['questions.options', 'creator'])
            ->where('is_active', true)
            ->findOrFail($id);

        // Check if survey is currently active
        if (!$survey->isActive()) {
            return response()->json(['error' => 'Survey is not currently active'], 404);
        }

        return response()->json($survey);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starts_at' => 'nullable|date',
            'ends_at' => 'nullable|date|after:starts_at',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.type' => 'required|in:multiple_choice,text,rating',
            'questions.*.options' => 'required_if:questions.*.type,multiple_choice|array',
            'questions.*.is_required' => 'boolean',
        ]);

        try {
            DB::beginTransaction();

            $survey = Survey::create([
                'title' => $request->title,
                'description' => $request->description,
                'created_by' => auth('api')->id(),
                'starts_at' => $request->starts_at,
                'ends_at' => $request->ends_at,
                'is_active' => true,
            ]);

            foreach ($request->questions as $index => $questionData) {
                SurveyQuestion::create([
                    'survey_id' => $survey->id,
                    'question' => $questionData['question'],
                    'type' => $questionData['type'],
                    'options' => isset($questionData['options']) ? $questionData['options'] : null,
                    'is_required' => isset($questionData['is_required']) ? $questionData['is_required'] : true,
                    'order' => $index,
                ]);
            }

            DB::commit();

            return response()->json($survey->load('questions'), 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to create survey'], 500);
        }
    }

    public function submit(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);

        if (!$survey->isActive()) {
            return response()->json(['error' => 'Survey is not active'], 400);
        }

        $request->validate([
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:survey_questions,id',
            'answers.*.answer' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $response = SurveyResponse::create([
                'survey_id' => $survey->id,
                'user_id' => auth('api')->id(),
                'ip_address' => $request->ip(),
            ]);

            foreach ($request->answers as $answerData) {
                SurveyAnswer::create([
                    'response_id' => $response->id,
                    'question_id' => $answerData['question_id'],
                    'answer' => $answerData['answer'],
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Survey submitted successfully',
                'response_id' => $response->id
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to submit survey'], 500);
        }
    }

    public function results($id)
    {
        $survey = Survey::with('questions.answers')->findOrFail($id);

        // Only creator can view results
        if ($survey->created_by !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $results = [];
        foreach ($survey->questions as $question) {
            $answers = $question->answers->pluck('answer')->toArray();
            $results[] = [
                'question' => $question->question,
                'type' => $question->type,
                'total_responses' => count($answers),
                'answers' => array_count_values($answers)
            ];
        }

        return response()->json([
            'survey' => $survey,
            'results' => $results,
            'total_participants' => $survey->responses()->count()
        ]);
    }
}