# Documentation de l'Architecture iSeries-TV Actuelle

## 1. Structure Générale

### Organisation des dossiers
```
iseries/
├── assets/           # Ressources statiques
│   ├── css/         # Feuilles de style
│   ├── images/      # Images et médias
│   └── js/          # Scripts JavaScript
├── config/          # Configuration de l'application
├── includes/        # Fichiers inclus (auth, database, etc.)
├── modules/         # Modules fonctionnels
│   ├── articles/    # Gestion des articles
│   ├── streaming/   # Système de streaming
│   └── surveys/     # Sondages
├── public/          # Points d'entrée publics
└── Nouveau dossier/ # Données et scripts SQL
```

## 2. Architecture Backend

### Technologies utilisées
- **PHP 8.2+** : Langage principal
- **MySQL/MariaDB** : Base de données
- **PDO** : Interface de base de données
- **Sessions PHP** : Gestion des sessions utilisateur

### Structure MVC personnalisée
- **Modèles** : Classes Database dans `includes/database.php`
- **Vues** : Fichiers PHP avec HTML mélangé
- **Contrôleurs** : Fichiers PHP dans chaque module

### Système d'authentification
- Sessions PHP natives
- Protection CSRF basique
- Validation des entrées utilisateur
- Redirections sécurisées

### Configuration
Fichier `config/config.php` :
- Paramètres de base de données
- Configuration du site
- Paramètres de session
- Gestion des erreurs

## 3. Architecture Frontend

### Technologies
- **CSS3** : Design personnalisé avec variables CSS
- **JavaScript vanilla** : Interactions utilisateur
- **Font Awesome** : Icônes

### Design système
- Palette de couleurs : Blanc et bleu clair
- Typographie : Segoe UI
- Responsive design : Media queries
- Animations : Transitions CSS

### Composants principaux
- Header avec recherche
- Navigation
- Cartes d'articles
- Grille de séries
- Formulaires stylisés

## 4. Base de données

### Structure principale
Selon le fichier `stage.sql`, les tables principales sont :
- `users` : Gestion des utilisateurs
- `articles` : Contenu des articles
- `series` : Informations sur les séries
- `seasons` : Saisons des séries
- `episodes` : Épisodes individuels
- `actors` : Acteurs
- `surveys` : Sondages

### Relations
- Système de clés étrangères pour les relations
- Structure normalisée
- Index sur les colonnes fréquemment recherchées

## 5. Sécurité

### Mesures en place
- Protection CSRF
- Validation des entrées
- Sessions sécurisées
- Redirections HTTP appropriées
- Sanitization HTML

### Limites
- Pas de rate limiting
- Validation basique seulement
- Pas de protection avancée DDoS
- Sécurité des sessions basique

## 6. Performance

### Optimisations actuelles
- CSS minifié
- JavaScript optimisé
- Images optimisées
- Structure de cache basique

### Limites
- Pas de CDN
- Pas de caching avancé
- Pas d'optimisation base de données
- Pas de compression assets

## 7. Fonctionnalités principales

### Authentification
- Connexion/déconnexion
- Inscription
- Sessions persistantes

### Contenu
- Articles sur les séries
- Catalogue de séries
- Système de streaming
- Sondages interactifs

### Navigation
- Menu principal
- Recherche
- Navigation par catégories

## 8. Points forts de l'architecture existante

1. **Structure modulaire** : Organisation claire par fonctionnalités
2. **Séparation des préoccupations** : MVC personnalisé
3. **Responsive design** : Bonne adaptation mobile
4. **Sécurité basique** : Protection CSRF et validation
5. **Design cohérent** : Système de design unifié

## 9. Limites techniques identifiées

1. **Architecture procédurale** : Difficile à maintenir à long terme
2. **Pas de framework** : Gestion manuelle des dépendances
3. **Performance limitée** : Pas d'optimisations avancées
4. **Sécurité basique** : Protection minimale
5. **Pas de tests automatisés** : Fiabilité limitée
6. **Déploiement manuel** : Processus complexe

## 10. Données de migration

### Contenu à préserver
- Articles existants
- Informations sur les séries
- Données utilisateurs
- Sondages et réponses
- Médias (images, vidéos)

### Structure à transformer
- Migration vers ORM moderne
- Normalisation des données
- Optimisation des relations
- Indexation améliorée

Cette documentation servira de base pour la migration vers l'architecture moderne.