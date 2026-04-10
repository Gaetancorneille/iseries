import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { useSelector } from 'react-redux';
import { seriesAPI, favoritesAPI } from '../utils/api';
import LoadingSpinner from '../components/LoadingSpinner';

const SeriesDetail = () => {
  const { id } = useParams();
  const { isAuthenticated } = useSelector((state) => state.auth);

  const [series, setSeries]           = useState(null);
  const [isFavorite, setIsFavorite]   = useState(false);
  const [favLoading, setFavLoading]   = useState(false);
  const [openSeason, setOpenSeason]   = useState(null);
  const [loading, setLoading]         = useState(true);
  const [error, setError]             = useState(null);

  useEffect(() => {
    const fetchSeries = async () => {
      try {
        const res = await seriesAPI.getById(id);
        setSeries(res.data);
        if (res.data.seasons?.length > 0) setOpenSeason(res.data.seasons[0].id);
      } catch {
        setError('Série introuvable.');
      } finally {
        setLoading(false);
      }
    };
    fetchSeries();
  }, [id]);

  useEffect(() => {
    if (isAuthenticated && id) {
      favoritesAPI.check(id)
        .then((res) => setIsFavorite(res.data.is_favorite))
        .catch(() => {});
    }
  }, [isAuthenticated, id]);

  const handleToggleFavorite = async () => {
    if (!isAuthenticated) return;
    setFavLoading(true);
    try {
      const res = await favoritesAPI.toggle(id);
      setIsFavorite(res.data.is_favorite);
    } catch {
    } finally {
      setFavLoading(false);
    }
  };

  if (loading) return <LoadingSpinner message="Chargement de la série..." />;

  if (error) return (
    <div className="card text-center py-12">
      <div className="text-5xl mb-4">📺</div>
      <h2 className="text-2xl font-bold mb-2">Erreur</h2>
      <p className="text-gray-600 mb-6">{error}</p>
      <Link to="/series" className="btn-primary">Retour aux séries</Link>
    </div>
  );

  return (
    <div className="space-y-8">

      {/* Hero série */}
      <div className="relative rounded-xl overflow-hidden bg-gray-900 text-white">
        {series.photo_url && (
          <img
            src={series.photo_url}
            alt={series.title}
            className="absolute inset-0 w-full h-full object-cover opacity-30"
          />
        )}
        <div className="relative p-8 md:p-12 flex flex-col md:flex-row gap-8 items-start">
          {/* Poster */}
          <div className="flex-shrink-0">
            {series.photo_url ? (
              <img
                src={series.photo_url}
                alt={series.title}
                className="w-40 h-56 object-cover rounded-lg shadow-lg"
              />
            ) : (
              <div className="w-40 h-56 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center text-4xl font-bold">
                {series.title?.charAt(0)}
              </div>
            )}
          </div>

          {/* Infos */}
          <div className="flex-1 space-y-4">
            <div className="flex items-start justify-between gap-4">
              <h1 className="text-3xl md:text-4xl font-bold">{series.title}</h1>
              {isAuthenticated && (
                <button
                  onClick={handleToggleFavorite}
                  disabled={favLoading}
                  className={`flex-shrink-0 text-3xl transition-transform hover:scale-110 ${favLoading ? 'opacity-50' : ''}`}
                  title={isFavorite ? 'Retirer des favoris' : 'Ajouter aux favoris'}
                >
                  {isFavorite ? '❤️' : '🤍'}
                </button>
              )}
            </div>

            <div className="flex flex-wrap gap-3">
              <span className="bg-blue-600 text-white text-sm px-3 py-1 rounded-full">{series.genre}</span>
              <span className="bg-gray-700 text-white text-sm px-3 py-1 rounded-full">{series.release_year}</span>
              {series.rating && (
                <span className="bg-yellow-500 text-black text-sm px-3 py-1 rounded-full font-semibold">
                  ⭐ {series.rating}/10
                </span>
              )}
              {series.seasons?.length > 0 && (
                <span className="bg-gray-700 text-white text-sm px-3 py-1 rounded-full">
                  {series.seasons.length} saison{series.seasons.length > 1 ? 's' : ''}
                </span>
              )}
            </div>

            <p className="text-gray-300 leading-relaxed max-w-2xl">{series.description}</p>
          </div>
        </div>
      </div>

      {/* Acteurs */}
      {series.actors?.length > 0 && (
        <div className="card">
          <h2 className="text-xl font-bold mb-4 text-gray-900">🎭 Acteurs principaux</h2>
          <div className="flex gap-4 overflow-x-auto pb-2">
            {series.actors.map((actor) => (
              <div key={actor.id} className="flex-shrink-0 text-center w-24">
                {actor.photo_url ? (
                  <img
                    src={actor.photo_url}
                    alt={actor.name}
                    className="w-16 h-16 rounded-full object-cover mx-auto mb-2"
                  />
                ) : (
                  <div className="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 mx-auto mb-2 flex items-center justify-center text-white font-bold text-xl">
                    {actor.name?.charAt(0)}
                  </div>
                )}
                <p className="text-sm font-medium text-gray-800 leading-tight">{actor.name}</p>
                {actor.pivot?.character_name && (
                  <p className="text-xs text-gray-500 mt-1">{actor.pivot.character_name}</p>
                )}
              </div>
            ))}
          </div>
        </div>
      )}

      {/* Saisons & Épisodes */}
      {series.seasons?.length > 0 && (
        <div className="card">
          <h2 className="text-xl font-bold mb-6 text-gray-900">📺 Saisons & Épisodes</h2>
          <div className="space-y-3">
            {series.seasons.map((season) => (
              <div key={season.id} className="border border-gray-200 rounded-lg overflow-hidden">
                {/* Header saison */}
                <button
                  onClick={() => setOpenSeason(openSeason === season.id ? null : season.id)}
                  className="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 transition text-left"
                >
                  <div className="flex items-center gap-3">
                    <span className="bg-blue-600 text-white text-sm font-bold px-2 py-1 rounded">
                      S{String(season.season_number).padStart(2, '0')}
                    </span>
                    <span className="font-semibold text-gray-800">
                      {season.title || `Saison ${season.season_number}`}
                    </span>
                    {season.release_date && (
                      <span className="text-sm text-gray-500">
                        ({new Date(season.release_date).getFullYear()})
                      </span>
                    )}
                  </div>
                  <div className="flex items-center gap-3 text-sm text-gray-500">
                    <span>{season.episodes?.length || season.episode_count || 0} épisodes</span>
                    <span className="text-lg">{openSeason === season.id ? '▲' : '▼'}</span>
                  </div>
                </button>

                {/* Liste épisodes */}
                {openSeason === season.id && season.episodes?.length > 0 && (
                  <div className="divide-y divide-gray-100">
                    {season.episodes.map((episode) => (
                      <div key={episode.id} className="flex items-center gap-4 p-4 hover:bg-gray-50 transition">
                        <span className="text-gray-400 text-sm font-mono w-8 flex-shrink-0">
                          {String(episode.episode_number).padStart(2, '0')}
                        </span>
                        <div className="flex-1 min-w-0">
                          <p className="font-medium text-gray-800 truncate">{episode.title}</p>
                          {episode.description && (
                            <p className="text-sm text-gray-500 truncate mt-0.5">{episode.description}</p>
                          )}
                        </div>
                        <div className="flex items-center gap-3 flex-shrink-0 text-sm text-gray-400">
                          {episode.duration && <span>⏱ {episode.duration} min</span>}
                          {episode.video_url && (
                            <a
                              href={episode.video_url}
                              target="_blank"
                              rel="noopener noreferrer"
                              className="btn-primary text-xs py-1 px-3"
                            >
                              ▶ Voir
                            </a>
                          )}
                        </div>
                      </div>
                    ))}
                  </div>
                )}

                {openSeason === season.id && (!season.episodes || season.episodes.length === 0) && (
                  <p className="p-4 text-gray-500 text-sm text-center">Aucun épisode disponible pour cette saison.</p>
                )}
              </div>
            ))}
          </div>
        </div>
      )}

      {/* Quiz liés */}
      {series.quizzes?.length > 0 && (
        <div className="card">
          <h2 className="text-xl font-bold mb-4 text-gray-900">🎯 Quiz sur cette série</h2>
          <div className="grid md:grid-cols-2 gap-4">
            {series.quizzes.map((quiz) => (
              <Link
                key={quiz.id}
                to={`/quizzes/${quiz.id}`}
                className="border border-gray-200 rounded-lg p-4 hover:border-blue-400 hover:bg-blue-50 transition"
              >
                <h3 className="font-semibold text-gray-800">{quiz.title}</h3>
                {quiz.description && <p className="text-sm text-gray-500 mt-1">{quiz.description}</p>}
                <div className="flex gap-3 mt-2 text-xs text-gray-400">
                  {quiz.time_limit && <span>⏱ {quiz.time_limit} min</span>}
                  <span>✅ Score requis : {quiz.passing_score}%</span>
                </div>
              </Link>
            ))}
          </div>
        </div>
      )}

      <div className="text-center">
        <Link to="/series" className="btn-secondary">← Retour aux séries</Link>
      </div>
    </div>
  );
};

export default SeriesDetail;
