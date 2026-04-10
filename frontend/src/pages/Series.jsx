import React, { useState, useEffect } from 'react';
import { seriesAPI } from '../utils/api';
import SeriesCard from '../components/SeriesCard';
import LoadingSpinner from '../components/LoadingSpinner';
import ErrorBoundary from '../components/ErrorBoundary';

const Series = () => {
  const [series, setSeries] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);
  const [page, setPage] = useState(1);
  const [hasMore, setHasMore] = useState(true);

  useEffect(() => {
    fetchSeries();
  }, [page]);

  const fetchSeries = async () => {
    try {
      setLoading(true);
      const response = await seriesAPI.getAll(page);
      
      if (page === 1) {
        setSeries(response.data.data);
      } else {
        setSeries(prev => [...prev, ...response.data.data]);
      }
      
      setHasMore(response.data.current_page < response.data.last_page);
      setError(null);
    } catch (err) {
      setError('Erreur lors du chargement des séries');
      console.error('Error fetching series:', err);
    } finally {
      setLoading(false);
    }
  };

  const loadMore = () => {
    if (hasMore && !loading) {
      setPage(prev => prev + 1);
    }
  };

  if (loading && series.length === 0) {
    return <LoadingSpinner message="Chargement des séries..." />;
  }

  if (error && series.length === 0) {
    return (
      <div className="card text-center py-12">
        <div className="text-5xl mb-4">📺</div>
        <h2 className="text-2xl font-bold mb-2">Erreur de chargement</h2>
        <p className="text-gray-600 mb-6">{error}</p>
        <button 
          onClick={fetchSeries}
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
          <h2 className="text-3xl font-bold text-gray-900">Séries</h2>
          <div className="text-sm text-gray-500">
            {series.length} série{series.length > 1 ? 's' : ''}
          </div>
        </div>
        
        <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
          {series.map(singleSeries => (
            <SeriesCard key={singleSeries.id} series={singleSeries} />
          ))}
        </div>
        
        {loading && series.length > 0 && (
          <LoadingSpinner message="Chargement de plus de séries..." />
        )}
        
        {hasMore && !loading && (
          <div className="text-center py-6">
            <button 
              onClick={loadMore}
              className="btn-primary"
            >
              Charger plus de séries
            </button>
          </div>
        )}
        
        {!hasMore && series.length > 0 && (
          <div className="text-center py-6 text-gray-500">
            Vous avez vu toutes les séries
          </div>
        )}
        
        {series.length === 0 && !loading && (
          <div className="card text-center py-12">
            <div className="text-5xl mb-4">📺</div>
            <h3 className="text-xl font-semibold mb-2">Aucune série disponible</h3>
            <p className="text-gray-600">Revenez plus tard pour découvrir nos nouvelles séries !</p>
          </div>
        )}
      </div>
    </ErrorBoundary>
  );
};

export default Series;