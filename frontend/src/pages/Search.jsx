import React, { useState, useEffect } from 'react';
import { useSearchParams, Link } from 'react-router-dom';
import { searchAPI } from '../utils/api';
import LoadingSpinner from '../components/LoadingSpinner';

const Search = () => {
  const [searchParams, setSearchParams] = useSearchParams();
  const [results, setResults] = useState(null);
  const [loading, setLoading] = useState(false);
  const [query, setQuery]     = useState(searchParams.get('q') || '');
  const [type, setType]       = useState(searchParams.get('type') || 'all');

  useEffect(() => {
    const q = searchParams.get('q');
    if (q && q.length >= 2) {
      setQuery(q);
      doSearch(q, searchParams.get('type') || 'all');
    }
  }, [searchParams]);

  const doSearch = async (q, t) => {
    setLoading(true);
    try {
      const res = await searchAPI.global(q, t);
      setResults(res.data);
    } catch {
      setResults(null);
    } finally {
      setLoading(false);
    }
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    if (query.trim().length < 2) return;
    setSearchParams({ q: query.trim(), type });
  };

  const totalSeries   = results?.results?.series?.length || 0;
  const totalArticles = results?.results?.articles?.length || 0;
  const totalActors   = results?.results?.actors?.length || 0;

  return (
    <div className="space-y-8">
      {/* Formulaire */}
      <div className="card">
        <h1 className="text-2xl font-bold text-gray-900 mb-4">🔍 Recherche</h1>
        <form onSubmit={handleSubmit} className="space-y-4">
          <div className="flex gap-3">
            <input
              type="text"
              value={query}
              onChange={(e) => setQuery(e.target.value)}
              className="input-field flex-1 text-lg"
              placeholder="Rechercher une série, un article, un acteur..."
              minLength={2}
            />
            <button type="submit" className="btn-primary px-6 text-lg">
              Rechercher
            </button>
          </div>
          <div className="flex gap-3 flex-wrap">
            {[
              { value: 'all',      label: '🌐 Tout' },
              { value: 'series',   label: '📺 Séries' },
              { value: 'articles', label: '📰 Articles' },
              { value: 'actors',   label: '🎭 Acteurs' },
            ].map((opt) => (
              <button
                key={opt.value}
                type="button"
                onClick={() => setType(opt.value)}
                className={`px-4 py-2 rounded-full text-sm font-medium transition ${
                  type === opt.value
                    ? 'bg-blue-600 text-white'
                    : 'bg-gray-100 text-gray-600 hover:bg-gray-200'
                }`}
              >
                {opt.label}
              </button>
            ))}
          </div>
        </form>
      </div>

      {loading && <LoadingSpinner message="Recherche en cours..." />}

      {/* Résultats */}
      {results && !loading && (
        <div className="space-y-8">
          <p className="text-gray-500">
            <span className="font-bold text-gray-800">{results.total}</span> résultat{results.total > 1 ? 's' : ''} pour{' '}
            <span className="font-bold text-blue-600">"{results.query}"</span>
          </p>

          {/* Séries */}
          {results.results.series?.length > 0 && (
            <div>
              <h2 className="text-xl font-bold text-gray-900 mb-4">📺 Séries ({totalSeries})</h2>
              <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                {results.results.series.map((s) => (
                  <Link
                    key={s.id}
                    to={`/series/${s.id}`}
                    className="card hover:shadow-lg transition-shadow flex gap-4 items-center"
                  >
                    {s.photo_url ? (
                      <img src={s.photo_url} alt={s.title} className="w-14 h-20 object-cover rounded flex-shrink-0" />
                    ) : (
                      <div className="w-14 h-20 bg-gradient-to-br from-blue-400 to-purple-500 rounded flex-shrink-0 flex items-center justify-center text-white font-bold text-xl">
                        {s.title?.charAt(0)}
                      </div>
                    )}
                    <div className="min-w-0">
                      <h3 className="font-bold text-gray-900 truncate">{s.title}</h3>
                      <p className="text-sm text-gray-500">{s.genre} · {s.release_year}</p>
                      {s.rating && <p className="text-sm text-yellow-500">⭐ {s.rating}/10</p>}
                    </div>
                  </Link>
                ))}
              </div>
            </div>
          )}

          {/* Articles */}
          {results.results.articles?.length > 0 && (
            <div>
              <h2 className="text-xl font-bold text-gray-900 mb-4">📰 Articles ({totalArticles})</h2>
              <div className="space-y-3">
                {results.results.articles.map((a) => (
                  <Link
                    key={a.id}
                    to={`/articles/${a.id}`}
                    className="card hover:shadow-lg transition-shadow block"
                  >
                    <h3 className="font-bold text-gray-900 hover:text-blue-600">{a.title}</h3>
                    <p className="text-sm text-gray-500 mt-1">
                      Par {a.author?.name || 'Anonyme'} ·{' '}
                      {a.published_at ? new Date(a.published_at).toLocaleDateString('fr-FR') : ''}
                    </p>
                  </Link>
                ))}
              </div>
            </div>
          )}

          {/* Acteurs */}
          {results.results.actors?.length > 0 && (
            <div>
              <h2 className="text-xl font-bold text-gray-900 mb-4">🎭 Acteurs ({totalActors})</h2>
              <div className="flex flex-wrap gap-4">
                {results.results.actors.map((actor) => (
                  <div key={actor.id} className="flex items-center gap-3 card py-3 px-4">
                    {actor.photo_url ? (
                      <img src={actor.photo_url} alt={actor.name} className="w-10 h-10 rounded-full object-cover" />
                    ) : (
                      <div className="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white font-bold">
                        {actor.name?.charAt(0)}
                      </div>
                    )}
                    <div>
                      <p className="font-medium text-gray-800">{actor.name}</p>
                      {actor.birth_date && (
                        <p className="text-xs text-gray-500">{new Date(actor.birth_date).getFullYear()}</p>
                      )}
                    </div>
                  </div>
                ))}
              </div>
            </div>
          )}

          {results.total === 0 && (
            <div className="card text-center py-10">
              <div className="text-5xl mb-4">🔍</div>
              <h3 className="text-xl font-semibold mb-2">Aucun résultat</h3>
              <p className="text-gray-500">Essayez avec d'autres mots-clés.</p>
            </div>
          )}
        </div>
      )}
    </div>
  );
};

export default Search;
