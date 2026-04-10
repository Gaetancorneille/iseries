# 📺 iSeries-TV — Plateforme moderne de séries TV

Application web fullstack de gestion et découverte de séries TV, avec système d'articles, quiz, sondages et favoris.

## 🛠 Stack technique

| Couche | Technologies |
|--------|-------------|
| **Backend** | Laravel 10 · PHP 8.1+ · MySQL 8 · JWT Auth · Redis |
| **Frontend** | React 18 · Vite · Redux Toolkit · Tailwind CSS · Axios |
| **Infrastructure** | Docker · Docker Compose |
| **Tests** | PHPUnit 10 · 64 tests · SQLite en mémoire |

## ✨ Fonctionnalités

### Contenu
- Catalogue de séries avec saisons, épisodes et acteurs
- Articles de blog avec pagination infinie
- Recherche globale (séries, articles, acteurs)
- Système de favoris par utilisateur

### Interaction
- **Quiz** interactifs : timer, navigation par dots, résultat détaillé
- **Sondages** : questions multi-choix, texte libre, notation par étoiles
- Bouton favori ❤️ avec toggle en temps réel

### Sécurité
- Authentification **JWT stateless**
- Routes protégées côté frontend (`PrivateRoute` / `GuestRoute`)
- Restauration automatique de session au rechargement
- Propriété des ressources vérifiée (seul l'auteur peut modifier/supprimer son article)

---

## 🗂 Structure du projet

```
iseries-modern/
├── backend/                  # API Laravel 10
│   ├── app/
│   │   ├── Http/Controllers/Api/
│   │   │   ├── AuthController.php
│   │   │   ├── ArticleController.php
│   │   │   ├── SeriesController.php
│   │   │   ├── SeasonController.php
│   │   │   ├── EpisodeController.php
│   │   │   ├── SearchController.php
│   │   │   ├── FavoriteController.php
│   │   │   ├── QuizController.php
│   │   │   └── SurveyController.php
│   │   └── Models/           # 14 modèles Eloquent
│   ├── database/
│   │   ├── migrations/       # 16 migrations
│   │   ├── seeders/          # Données de démo
│   │   └── factories/        # 6 factories pour les tests
│   ├── routes/api.php        # Routes versionnées /api/v1
│   ├── tests/Feature/        # 64 tests PHPUnit
│   └── phpunit.xml
├── frontend/                 # SPA React 18
│   └── src/
│       ├── pages/            # 13 pages
│       ├── components/       # Layout, Cards, Spinner...
│       ├── store/            # Redux (auth)
│       └── utils/api.js      # 9 modules Axios
├── docker-compose.yml
└── .gitignore
```

---

## 🚀 Installation

### Prérequis

- Docker & Docker Compose
- PHP 8.1+ et Composer
- Node.js 18+

### 1. Cloner le dépôt

```bash
git clone https://github.com/Gaetancorneille/iseries-modern.git
cd iseries-modern
```

### 2. Démarrer les services Docker

```bash
docker-compose up -d
```

Cela démarre MySQL 8 sur le port `3306` et Redis sur le port `6379`.

### 3. Configurer et démarrer le backend

```bash
cd backend

# Installer les dépendances
composer install

# Copier et configurer l'environnement
cp .env.example .env
# Éditer .env : DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD, JWT_SECRET

# Générer les clés
php artisan key:generate
php artisan jwt:secret

# Créer les tables et insérer les données de démo
php artisan migrate --seed

# Lancer le serveur
php artisan serve
```

L'API est disponible sur `http://localhost:8000`

### 4. Configurer et démarrer le frontend

```bash
cd frontend

# Installer les dépendances
npm install

# Copier et configurer l'environnement
cp .env.example .env
# Vérifier que VITE_API_URL=http://localhost:8000/api/v1

# Lancer le serveur de développement
npm run dev
```

L'application est disponible sur `http://localhost:5173`

---

## 🔑 Variables d'environnement

**Backend (`backend/.env`)**

```env
APP_NAME=iSeries-TV
APP_ENV=local
APP_KEY=             # généré par php artisan key:generate
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iseries
DB_USERNAME=iseries_user
DB_PASSWORD=iseries_password

JWT_SECRET=          # généré par php artisan jwt:secret

REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

**Frontend (`frontend/.env`)**

```env
VITE_API_URL=http://localhost:8000/api/v1
VITE_APP_NAME=iSeries-TV
```

---

## 📡 API Reference

Base URL : `http://localhost:8000/api/v1`

> 🔓 Public — accessible sans authentification  
> 🔒 Protégé — header `Authorization: Bearer <token>` requis

### Auth

| Méthode | Endpoint | Accès | Description |
|---------|----------|-------|-------------|
| `POST` | `/register` | 🔓 | Inscription |
| `POST` | `/login` | 🔓 | Connexion → retourne JWT |
| `POST` | `/logout` | 🔒 | Déconnexion |
| `GET` | `/me` | 🔒 | Profil de l'utilisateur connecté |

### Séries

| Méthode | Endpoint | Accès | Description |
|---------|----------|-------|-------------|
| `GET` | `/series` | 🔓 | Liste paginée (`?search=`, `?genre=`, `?active_only=true`) |
| `GET` | `/series/{id}` | 🔓 | Détail + saisons + épisodes + acteurs |
| `POST` | `/series` | 🔒 | Créer une série |
| `PUT` | `/series/{id}` | 🔒 | Modifier |
| `DELETE` | `/series/{id}` | 🔒 | Supprimer |

### Saisons & Épisodes

| Méthode | Endpoint | Accès | Description |
|---------|----------|-------|-------------|
| `GET` | `/series/{id}/seasons` | 🔓 | Saisons d'une série |
| `GET` | `/series/{id}/seasons/{n}` | 🔓 | Détail saison + épisodes |
| `GET` | `/series/{id}/seasons/{n}/episodes` | 🔓 | Épisodes d'une saison |
| `GET` | `/series/{id}/seasons/{n}/episodes/{n}` | 🔓 | Détail épisode + nav précédent/suivant |
| `POST/PUT/DELETE` | idem | 🔒 | CRUD épisodes |

### Articles

| Méthode | Endpoint | Accès | Description |
|---------|----------|-------|-------------|
| `GET` | `/articles` | 🔓 | Liste paginée (publiés uniquement) |
| `GET` | `/articles/{id}` | 🔓 | Détail |
| `POST` | `/articles` | 🔒 | Créer (auteur = utilisateur connecté) |
| `PUT` | `/articles/{id}` | 🔒 | Modifier (auteur uniquement) |
| `DELETE` | `/articles/{id}` | 🔒 | Supprimer (auteur uniquement) |

### Recherche

| Méthode | Endpoint | Accès | Description |
|---------|----------|-------|-------------|
| `GET` | `/search?q=...&type=all` | 🔓 | Recherche globale (`type`: `all`, `series`, `articles`, `actors`) |

### Favoris

| Méthode | Endpoint | Accès | Description |
|---------|----------|-------|-------------|
| `GET` | `/favorites` | 🔒 | Mes favoris |
| `POST` | `/favorites` | 🔒 | Ajouter (`series_id`) |
| `DELETE` | `/favorites/{seriesId}` | 🔒 | Retirer |
| `POST` | `/favorites/toggle` | 🔒 | Ajouter ou retirer selon l'état |
| `GET` | `/favorites/check/{seriesId}` | 🔒 | Vérifier si en favori |

### Quiz & Sondages

| Méthode | Endpoint | Accès | Description |
|---------|----------|-------|-------------|
| `GET` | `/quizzes` | 🔒 | Liste paginée |
| `POST` | `/quizzes/{id}/start` | 🔒 | Démarrer une tentative |
| `POST` | `/quizzes/attempts/{id}/submit` | 🔒 | Soumettre les réponses |
| `GET` | `/quizzes/{id}/results` | 🔒 | Statistiques (créateur uniquement) |
| `GET` | `/surveys` | 🔒 | Sondages actifs |
| `POST` | `/surveys/{id}/submit` | 🔒 | Répondre à un sondage |

---

## 🧪 Tests

```bash
cd backend

# Lancer tous les tests
php artisan test

# Avec détail
php artisan test --testdox

# Suite spécifique
php artisan test --testsuite=Feature

# Fichier spécifique
php artisan test tests/Feature/AuthTest.php
```

**Résumé des tests (64 au total)**

| Fichier | Tests | Couverture |
|---------|-------|------------|
| `AuthTest` | 11 | Inscription, connexion, logout, `/me` |
| `ArticleTest` | 11 | CRUD, ownership, validation |
| `SeriesTest` | 11 | CRUD, filtres, relations |
| `FavoriteTest` | 10 | Toggle, isolation par user, doublons |
| `SearchTest` | 9 | Filtres, types, structure JSON |
| `SeasonEpisodeTest` | 12 | CRUD, nav prev/next, compteurs |

> Les tests utilisent **SQLite en mémoire** et `RefreshDatabase` — chaque test repart d'une base vierge.

---

## 🗃 Modèle de données

```
users ──────────────────────────────────────────────────────────┐
  │                                                              │
  ├── articles (author_id)                                       │
  ├── favorites ─── series ──── seasons ──── episodes           │
  ├── quiz_attempts ─── quiz_answers                             │
  └── survey_responses ─── survey_answers                        │
                                                                 │
series ──── series_actors ──── actors                           │
       ──── quizzes ──── quiz_questions                          │
       ──── seasons ──── episodes                                │
                                                                 │
surveys ──── survey_questions                                    │
        ──── survey_responses (user_id) ──────────────────────── ┘
```

---

## 📁 Pages frontend

| Route | Page | Accès |
|-------|------|-------|
| `/` | Accueil dynamique (articles + séries récents) | Public |
| `/series` | Catalogue avec pagination | Public |
| `/series/:id` | Détail + saisons + acteurs + quiz | Public |
| `/articles` | Liste des articles | Public |
| `/articles/:id` | Lecture d'un article | Public |
| `/search` | Recherche globale | Public |
| `/quizzes` | Liste des quiz | Connecté |
| `/quizzes/:id` | Player quiz complet | Connecté |
| `/surveys` | Sondages actifs | Connecté |
| `/favorites` | Mes séries favorites | Connecté |
| `/profile` | Mon profil | Connecté |
| `/login` | Connexion | Invité |
| `/register` | Inscription | Invité |

---

## 👤 Auteur

**Gaetan Corneille Embong Kayo**  
Étudiant en Licence d'Ingénieur Informatique — Analyste Programmeur  
Université Saint Jean Paul II de Yaoundé

[![GitHub](https://img.shields.io/badge/GitHub-Gaetancorneille-181717?logo=github)](https://github.com/Gaetancorneille)
[![Email](https://img.shields.io/badge/Email-gaetanembong681@gmail.com-blue?logo=gmail)](mailto:gaetanembong681@gmail.com)

---

## 📄 Licence

Ce projet est sous licence **MIT**.
