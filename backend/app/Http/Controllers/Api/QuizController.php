<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAttempt;
use App\Models\QuizAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with(['series', 'creator'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return response()->json($quizzes);
    }

    public function show($id)
    {
        $quiz = Quiz::with(['questions.options', 'series', 'creator'])
            ->where('is_active', true)
            ->findOrFail($id);

        return response()->json($quiz);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'series_id' => 'nullable|exists:series,id',
            'time_limit' => 'nullable|integer|min:1',
            'passing_score' => 'required|integer|min:0|max:100',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.correct_answer' => 'required|string',
            'questions.*.points' => 'required|integer|min:1',
            'questions.*.explanation' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $quiz = Quiz::create([
                'title' => $request->title,
                'description' => $request->description,
                'series_id' => $request->series_id,
                'created_by' => auth('api')->id(),
                'time_limit' => $request->time_limit,
                'passing_score' => $request->passing_score,
                'is_active' => true,
            ]);

            $totalPoints = 0;
            foreach ($request->questions as $index => $questionData) {
                // Validate that correct_answer exists in options
                if (!in_array($questionData['correct_answer'], $questionData['options'])) {
                    DB::rollback();
                    return response()->json(['error' => 'Correct answer must be one of the options'], 400);
                }

                QuizQuestion::create([
                    'quiz_id' => $quiz->id,
                    'question' => $questionData['question'],
                    'options' => $questionData['options'],
                    'correct_answer' => $questionData['correct_answer'],
                    'points' => $questionData['points'],
                    'explanation' => isset($questionData['explanation']) ? $questionData['explanation'] : null,
                    'order' => $index,
                ]);
                
                $totalPoints += $questionData['points'];
            }

            DB::commit();

            return response()->json($quiz->load('questions'), 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to create quiz: ' . $e->getMessage()], 500);
        }
    }

    public function start($id)
    {
        $quiz = Quiz::findOrFail($id);

        if (!$quiz->is_active) {
            return response()->json(['error' => 'Quiz is not active'], 400);
        }

        $existingAttempt = QuizAttempt::where('quiz_id', $id)
            ->where('user_id', auth('api')->id())
            ->whereNull('completed_at')
            ->first();

        if ($existingAttempt) {
            return response()->json(['error' => 'You already have an active attempt'], 400);
        }

        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth('api')->id(),
            'started_at' => now(),
        ]);

        // Return quiz questions without correct answers
        $questions = $quiz->questions->map(function ($question) {
            return [
                'id' => $question->id,
                'question' => $question->question,
                'options' => $question->options,
                'points' => $question->points,
                'order' => $question->order,
            ];
        });

        return response()->json([
            'attempt_id' => $attempt->id,
            'quiz' => [
                'id' => $quiz->id,
                'title' => $quiz->title,
                'description' => $quiz->description,
                'time_limit' => $quiz->time_limit,
                'total_points' => $quiz->questions->sum('points'),
                'question_count' => $quiz->questions->count(),
            ],
            'questions' => $questions,
            'started_at' => $attempt->started_at,
        ]);
    }

    public function submit(Request $request, $id)
    {
        $attempt = QuizAttempt::where('id', $id)
            ->where('user_id', auth('api')->id())
            ->whereNull('completed_at')
            ->firstOrFail();

        $quiz = $attempt->quiz;

        $request->validate([
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|exists:quiz_questions,id',
            'answers.*.selected_answer' => 'required|string',
        ]);

        // Check if time limit exceeded
        if ($quiz->time_limit) {
            $timeElapsed = Carbon::now()->diffInMinutes($attempt->started_at);
            if ($timeElapsed > $quiz->time_limit) {
                return response()->json(['error' => 'Time limit exceeded'], 400);
            }
        }

        try {
            DB::beginTransaction();

            $totalScore = 0;
            $totalPoints = 0;
            $correctAnswers = 0;
            $totalQuestions = count($request->answers);

            foreach ($request->answers as $answerData) {
                $question = QuizQuestion::findOrFail($answerData['question_id']);
                
                $isCorrect = $answerData['selected_answer'] === $question->correct_answer;
                $pointsEarned = $isCorrect ? $question->points : 0;
                
                QuizAnswer::create([
                    'attempt_id' => $attempt->id,
                    'question_id' => $answerData['question_id'],
                    'selected_answer' => $answerData['selected_answer'],
                    'is_correct' => $isCorrect,
                    'points_earned' => $pointsEarned,
                ]);
                
                $totalScore += $pointsEarned;
                $totalPoints += $question->points;
                if ($isCorrect) {
                    $correctAnswers++;
                }
            }

            $percentage = $totalPoints > 0 ? ($totalScore / $totalPoints) * 100 : 0;
            $passed = $percentage >= $quiz->passing_score;

            $attempt->update([
                'completed_at' => now(),
                'score' => $totalScore,
                'total_points' => $totalPoints,
                'passed' => $passed,
            ]);

            DB::commit();

            return response()->json([
                'message' => $passed ? 'Quiz passed!' : 'Quiz failed',
                'score' => $totalScore,
                'total_points' => $totalPoints,
                'percentage' => round($percentage, 2),
                'correct_answers' => $correctAnswers,
                'total_questions' => $totalQuestions,
                'passed' => $passed,
                'passing_score' => $quiz->passing_score,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => 'Failed to submit quiz'], 500);
        }
    }

    public function results($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);

        // Only creator can view detailed results
        if ($quiz->created_by !== auth('api')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $attempts = $quiz->attempts()->with('user')->get();
        
        $statistics = [
            'total_attempts' => $attempts->count(),
            'average_score' => $attempts->avg('score'),
            'pass_rate' => $attempts->count() > 0 ? ($attempts->where('passed', true)->count() / $attempts->count()) * 100 : 0,
            'highest_score' => $attempts->max('score'),
            'lowest_score' => $attempts->min('score'),
        ];

        return response()->json([
            'quiz' => $quiz,
            'statistics' => $statistics,
            'attempts' => $attempts->map(function ($attempt) {
                return [
                    'id' => $attempt->id,
                    'user' => $attempt->user->name,
                    'score' => $attempt->score,
                    'total_points' => $attempt->total_points,
                    'percentage' => $attempt->total_points > 0 ? round(($attempt->score / $attempt->total_points) * 100, 2) : 0,
                    'passed' => $attempt->passed,
                    'started_at' => $attempt->started_at,
                    'completed_at' => $attempt->completed_at,
                ];
            })
        ]);
    }
}