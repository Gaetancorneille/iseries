import React, { useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { Provider, useDispatch, useSelector } from 'react-redux';
import { store } from './store';
import { setUser, logout } from './store/authSlice';
import { authAPI } from './utils/api';

// Layout
import Layout from './components/Layout';
import ErrorBoundary from './components/ErrorBoundary';

// Pages publiques
import Home          from './pages/Home';
import Login         from './pages/Login';
import Register      from './pages/Register';
import Articles      from './pages/Articles';
import ArticleDetail from './pages/ArticleDetail';
import Series        from './pages/Series';
import SeriesDetail  from './pages/SeriesDetail';
import Search        from './pages/Search';
import Quizzes       from './pages/Quizzes';
import QuizDetail    from './pages/QuizDetail';
import Surveys       from './pages/Surveys';

// Pages protégées
import Profile   from './pages/Profile';
import Favorites from './pages/Favorites';

// ── Guards ──────────────────────────────────────────────────────────────────
const PrivateRoute = ({ children }) => {
  const { isAuthenticated } = useSelector((s) => s.auth);
  return isAuthenticated ? children : <Navigate to="/login" replace />;
};

const GuestRoute = ({ children }) => {
  const { isAuthenticated } = useSelector((s) => s.auth);
  return !isAuthenticated ? children : <Navigate to="/" replace />;
};

// ── Composant interne (accès au store) ──────────────────────────────────────
const AppRoutes = () => {
  const dispatch = useDispatch();
  const { isAuthenticated } = useSelector((s) => s.auth);

  useEffect(() => {
    if (isAuthenticated) {
      authAPI.me()
        .then((res) => dispatch(setUser(res.data)))
        .catch(() => dispatch(logout()));
    }
  }, []);

  return (
    <Layout>
      <Routes>
        {/* ── Publiques ── */}
        <Route path="/"               element={<Home />} />
        <Route path="/articles"       element={<Articles />} />
        <Route path="/articles/:id"   element={<ArticleDetail />} />
        <Route path="/series"         element={<Series />} />
        <Route path="/series/:id"     element={<SeriesDetail />} />
        <Route path="/search"         element={<Search />} />
        <Route path="/quizzes"        element={<Quizzes />} />
        <Route path="/quizzes/:id"    element={<QuizDetail />} />
        <Route path="/surveys"        element={<Surveys />} />

        {/* ── Invité seulement ── */}
        <Route path="/login"    element={<GuestRoute><Login /></GuestRoute>} />
        <Route path="/register" element={<GuestRoute><Register /></GuestRoute>} />

        {/* ── Protégées ── */}
        <Route path="/profile"   element={<PrivateRoute><Profile /></PrivateRoute>} />
        <Route path="/favorites" element={<PrivateRoute><Favorites /></PrivateRoute>} />

        {/* ── Fallback ── */}
        <Route path="*" element={<Navigate to="/" replace />} />
      </Routes>
    </Layout>
  );
};

// ── App root ─────────────────────────────────────────────────────────────────
function App() {
  return (
    <Provider store={store}>
      <ErrorBoundary>
        <Router>
          <AppRoutes />
        </Router>
      </ErrorBoundary>
    </Provider>
  );
}

export default App;
