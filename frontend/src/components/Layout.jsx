import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';
import { logout } from '../store/authSlice';
import { authAPI } from '../utils/api';

const Layout = ({ children }) => {
  const { isAuthenticated, user } = useSelector((state) => state.auth);
  const dispatch   = useDispatch();
  const navigate   = useNavigate();
  const [search, setSearch] = useState('');
  const [menuOpen, setMenuOpen] = useState(false);

  const handleLogout = async () => {
    try { await authAPI.logout(); } catch {}
    dispatch(logout());
    navigate('/');
  };

  const handleSearch = (e) => {
    e.preventDefault();
    if (search.trim().length < 2) return;
    navigate(`/search?q=${encodeURIComponent(search.trim())}`);
    setSearch('');
  };

  return (
    <div className="min-h-screen bg-gray-50 flex flex-col">

      {/* ── Navbar ─────────────────────────────────────────────────────────── */}
      <nav className="bg-white shadow-sm border-b sticky top-0 z-50">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex items-center justify-between h-16 gap-4">

            {/* Logo */}
            <Link to="/" className="text-2xl font-bold text-blue-600 flex-shrink-0">
              📺 iSeries-TV
            </Link>

            {/* Barre de recherche */}
            <form onSubmit={handleSearch} className="hidden md:flex flex-1 max-w-sm">
              <div className="relative w-full">
                <input
                  type="text"
                  value={search}
                  onChange={(e) => setSearch(e.target.value)}
                  placeholder="Rechercher..."
                  className="w-full pl-4 pr-10 py-2 text-sm border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <button type="submit" className="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-blue-600">
                  🔍
                </button>
              </div>
            </form>

            {/* Liens desktop */}
            <div className="hidden md:flex items-center gap-1">
              <Link to="/articles" className="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                Articles
              </Link>
              <Link to="/series" className="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                Séries
              </Link>
              <Link to="/quizzes" className="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                Quiz
              </Link>
              <Link to="/surveys" className="text-gray-700 hover:text-blue-600 px-3 py-2 rounded-md text-sm font-medium">
                Sondages
              </Link>

              {isAuthenticated ? (
                <div className="flex items-center gap-2 ml-2 pl-2 border-l border-gray-200">
                  <Link to="/favorites" className="text-gray-700 hover:text-red-500 px-2 py-2 text-sm" title="Mes favoris">
                    ❤️
                  </Link>
                  <Link to="/profile" className="text-sm font-medium text-gray-700 hover:text-blue-600 px-2">
                    {user?.name || user?.nickname || 'Profil'}
                  </Link>
                  <button onClick={handleLogout} className="btn-secondary text-sm py-1 px-3">
                    Déconnexion
                  </button>
                </div>
              ) : (
                <div className="flex items-center gap-2 ml-2">
                  <Link to="/login" className="btn-secondary text-sm py-1 px-3">Connexion</Link>
                  <Link to="/register" className="btn-primary text-sm py-1 px-3">Inscription</Link>
                </div>
              )}
            </div>

            {/* Burger mobile */}
            <button
              onClick={() => setMenuOpen(!menuOpen)}
              className="md:hidden p-2 text-gray-600 hover:text-blue-600"
            >
              {menuOpen ? '✕' : '☰'}
            </button>
          </div>

          {/* Menu mobile */}
          {menuOpen && (
            <div className="md:hidden py-4 border-t space-y-2">
              <form onSubmit={handleSearch} className="flex gap-2 mb-3">
                <input
                  type="text"
                  value={search}
                  onChange={(e) => setSearch(e.target.value)}
                  placeholder="Rechercher..."
                  className="input-field flex-1 text-sm"
                />
                <button type="submit" className="btn-primary text-sm py-2 px-3">🔍</button>
              </form>
              {[
                { to: '/articles', label: '📰 Articles' },
                { to: '/series',   label: '📺 Séries' },
                { to: '/quizzes',  label: '🎯 Quiz' },
                { to: '/surveys',  label: '📊 Sondages' },
              ].map(({ to, label }) => (
                <Link
                  key={to}
                  to={to}
                  onClick={() => setMenuOpen(false)}
                  className="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md"
                >
                  {label}
                </Link>
              ))}
              {isAuthenticated ? (
                <>
                  <Link to="/favorites" onClick={() => setMenuOpen(false)} className="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">❤️ Favoris</Link>
                  <Link to="/profile" onClick={() => setMenuOpen(false)} className="block px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">👤 Profil</Link>
                  <button onClick={() => { handleLogout(); setMenuOpen(false); }} className="block w-full text-left px-3 py-2 text-red-600 hover:bg-red-50 rounded-md">
                    Déconnexion
                  </button>
                </>
              ) : (
                <div className="flex gap-2 px-3 pt-2">
                  <Link to="/login" onClick={() => setMenuOpen(false)} className="btn-secondary flex-1 text-center text-sm">Connexion</Link>
                  <Link to="/register" onClick={() => setMenuOpen(false)} className="btn-primary flex-1 text-center text-sm">Inscription</Link>
                </div>
              )}
            </div>
          )}
        </div>
      </nav>

      {/* ── Contenu ─────────────────────────────────────────────────────────── */}
      <main className="flex-1 max-w-7xl w-full mx-auto py-8 px-4 sm:px-6 lg:px-8">
        {children}
      </main>

      {/* ── Footer ──────────────────────────────────────────────────────────── */}
      <footer className="bg-white border-t mt-auto">
        <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <div className="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
            <p>© 2026 iSeries-TV — Tous droits réservés</p>
            <div className="flex gap-4">
              <Link to="/series"   className="hover:text-blue-600">Séries</Link>
              <Link to="/articles" className="hover:text-blue-600">Articles</Link>
              <Link to="/quizzes"  className="hover:text-blue-600">Quiz</Link>
              <Link to="/surveys"  className="hover:text-blue-600">Sondages</Link>
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default Layout;
