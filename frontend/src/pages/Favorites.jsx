import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { favoritesAPI } from '../utils/api';
import LoadingSpinner from '../components/LoadingSpinner';

const Favorites = () => {
  const [favorites, setFavorites] = useState([]);
  const [loading, setLoading]     = useState(true);
  const [error, setError]         = useState(null);

  useEffect(() => {
    favoritesAPI.getAll()
      .then((res) => setFavorites(res.data))
      .catch(() => setError('Erreur de chargement des favoris.'))
      .finally(() => setLoading(false));
  }, []);

  const handleRemove = async (seriesId) => {
    try {
      await favoritesAPI.remove(seriesId);
      setFavorites((prev) => prev.filter((f) => f.series_id !== seriesId));
    } catch {
      setError('Impossible de supprimer ce favori.');
    }
  };

  if (loading) return <LoadingSpinner message="Chargement de vos favoris..." />;

  return (
    <div className="space-y-6">
      <h2 className="text-3xl font-bold text-gray-900">❤️ Mes favoris</h2>

      {error && <div className="card text-red-600 text-center py-4">{error}</div>}

      {favorites.length === 0 && !error && (
        <div className="card text-center py-12">
          <div className="text-5xl mb-4">🤍</div>
          <h3 className="text-xl font-semibold mb-2">Aucun favori pour l'instant</h3>
          <p className="text-gray-500 mb-6">Ajoutez des séries à vos favoris depuis leurs pages détail.</p>
          <Link to="/series" className="btn-primary">Découvrir les séries</Link>
        </div>
      )}

      <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        {favorites.map(({ series, series_id }) => (
          <div key={series_id} className="card hover:shadow-lg transition-shadow">
            <div className="flex gap-4">
              {series.photo_url ? (
                <img
                  src={series.photo_url}
                  alt={series.title}
                  className="w-20 h-28 object-cover rounded-lg flex-shrink-0"
                />
              ) : (
                <div className="w-20 h-28 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex-shrink-0 flex items-center justify-center text-white text-2xl font-bold">
                  {series.title?.charAt(0)}
                </div>
              )}
              <div className="flex-1 min-w-0 space-y-2">
                <h3 className="font-bold text-gray-900 leading-tight">{series.title}</h3>
                <div className="flex flex-wrap gap-1 text-xs">
                  <span className="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">{series.genre}</span>
                  <span className="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{series.release_year}</span>
                </div>
                {series.rating && (
                  <p className="text-yellow-500 text-sm font-medium">⭐ {series.rating}/10</p>
                )}
                <div className="flex gap-2 pt-1">
                  <Link to={`/series/${series.id}`} className="btn-primary text-xs py-1 px-3">
                    Voir
                  </Link>
                  <button
                    onClick={() => handleRemove(series_id)}
                    className="text-xs py-1 px-3 bg-red-50 text-red-600 hover:bg-red-100 rounded font-bold transition"
                  >
                    ✕ Retirer
                  </button>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Favorites;
