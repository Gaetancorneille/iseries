import React from 'react';
import { Link } from 'react-router-dom';

const SeriesCard = ({ series }) => {
  const renderRating = (rating) => {
    if (!rating) return 'Non noté';
    
    const stars = Math.round(rating);
    return (
      <div className="flex items-center">
        <div className="flex text-yellow-400">
          {'★'.repeat(stars)}
          {'☆'.repeat(5 - stars)}
        </div>
        <span className="ml-2 text-sm text-gray-600">{rating}/10</span>
      </div>
    );
  };

  return (
    <div className="card hover:shadow-lg transition-shadow">
      <div className="p-4">
        {series.photo_url ? (
          <img 
            src={series.photo_url} 
            alt={series.title}
            className="w-full h-48 object-cover rounded-lg mb-4"
            onError={(e) => {
              e.target.style.display = 'none';
              e.target.nextSibling.style.display = 'flex';
            }}
          />
        ) : (
          <div className="bg-gray-200 w-full h-48 rounded-lg mb-4 flex items-center justify-center text-gray-500">
            <span>Image non disponible</span>
          </div>
        )}
        
        <h3 className="text-lg font-bold mb-2 text-gray-900">
          <Link to={`/series/${series.id}`} className="hover:text-blue-600">
            {series.title}
          </Link>
        </h3>
        
        <div className="flex items-center justify-between mb-2">
          <span className="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">
            {series.genre}
          </span>
          <span className="text-sm text-gray-600">
            {series.release_year}
          </span>
        </div>
        
        <div className="mb-3">
          {renderRating(series.rating)}
        </div>
        
        <p className="text-gray-600 text-sm mb-4 line-clamp-2">
          {series.description.substring(0, 100)}...
        </p>
        
        <Link 
          to={`/series/${series.id}`} 
          className="btn-primary w-full text-center"
        >
          Voir les détails
        </Link>
      </div>
    </div>
  );
};

export default SeriesCard;