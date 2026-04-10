import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { articlesAPI, seriesAPI } from '../utils/api';
import LoadingSpinner from '../components/LoadingSpinner';

const Home = () => {
  const [recentArticles, setRecentArticles] = useState([]);
  const [popularSeries, setPopularSeries]   = useState([]);
  const [loading, setLoading]               = useState(true);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const [articlesRes, seriesRes] = await Promise.all([
          articlesAPI.getAll(1),
          seriesAPI.getAll(1),
        ]);
        setRecentArticles(articlesRes.data.data?.slice(0, 3) || []);
        setPopularSeries(seriesRes.data.data?.slice(0, 4) || []);
      } catch (err) {
        console.error('Erreur chargement home:', err);
      } finally {
        setLoading(false);
      }
    };
    fetchData();
  }, []);

  return (
    <div className="space-y-12">
      {/* Hero */}
      <div className="bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg p-12 text-white text-center">
        <h1 className="text-4xl font-bold mb-4">Bienvenue sur iSeries-TV</h1>
        <p className="text-xl mb-8">
          Découvrez des analyses, des critiques et des informations exclusives sur vos séries préférées.
        </p>
        <div className="flex justify-center space-x-4">
          <Link to="/articles" className="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
            Explorer les articles
          </Link>
          <Link to="/series" className="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
            Découvrir les séries
          </Link>
        </div>
      </div>

      {/* Features */}
      <div className="grid md:grid-cols-3 gap-8">
        {[
          { icon: '📰', title: 'Articles de qualité',    desc: 'Analyses approfondies et critiques de vos séries préférées' },
          { icon: '📊', title: 'Sondages interactifs',   desc: 'Participez à nos sondages et partagez votre avis' },
          { icon: '🎯', title: 'Quiz sur les séries',    desc: 'Testez vos connaissances sur vos séries préférées' },
        ].map(({ icon, title, desc }) => (
          <div key={title} className="card text-center">
            <div className="text-4xl mb-4">{icon}</div>
            <h3 className="text-xl font-semibold mb-2">{title}</h3>
            <p className="text-gray-600">{desc}</p>
          </div>
        ))}
      </div>

      {/* Contenu dynamique */}
      {loading ? (
        <LoadingSpinner message="Chargement du contenu..." />
      ) : (
        <div className="grid md:grid-cols-2 gap-8">
          {/* Articles récents */}
          <div className="card">
            <h2 className="text-2xl font-bold mb-4">Articles récents</h2>
            {recentArticles.length > 0 ? (
              <div className="space-y-4">
                {recentArticles.map((article) => (
                  <div key={article.id} className="border-b pb-4 last:border-0">
                    <h3 className="font-semibold text-gray-800">{article.title}</h3>
                    <p className="text-gray-500 text-sm mt-1">
                      Par {article.author?.name || 'Anonyme'} ·{' '}
                      {article.published_at
                        ? new Date(article.published_at).toLocaleDateString('fr-FR')
                        : 'Non publié'}
                    </p>
                  </div>
                ))}
              </div>
            ) : (
              <p className="text-gray-500">Aucun article disponible pour le moment.</p>
            )}
            <Link to="/articles" className="btn-primary mt-4 inline-block">
              Voir tous les articles
            </Link>
          </div>

          {/* Séries populaires */}
          <div className="card">
            <h2 className="text-2xl font-bold mb-4">Séries disponibles</h2>
            {popularSeries.length > 0 ? (
              <div className="space-y-4">
                {popularSeries.map((serie) => (
                  <div key={serie.id} className="flex items-center space-x-4">
                    {serie.photo_url ? (
                      <img
                        src={serie.photo_url}
                        alt={serie.title}
                        className="w-16 h-16 rounded object-cover bg-gray-200"
                        onError={(e) => { e.target.style.display = 'none'; }}
                      />
                    ) : (
                      <div className="bg-gradient-to-br from-blue-400 to-purple-500 w-16 h-16 rounded flex items-center justify-center text-white text-xl font-bold">
                        {serie.title?.charAt(0)}
                      </div>
                    )}
                    <div>
                      <h3 className="font-semibold text-gray-800">{serie.title}</h3>
                      <p className="text-gray-500 text-sm">
                        {serie.genre} · {serie.release_year}
                        {serie.rating && ` · ⭐ ${serie.rating}/10`}
                      </p>
                    </div>
                  </div>
                ))}
              </div>
            ) : (
              <p className="text-gray-500">Aucune série disponible pour le moment.</p>
            )}
            <Link to="/series" className="btn-primary mt-4 inline-block">
              Voir toutes les séries
            </Link>
          </div>
        </div>
      )}
    </div>
  );
};

export default Home;
