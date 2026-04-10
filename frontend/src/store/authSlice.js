import { createSlice } from '@reduxjs/toolkit';
import { jwtDecode } from 'jwt-decode';

// Vérifie si le token stocké est encore valide
const getInitialAuthState = () => {
  const token = localStorage.getItem('token');
  if (!token) return { user: null, token: null, isAuthenticated: false };

  try {
    const decoded = jwtDecode(token);
    const isExpired = decoded.exp * 1000 < Date.now();
    if (isExpired) {
      localStorage.removeItem('token');
      return { user: null, token: null, isAuthenticated: false };
    }
    // Token valide : on restaure l'état authentifié
    return { user: decoded, token, isAuthenticated: true };
  } catch {
    localStorage.removeItem('token');
    return { user: null, token: null, isAuthenticated: false };
  }
};

const initialState = getInitialAuthState();

const authSlice = createSlice({
  name: 'auth',
  initialState,
  reducers: {
    loginSuccess: (state, action) => {
      state.user = action.payload.user;
      state.token = action.payload.token;
      state.isAuthenticated = true;
      localStorage.setItem('token', action.payload.token);
    },
    logout: (state) => {
      state.user = null;
      state.token = null;
      state.isAuthenticated = false;
      localStorage.removeItem('token');
    },
    setUser: (state, action) => {
      state.user = action.payload;
      state.isAuthenticated = true;
    },
  },
});

export const { loginSuccess, logout, setUser } = authSlice.actions;
export default authSlice.reducer;