import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { quizzesAPI } from '../utils/api';
import LoadingSpinner from '../components/LoadingSpinner';

const Quizzes = () => {
  const [quizzes, setQuizzes] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError]     = useState(null);
  const [page, setPage]       = useState(1);
  const [hasMore, setHasMore] = useState(true);

  useEffect(() => { fetchQuizzes(); }, [page]);

  const fetchQuizzes = async () => {
    try {
      setLoading(true);
      const res = await quizzesAPI.getAll(page);
      const data = res.data.data || [];
      setQuizzes(prev => page === 1 ? data : [...prev, ...data]);
      setHasMore(res.data.current_page < res.data.last_page);
    } catch {
      setError('Erreur lors du chargement des quiz.');
    } finally {
      setLoading(false);
    }
  };

  if (loading && quizzes.length === 0) return <LoadingSpinner message="Chargement des quiz..." />;

  return (
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h2 className="text-3xl font-bold text-gray-900">🎯 Quiz</h2>
        <span className="text-sm text-gray-500">{quizzes.length} quiz disponible{quizzes.length > 1 ? 's' : ''}</span>
      </div>

      {error && (
        <div className="card text-center py-8 text-red-600">{error}</div>
      )}

      {!error && quizzes.length === 0 && !loading && (
        <div className="card text-center py-12">
          <div className="text-5xl mb-4">🎯</div>
          <h3 className="text-xl font-semibold mb-2">Aucun quiz disponible</h3>
          <p className="text-gray-500">Revenez plus tard !</p>
        </div>
      )}

      <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        {quizzes.map((quiz) => (
          <div key={quiz.id} className="card hover:shadow-lg transition-shadow flex flex-col">
            <div className="flex-1">
              <h3 className="text-lg font-bold text-gray-900 mb-2">{quiz.title}</h3>
              {quiz.series && (
                <span className="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded-full mb-3">
                  📺 {quiz.series.title}
                </span>
              )}
              {quiz.description && (
                <p className="text-gray-600 text-sm mb-4 line-clamp-2">{quiz.description}</p>
              )}
              <div className="flex flex-wrap gap-2 text-xs text-gray-500 mb-4">
                {quiz.time_limit && (
                  <span className="bg-gray-100 px-2 py-1 rounded">⏱ {quiz.time_limit} min</span>
                )}
                <span className="bg-gray-100 px-2 py-1 rounded">✅ Score : {quiz.passing_score}%</span>
                {quiz.creator && (
                  <span className="bg-gray-100 px-2 py-1 rounded">👤 {quiz.creator.name}</span>
                )}
              </div>
            </div>
            <Link to={`/quizzes/${quiz.id}`} className="btn-primary text-center mt-auto">
              Commencer le quiz
            </Link>
          </div>
        ))}
      </div>

      {loading && quizzes.length > 0 && <LoadingSpinner message="Chargement..." />}
      {hasMore && !loading && (
        <div className="text-center">
          <button onClick={() => setPage(p => p + 1)} className="btn-primary">
            Charger plus
          </button>
        </div>
      )}
    </div>
  );
};

export default Quizzes;
