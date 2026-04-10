import React, { useState, useEffect } from 'react';
import { useSelector } from 'react-redux';
import { surveysAPI } from '../utils/api';
import LoadingSpinner from '../components/LoadingSpinner';

const SurveyQuestion = ({ question, value, onChange }) => {
  if (question.type === 'multiple_choice') {
    return (
      <div className="space-y-2">
        {question.options?.map((option, i) => (
          <label key={i} className={`flex items-center gap-3 p-3 rounded-lg border-2 cursor-pointer transition ${
            value === option ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300'
          }`}>
            <input
              type="radio"
              name={`q-${question.id}`}
              value={option}
              checked={value === option}
              onChange={() => onChange(option)}
              className="accent-blue-600"
            />
            <span className="text-gray-700">{option}</span>
          </label>
        ))}
      </div>
    );
  }

  if (question.type === 'rating') {
    return (
      <div className="flex gap-3 justify-center py-2">
        {[1, 2, 3, 4, 5].map((star) => (
          <button
            key={star}
            onClick={() => onChange(String(star))}
            className={`text-3xl transition-transform hover:scale-110 ${
              Number(value) >= star ? 'text-yellow-400' : 'text-gray-300'
            }`}
          >
            ★
          </button>
        ))}
      </div>
    );
  }

  // text
  return (
    <textarea
      value={value || ''}
      onChange={(e) => onChange(e.target.value)}
      className="input-field min-h-24 resize-none"
      placeholder="Votre réponse..."
      rows={3}
    />
  );
};

const Surveys = () => {
  const { isAuthenticated }   = useSelector((state) => state.auth);
  const [surveys, setSurveys] = useState([]);
  const [active, setActive]   = useState(null);   // survey sélectionné
  const [answers, setAnswers] = useState({});
  const [phase, setPhase]     = useState('list'); // list | answering | done
  const [loading, setLoading] = useState(true);
  const [submitting, setSubmitting] = useState(false);
  const [error, setError]     = useState(null);

  useEffect(() => {
    surveysAPI.getAll()
      .then((res) => setSurveys(res.data.data || []))
      .catch(() => setError('Erreur de chargement des sondages.'))
      .finally(() => setLoading(false));
  }, []);

  const handleOpen = (survey) => {
    setActive(survey);
    setAnswers({});
    setPhase('answering');
  };

  const handleAnswer = (questionId, value) => {
    setAnswers((prev) => ({ ...prev, [questionId]: value }));
  };

  const handleSubmit = async () => {
    const requiredUnanswered = active.questions
      .filter((q) => q.is_required && !answers[q.id]);

    if (requiredUnanswered.length > 0) {
      setError('Veuillez répondre à toutes les questions obligatoires.');
      return;
    }

    setError(null);
    setSubmitting(true);
    try {
      await surveysAPI.submit(active.id, {
        answers: active.questions.map((q) => ({
          question_id: q.id,
          answer:      answers[q.id] || '',
        })),
      });
      setPhase('done');
    } catch (err) {
      setError(err.response?.data?.error || 'Erreur lors de la soumission.');
    } finally {
      setSubmitting(false);
    }
  };

  if (loading) return <LoadingSpinner message="Chargement des sondages..." />;

  // ── RÉSULTAT ────────────────────────────────────────────────────────────────
  if (phase === 'done') return (
    <div className="max-w-lg mx-auto">
      <div className="card text-center space-y-6">
        <div className="text-6xl">🎉</div>
        <h2 className="text-2xl font-bold text-gray-900">Merci pour votre participation !</h2>
        <p className="text-gray-500">Votre réponse au sondage "{active.title}" a bien été enregistrée.</p>
        <button onClick={() => { setPhase('list'); setActive(null); }} className="btn-primary">
          Voir les autres sondages
        </button>
      </div>
    </div>
  );

  // ── FORMULAIRE ───────────────────────────────────────────────────────────────
  if (phase === 'answering' && active) return (
    <div className="max-w-2xl mx-auto space-y-6">
      <div className="flex items-center gap-4">
        <button onClick={() => setPhase('list')} className="text-gray-500 hover:text-gray-700 text-2xl">←</button>
        <h1 className="text-2xl font-bold text-gray-900">{active.title}</h1>
      </div>
      {active.description && <p className="text-gray-500">{active.description}</p>}

      {error && (
        <div className="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">{error}</div>
      )}

      <div className="space-y-6">
        {active.questions.map((question, i) => (
          <div key={question.id} className="card space-y-3">
            <div className="flex items-start gap-2">
              <span className="bg-blue-100 text-blue-700 text-sm font-bold px-2 py-0.5 rounded flex-shrink-0">
                {i + 1}
              </span>
              <div className="flex-1">
                <p className="font-medium text-gray-800">
                  {question.question}
                  {question.is_required && <span className="text-red-500 ml-1">*</span>}
                </p>
                <div className="mt-3">
                  <SurveyQuestion
                    question={question}
                    value={answers[question.id]}
                    onChange={(val) => handleAnswer(question.id, val)}
                  />
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>

      <div className="flex gap-4">
        <button onClick={() => setPhase('list')} className="btn-secondary flex-1">
          Annuler
        </button>
        <button
          onClick={handleSubmit}
          disabled={submitting || !isAuthenticated}
          className="btn-primary flex-1 disabled:opacity-50"
          title={!isAuthenticated ? 'Connectez-vous pour répondre' : ''}
        >
          {submitting ? 'Envoi...' : '✅ Envoyer mes réponses'}
        </button>
      </div>

      {!isAuthenticated && (
        <p className="text-center text-sm text-gray-500">
          Vous devez être <a href="/login" className="text-blue-600 hover:underline">connecté</a> pour soumettre un sondage.
        </p>
      )}
    </div>
  );

  // ── LISTE ────────────────────────────────────────────────────────────────────
  return (
    <div className="space-y-6">
      <h2 className="text-3xl font-bold text-gray-900">📊 Sondages</h2>

      {error && <div className="card text-center text-red-600 py-6">{error}</div>}

      {surveys.length === 0 && !error && (
        <div className="card text-center py-12">
          <div className="text-5xl mb-4">📊</div>
          <h3 className="text-xl font-semibold mb-2">Aucun sondage disponible</h3>
          <p className="text-gray-500">Revenez plus tard !</p>
        </div>
      )}

      <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        {surveys.map((survey) => {
          const isActive  = survey.is_active;
          const endsAt    = survey.ends_at ? new Date(survey.ends_at) : null;
          const daysLeft  = endsAt ? Math.ceil((endsAt - Date.now()) / 86400000) : null;

          return (
            <div key={survey.id} className="card hover:shadow-lg transition-shadow flex flex-col">
              <div className="flex-1 space-y-3">
                <h3 className="text-lg font-bold text-gray-900">{survey.title}</h3>
                {survey.description && (
                  <p className="text-gray-600 text-sm line-clamp-2">{survey.description}</p>
                )}
                <div className="flex flex-wrap gap-2 text-xs">
                  <span className="bg-gray-100 text-gray-600 px-2 py-1 rounded">
                    {survey.questions?.length || 0} question{survey.questions?.length > 1 ? 's' : ''}
                  </span>
                  {daysLeft !== null && daysLeft > 0 && (
                    <span className="bg-orange-100 text-orange-600 px-2 py-1 rounded">
                      ⏳ {daysLeft} jour{daysLeft > 1 ? 's' : ''} restant{daysLeft > 1 ? 's' : ''}
                    </span>
                  )}
                </div>
              </div>
              <button
                onClick={() => handleOpen(survey)}
                disabled={!isActive}
                className={`mt-4 w-full py-2 px-4 rounded font-bold transition ${
                  isActive
                    ? 'bg-blue-600 hover:bg-blue-700 text-white'
                    : 'bg-gray-200 text-gray-400 cursor-not-allowed'
                }`}
              >
                {isActive ? 'Participer' : 'Sondage terminé'}
              </button>
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default Surveys;
