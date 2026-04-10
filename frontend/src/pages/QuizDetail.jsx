import React, { useState, useEffect, useRef } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import { quizzesAPI } from '../utils/api';
import LoadingSpinner from '../components/LoadingSpinner';

const QuizDetail = () => {
  const { id }     = useParams();
  const navigate   = useNavigate();

  // États principaux
  const [quiz, setQuiz]           = useState(null);
  const [phase, setPhase]         = useState('info');   // info | playing | result
  const [attempt, setAttempt]     = useState(null);
  const [questions, setQuestions] = useState([]);
  const [answers, setAnswers]     = useState({});       // { questionId: selectedAnswer }
  const [current, setCurrent]     = useState(0);
  const [result, setResult]       = useState(null);
  const [loading, setLoading]     = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError]         = useState(null);

  // Timer
  const [timeLeft, setTimeLeft]   = useState(null);
  const timerRef                  = useRef(null);

  useEffect(() => {
    quizzesAPI.getById(id)
      .then((res) => setQuiz(res.data))
      .catch(() => setError('Quiz introuvable.'))
      .finally(() => setLoading(false));
  }, [id]);

  // Démarrer le timer si time_limit défini
  useEffect(() => {
    if (phase === 'playing' && quiz?.time_limit) {
      setTimeLeft(quiz.time_limit * 60);
      timerRef.current = setInterval(() => {
        setTimeLeft((t) => {
          if (t <= 1) {
            clearInterval(timerRef.current);
            handleSubmit(true);
            return 0;
          }
          return t - 1;
        });
      }, 1000);
    }
    return () => clearInterval(timerRef.current);
  }, [phase]);

  const formatTime = (s) =>
    `${String(Math.floor(s / 60)).padStart(2, '0')}:${String(s % 60).padStart(2, '0')}`;

  const handleStart = async () => {
    setLoading(true);
    try {
      const res = await quizzesAPI.start(id);
      setAttempt(res.data.attempt_id);
      setQuestions(res.data.questions);
      setPhase('playing');
    } catch (err) {
      setError(err.response?.data?.error || 'Impossible de démarrer le quiz.');
    } finally {
      setLoading(false);
    }
  };

  const handleAnswer = (questionId, answer) => {
    setAnswers((prev) => ({ ...prev, [questionId]: answer }));
  };

  const handleSubmit = async (forced = false) => {
    clearInterval(timerRef.current);
    const payload = questions.map((q) => ({
      question_id:     q.id,
      selected_answer: answers[q.id] || '',
    }));

    setSubmitting(true);
    try {
      const res = await quizzesAPI.submitAttempt(attempt, { answers: payload });
      setResult(res.data);
      setPhase('result');
    } catch (err) {
      setError(err.response?.data?.error || 'Erreur lors de la soumission.');
    } finally {
      setSubmitting(false);
    }
  };

  const answeredCount = Object.keys(answers).length;
  const progress = questions.length > 0 ? (answeredCount / questions.length) * 100 : 0;

  if (loading) return <LoadingSpinner message="Chargement du quiz..." />;
  if (error) return (
    <div className="card text-center py-12 max-w-xl mx-auto">
      <div className="text-5xl mb-4">⚠️</div>
      <h2 className="text-xl font-bold mb-2 text-red-600">{error}</h2>
      <Link to="/quizzes" className="btn-primary mt-4 inline-block">Retour aux quiz</Link>
    </div>
  );

  // ── Phase INFO ──────────────────────────────────────────────────────────────
  if (phase === 'info') return (
    <div className="max-w-2xl mx-auto">
      <div className="card space-y-6">
        <h1 className="text-2xl font-bold text-gray-900">{quiz.title}</h1>
        {quiz.series && (
          <span className="inline-block bg-blue-100 text-blue-700 text-sm px-3 py-1 rounded-full">
            📺 {quiz.series.title}
          </span>
        )}
        {quiz.description && <p className="text-gray-600">{quiz.description}</p>}

        <div className="grid grid-cols-2 gap-4 bg-gray-50 rounded-lg p-4">
          <div className="text-center">
            <div className="text-2xl font-bold text-blue-600">{quiz.questions?.length || '?'}</div>
            <div className="text-sm text-gray-500">Questions</div>
          </div>
          <div className="text-center">
            <div className="text-2xl font-bold text-green-600">{quiz.passing_score}%</div>
            <div className="text-sm text-gray-500">Score requis</div>
          </div>
          {quiz.time_limit && (
            <div className="text-center col-span-2">
              <div className="text-2xl font-bold text-orange-500">{quiz.time_limit} min</div>
              <div className="text-sm text-gray-500">Limite de temps</div>
            </div>
          )}
        </div>

        <div className="flex gap-4">
          <button onClick={handleStart} className="btn-primary flex-1">
            🚀 Démarrer le quiz
          </button>
          <Link to="/quizzes" className="btn-secondary flex-1 text-center">
            Annuler
          </Link>
        </div>
      </div>
    </div>
  );

  // ── Phase PLAYING ───────────────────────────────────────────────────────────
  if (phase === 'playing') {
    const q = questions[current];
    return (
      <div className="max-w-2xl mx-auto space-y-4">
        {/* Header */}
        <div className="card flex items-center justify-between py-3">
          <span className="text-sm font-medium text-gray-600">
            Question {current + 1} / {questions.length}
          </span>
          {timeLeft !== null && (
            <span className={`font-mono font-bold text-lg ${timeLeft < 60 ? 'text-red-600 animate-pulse' : 'text-gray-700'}`}>
              ⏱ {formatTime(timeLeft)}
            </span>
          )}
          <span className="text-sm text-gray-500">{answeredCount} répondu{answeredCount > 1 ? 's' : ''}</span>
        </div>

        {/* Barre de progression */}
        <div className="w-full bg-gray-200 rounded-full h-2">
          <div
            className="bg-blue-500 h-2 rounded-full transition-all duration-300"
            style={{ width: `${progress}%` }}
          />
        </div>

        {/* Question */}
        <div className="card space-y-4">
          <h2 className="text-lg font-semibold text-gray-900">{q.question}</h2>

          <div className="space-y-3">
            {q.options.map((option, i) => {
              const selected = answers[q.id] === option;
              return (
                <button
                  key={i}
                  onClick={() => handleAnswer(q.id, option)}
                  className={`w-full text-left p-4 rounded-lg border-2 transition-all ${
                    selected
                      ? 'border-blue-500 bg-blue-50 text-blue-800 font-medium'
                      : 'border-gray-200 hover:border-gray-400 hover:bg-gray-50'
                  }`}
                >
                  <span className="font-mono text-gray-400 mr-3">
                    {String.fromCharCode(65 + i)}.
                  </span>
                  {option}
                </button>
              );
            })}
          </div>
        </div>

        {/* Navigation */}
        <div className="flex justify-between gap-4">
          <button
            onClick={() => setCurrent(c => Math.max(0, c - 1))}
            disabled={current === 0}
            className="btn-secondary disabled:opacity-40"
          >
            ← Précédent
          </button>

          {current < questions.length - 1 ? (
            <button
              onClick={() => setCurrent(c => c + 1)}
              className="btn-primary"
            >
              Suivant →
            </button>
          ) : (
            <button
              onClick={() => handleSubmit()}
              disabled={submitting || answeredCount < questions.length}
              className="btn-primary disabled:opacity-40"
              title={answeredCount < questions.length ? 'Répondez à toutes les questions' : ''}
            >
              {submitting ? 'Envoi...' : '✅ Terminer le quiz'}
            </button>
          )}
        </div>

        {/* Dots de navigation */}
        <div className="flex flex-wrap gap-2 justify-center">
          {questions.map((q, i) => (
            <button
              key={i}
              onClick={() => setCurrent(i)}
              className={`w-8 h-8 rounded-full text-xs font-bold transition-all ${
                i === current
                  ? 'bg-blue-600 text-white scale-110'
                  : answers[q.id]
                  ? 'bg-green-400 text-white'
                  : 'bg-gray-200 text-gray-600 hover:bg-gray-300'
              }`}
            >
              {i + 1}
            </button>
          ))}
        </div>
      </div>
    );
  }

  // ── Phase RESULT ────────────────────────────────────────────────────────────
  if (phase === 'result') return (
    <div className="max-w-lg mx-auto">
      <div className="card text-center space-y-6">
        <div className="text-6xl">{result.passed ? '🏆' : '😔'}</div>
        <h2 className="text-2xl font-bold">
          {result.passed ? 'Quiz réussi !' : 'Quiz échoué'}
        </h2>

        <div className="grid grid-cols-2 gap-4">
          <div className={`rounded-lg p-4 ${result.passed ? 'bg-green-50' : 'bg-red-50'}`}>
            <div className={`text-3xl font-bold ${result.passed ? 'text-green-600' : 'text-red-600'}`}>
              {result.percentage}%
            </div>
            <div className="text-sm text-gray-500">Score obtenu</div>
          </div>
          <div className="bg-gray-50 rounded-lg p-4">
            <div className="text-3xl font-bold text-gray-700">{result.passing_score}%</div>
            <div className="text-sm text-gray-500">Score requis</div>
          </div>
          <div className="bg-blue-50 rounded-lg p-4">
            <div className="text-3xl font-bold text-blue-600">{result.correct_answers}</div>
            <div className="text-sm text-gray-500">Bonnes réponses</div>
          </div>
          <div className="bg-gray-50 rounded-lg p-4">
            <div className="text-3xl font-bold text-gray-700">{result.total_questions}</div>
            <div className="text-sm text-gray-500">Total questions</div>
          </div>
        </div>

        <div className="flex gap-4 justify-center">
          <button
            onClick={() => { setPhase('info'); setAnswers({}); setCurrent(0); setResult(null); }}
            className="btn-secondary"
          >
            🔄 Recommencer
          </button>
          <Link to="/quizzes" className="btn-primary">Autres quiz</Link>
        </div>
      </div>
    </div>
  );
};

export default QuizDetail;
