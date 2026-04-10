# Guide de Démarrage Rapide - iSeries-TV

## 🚀 Démarrage en 5 minutes

### 1. Prérequis
```bash
# Vérifier les versions
node --version  # 18+
php --version   # 8.1+
docker --version
docker-compose --version
```

### 2. Installation
```bash
# Cloner le projet
git clone [url-du-projet]
cd iseries-modern

# Démarrer les services Docker
docker-compose up -d

# Backend Laravel
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
php artisan migrate --seed
php artisan serve

# Frontend React (dans un nouveau terminal)
cd frontend
npm install
npm run dev
```

### 3. Accès
- **Frontend** : http://localhost:5173
- **Backend API** : http://localhost:8000
- **MySQL** : localhost:3306
- **Redis** : localhost:6379

## 🎯 Fonctionnalités Disponibles

### Utilisateur
- [x] Inscription / Connexion
- [x] Profil utilisateur
- [x] Navigation intuitive

### Contenu
- [x] Liste des articles (paginée)
- [x] Liste des séries (paginée)
- [x] Détails des contenus
- [x] Design responsive

## 🛠️ Commandes Utiles

### Backend
```bash
# Démarrer le serveur
php artisan serve

# Exécuter les migrations
php artisan migrate

# Générer des données de test
php artisan db:seed

# Lancer les tests
php artisan test

# Générer la documentation API
php artisan l5-swagger:generate
```

### Frontend
```bash
# Démarrer le serveur de développement
npm run dev

# Build pour production
npm run build

# Lancer les tests
npm run test

# Linter
npm run lint
```

### Docker
```bash
# Démarrer tous les services
docker-compose up -d

# Arrêter tous les services
docker-compose down

# Voir les logs
docker-compose logs

# Accéder au container MySQL
docker-compose exec mysql mysql -u iseries_user -p iseries
```

## 📁 Structure du Projet

```
iseries-modern/
├── backend/           # API Laravel
│   ├── app/
│   │   ├── Http/Controllers/Api/
│   │   ├── Models/
│   │   └── Providers/
│   ├── database/migrations/
│   └── routes/api.php
├── frontend/          # Application React
│   ├── src/
│   │   ├── components/
│   │   ├── pages/
│   │   ├── store/
│   │   └── utils/
│   └── tailwind.config.js
├── docs/              # Documentation
└── docker-compose.yml
```

## 🔧 Configuration

### Variables d'Environnement

**Backend (.env)**
```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iseries
DB_USERNAME=iseries_user
DB_PASSWORD=iseries_password

JWT_SECRET=your_jwt_secret_here
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

**Frontend (.env)**
```env
VITE_API_URL=http://localhost:8000/api/v1
VITE_APP_NAME=iSeries-TV
```

## 🐛 Résolution de Problèmes

### Problèmes Courants

**1. Erreur de connexion à la base de données**
```bash
# Vérifier que MySQL est démarré
docker-compose ps

# Recréer les containers
docker-compose down
docker-compose up -d
```

**2. Erreur JWT**
```bash
# Regénérer la clé JWT
php artisan jwt:secret
```

**3. Problèmes de dépendances**
```bash
# Backend
rm -rf vendor/
composer install

# Frontend
rm -rf node_modules/
npm install
```

**4. Erreurs de cache**
```bash
# Backend
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Frontend
npm run build -- --clean
```

## 📚 Ressources

### Documentation
- [Documentation complète](./migration-progress.md)
- [Architecture actuelle](./architecture-actuelle.md)
- [Besoins fonctionnels](./besoins-fonctionnels.md)

### API Endpoints
- `POST /api/v1/register` - Inscription
- `POST /api/v1/login` - Connexion
- `GET /api/v1/articles` - Liste des articles
- `GET /api/v1/series` - Liste des séries

### Technologies
- **Backend** : Laravel 10, MySQL, Redis, JWT
- **Frontend** : React 18, Vite, Tailwind CSS, Redux Toolkit
- **DevOps** : Docker, Docker Compose

## 🎉 Prochaines Étapes

1. **Explorer l'application** : Testez les fonctionnalités existantes
2. **Comprendre le code** : Parcourez les composants et contrôleurs
3. **Ajouter des fonctionnalités** : Consultez le roadmap dans le README
4. **Contribuer** : Suivez les guidelines de développement

## 📞 Support

Pour toute question ou problème :
- Vérifiez d'abord la documentation
- Consultez les logs d'erreurs
- Testez les commandes de résolution ci-dessus
- Contactez l'équipe de développement

---
*Bonne migration vers iSeries-TV moderne !* 🚀