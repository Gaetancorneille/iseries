import React from 'react';
import { useSelector } from 'react-redux';

const Profile = () => {
  const { user } = useSelector((state) => state.auth);

  if (!user) {
    return (
      <div className="card text-center">
        <h2 className="text-2xl font-bold mb-4">Profil</h2>
        <p className="text-gray-600">Vous devez être connecté pour voir votre profil.</p>
      </div>
    );
  }

  return (
    <div className="card">
      <h2 className="text-2xl font-bold mb-6">Mon Profil</h2>
      <div className="space-y-4">
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Nom</label>
          <div className="input-field bg-gray-50">{user.name}</div>
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Email</label>
          <div className="input-field bg-gray-50">{user.email}</div>
        </div>
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-1">Pseudo</label>
          <div className="input-field bg-gray-50">{user.nickname}</div>
        </div>
      </div>
    </div>
  );
};

export default Profile;