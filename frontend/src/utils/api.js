import axios from 'axios';

const API_BASE_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api/v1';

// Instance axios centralisée
const api = axios.create({
  baseURL: API_BASE_URL,
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
  },
});

// Intercepteur requête : injecter le token JWT
api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token');
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

// Intercepteur réponse : gérer les 401 (token expiré)
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response?.status === 401) {
      localStorage.removeItem('token');
      window.location.href = '/login';
    }
    return Promise.reject(error);
  }
);

// ── Auth ────────────────────────────────────────────────────────────────────
export const authAPI = {
  login:    (credentials) => api.post('/login', credentials),
  register: (userData)    => api.post('/register', userData),
  logout:   ()            => api.post('/logout'),
  me:       ()            => api.get('/me'),
};

// ── Articles ─────────────────────────────────────────────────────────────────
export const articlesAPI = {
  getAll:  (page = 1, params = {}) => api.get('/articles', { params: { page, ...params } }),
  getById: (id)                    => api.get(`/articles/${id}`),
  create:  (data)                  => api.post('/articles', data),
  update:  (id, data)              => api.put(`/articles/${id}`, data),
  delete:  (id)                    => api.delete(`/articles/${id}`),
};

// ── Series ───────────────────────────────────────────────────────────────────
export const seriesAPI = {
  getAll:  (page = 1, params = {}) => api.get('/series', { params: { page, ...params } }),
  getById: (id)                    => api.get(`/series/${id}`),
  create:  (data)                  => api.post('/series', data),
  update:  (id, data)              => api.put(`/series/${id}`, data),
  delete:  (id)                    => api.delete(`/series/${id}`),
};

// ── Search ───────────────────────────────────────────────────────────────────
export const searchAPI = {
  global: (q, type = 'all') => api.get('/search', { params: { q, type } }),
};

// ── Seasons ──────────────────────────────────────────────────────────────────
export const seasonsAPI = {
  getAll:  (seriesId)                    => api.get(`/series/${seriesId}/seasons`),
  getById: (seriesId, seasonNumber)      => api.get(`/series/${seriesId}/seasons/${seasonNumber}`),
  create:  (seriesId, data)              => api.post(`/series/${seriesId}/seasons`, data),
  update:  (seriesId, seasonNumber, data)=> api.put(`/series/${seriesId}/seasons/${seasonNumber}`, data),
  delete:  (seriesId, seasonNumber)      => api.delete(`/series/${seriesId}/seasons/${seasonNumber}`),
};

// ── Episodes ─────────────────────────────────────────────────────────────────
export const episodesAPI = {
  getAll:  (seriesId, seasonNumber)                  => api.get(`/series/${seriesId}/seasons/${seasonNumber}/episodes`),
  getById: (seriesId, seasonNumber, episodeNumber)   => api.get(`/series/${seriesId}/seasons/${seasonNumber}/episodes/${episodeNumber}`),
  create:  (seriesId, seasonNumber, data)            => api.post(`/series/${seriesId}/seasons/${seasonNumber}/episodes`, data),
  update:  (seriesId, seasonNumber, episodeNumber, data) => api.put(`/series/${seriesId}/seasons/${seasonNumber}/episodes/${episodeNumber}`, data),
  delete:  (seriesId, seasonNumber, episodeNumber)   => api.delete(`/series/${seriesId}/seasons/${seasonNumber}/episodes/${episodeNumber}`),
};

// ── Favorites ─────────────────────────────────────────────────────────────────
export const favoritesAPI = {
  getAll:  ()          => api.get('/favorites'),
  add:     (seriesId)  => api.post('/favorites', { series_id: seriesId }),
  remove:  (seriesId)  => api.delete(`/favorites/${seriesId}`),
  toggle:  (seriesId)  => api.post('/favorites/toggle', { series_id: seriesId }),
  check:   (seriesId)  => api.get(`/favorites/check/${seriesId}`),
};

// ── Surveys ──────────────────────────────────────────────────────────────────
export const surveysAPI = {
  getAll:   (page = 1)  => api.get('/surveys', { params: { page } }),
  getById:  (id)        => api.get(`/surveys/${id}`),
  create:   (data)      => api.post('/surveys', data),
  submit:   (id, data)  => api.post(`/surveys/${id}/submit`, data),
  results:  (id)        => api.get(`/surveys/${id}/results`),
};

// ── Quizzes ──────────────────────────────────────────────────────────────────
export const quizzesAPI = {
  getAll:         (page = 1) => api.get('/quizzes', { params: { page } }),
  getById:        (id)       => api.get(`/quizzes/${id}`),
  create:         (data)     => api.post('/quizzes', data),
  start:          (id)       => api.post(`/quizzes/${id}/start`),
  submitAttempt:  (attemptId, data) => api.post(`/quizzes/attempts/${attemptId}/submit`, data),
  results:        (id)       => api.get(`/quizzes/${id}/results`),
};

export default api;
