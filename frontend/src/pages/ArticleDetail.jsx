import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import { articlesAPI } from '../utils/api';
import LoadingSpinner from '../components/LoadingSpinner';

const ArticleDetail = () => {
  const { id } = useParams();
  const [article, setArticle] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError]     = useState(null);

  useEffect(() => {
    articlesAPI.getById(id)
      .then((res) => setArticle(res.data))
      .catch(() => setError('Article introuvable.'))
      .finally(() => setLoading(false));
  }, [id]);

  const formatDate = (dateString) =>
    new Date(dateString).toLocaleDateString('fr-FR', {
      year: 'numeric', month: 'long', day: 'numeric',
    });

  if (loading) return <LoadingSpinner message="Chargement de l'article..." />;

  if (error) return (
    <div className="card text-center py-12">
      <div className="text-5xl mb-4">📰</div>
      <h2 className="text-2xl font-bold mb-2">Erreur</h2>
      <p className="text-gray-600 mb-6">{error}</p>
      <Link to="/articles" className="btn-primary">Retour aux articles</Link>
    </div>
  );

  return (
    <div className="max-w-3xl mx-auto space-y-6">
      {/* En-tête */}
      <div className="card">
        {article.is_featured && (
          <span className="inline-block bg-yellow-100 text-yellow-800 text-sm px-3 py-1 rounded-full mb-4">
            🌟 Article mis en avant
          </span>
        )}

        <h1 className="text-3xl font-bold text-gray-900 mb-4">{article.title}</h1>

        <div className="flex items-center gap-4 text-sm text-gray-500 pb-6 border-b border-gray-100">
          <div className="flex items-center gap-2">
            <div className="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center text-white font-bold text-sm">
              {article.author?.name?.charAt(0) || 'A'}
            </div>
            <span className="font-medium text-gray-700">{article.author?.name || 'Anonyme'}</span>
          </div>
          {article.published_at && (
            <>
              <span>•</span>
              <span>{formatDate(article.published_at)}</span>
            </>
          )}
        </div>

        {/* Contenu */}
        <div className="prose prose-gray max-w-none mt-6">
          {article.content.split('\n').map((paragraph, i) =>
            paragraph.trim() ? (
              <p key={i} className="text-gray-700 leading-relaxed mb-4">{paragraph}</p>
            ) : null
          )}
        </div>
      </div>

      {/* Navigation */}
      <div className="flex justify-between items-center">
        <Link to="/articles" className="btn-secondary">← Retour aux articles</Link>
      </div>
    </div>
  );
};

export default ArticleDetail;
