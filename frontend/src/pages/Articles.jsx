import React, { useState, useEffect } from 'react';
import { articlesAPI } from '../utils/api';
import ArticleCard from '../components/ArticleCard';
import LoadingSpinner from '../components/LoadingSpinner';
import ErrorBoundary from '../components/ErrorBoundary';

const Articles = () => {
  const [articles, setArticles] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [page, setPage] = useState(1);
  const [hasMore, setHasMore] = useState(true);

  useEffect(() => {
    fetchArticles();
  }, [page]);

  const fetchArticles = async () => {
    try {
      setLoading(true);
      const response = await articlesAPI.getAll(page);
      
      if (page === 1) {
        setArticles(response.data.data);
      } else {
        setArticles(prev => [...prev, ...response.data.data]);
      }
      
      setHasMore(response.data.current_page < response.data.last_page);
      setError(null);
    } catch (err) {
      setError('Erreur lors du chargement des articles');
      console.error('Error fetching articles:', err);
    } finally {
      setLoading(false);
    }
  };

  const loadMore = () => {
    if (hasMore && !loading) {
      setPage(prev => prev + 1);
    }
  };

  if (loading && articles.length === 0) {
    return <LoadingSpinner message="Chargement des articles..." />;
  }

  if (error && articles.length === 0) {
    return (
      <div className="card text-center py-12">
        <div className="text-5xl mb-4">📰</div>
        <h2 className="text-2xl font-bold mb-2">Erreur de chargement</h2>
        <p className="text-gray-600 mb-6">{error}</p>
        <button 
          onClick={fetchArticles}
          className="btn-primary"
        >
          Réessayer
        </button>
      </div>
    );
  }

  return (
    <ErrorBoundary>
      <div className="space-y-6">
        <div className="flex justify-between items-center">
          <h2 className="text-3xl font-bold text-gray-900">Articles</h2>
          <div className="text-sm text-gray-500">
            {articles.length} article{articles.length > 1 ? 's' : ''}
          </div>
        </div>
        
        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {articles.map(article => (
            <ArticleCard key={article.id} article={article} />
          ))}
        </div>
        
        {loading && articles.length > 0 && (
          <LoadingSpinner message="Chargement de plus d'articles..." />
        )}
        
        {hasMore && !loading && (
          <div className="text-center py-6">
            <button 
              onClick={loadMore}
              className="btn-primary"
            >
              Charger plus d'articles
            </button>
          </div>
        )}
        
        {!hasMore && articles.length > 0 && (
          <div className="text-center py-6 text-gray-500">
            Vous avez vu tous les articles
          </div>
        )}
        
        {articles.length === 0 && !loading && (
          <div className="card text-center py-12">
            <div className="text-5xl mb-4">📰</div>
            <h3 className="text-xl font-semibold mb-2">Aucun article disponible</h3>
            <p className="text-gray-600">Revenez plus tard pour découvrir nos nouveaux articles !</p>
          </div>
        )}
      </div>
    </ErrorBoundary>
  );
};

export default Articles;