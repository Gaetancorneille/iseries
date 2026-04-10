import React from 'react';
import { Link } from 'react-router-dom';

const ArticleCard = ({ article }) => {
  const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('fr-FR', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });
  };

  return (
    <div className="card hover:shadow-lg transition-shadow">
      <div className="p-6">
        <h3 className="text-xl font-bold mb-2 text-gray-900">
          <Link to={`/articles/${article.id}`} className="hover:text-blue-600">
            {article.title}
          </Link>
        </h3>
        
        {article.is_featured && (
          <span className="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full mb-3">
            🌟 Article mis en avant
          </span>
        )}
        
        <p className="text-gray-600 mb-4 line-clamp-3">
          {article.content.substring(0, 150)}...
        </p>
        
        <div className="flex items-center justify-between text-sm text-gray-500">
          <div>
            <span>Par {article.author?.name || 'Anonyme'}</span>
            <span className="mx-2">•</span>
            <span>{formatDate(article.published_at)}</span>
          </div>
          <Link 
            to={`/articles/${article.id}`} 
            className="text-blue-600 hover:text-blue-800 font-medium"
          >
            Lire plus →
          </Link>
        </div>
      </div>
    </div>
  );
};

export default ArticleCard;