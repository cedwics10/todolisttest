# Todolist PHP - Application Fullstack

## Démarrage de l'application

Pour démarrer l'application, suivez ces étapes :

```bash
# 1. Placez-vous à la racine du projet
cd /chemin/vers/todolistphp
```

```bash
# 2. Construisez et démarrez les services en arrière‑plan
docker compose up -d
```

Après quelques instants, les services seront disponibles :
- **Symfony (backend)** : http://localhost:8080
- **Vue (frontend)** : http://localhost:5173
- **PostgreSQL** : localhost:5432 (identifiants : `app` / `app` / base `app`)

> **Astuce** : pour voir les logs en temps réel, utilisez `docker compose logs -f`.

## Installation et prérequis

### Prérequis

- [Docker Desktop](https://www.docker.com/products/docker-desktop) (ou Docker Engine + Docker Compose)
- Git (optionnel, pour cloner le dépôt)

### Étapes d'installation

```bash
# 1. Clonez le dépôt
git clone <URL-du-dépot>
cd todolistphp
```

```bash
# 2. (Optionnel) Configurez l'environnement backend
# Copiez le fichier d'exemple et adaptez‑le si nécessaire
cp backend/.env.example backend/.env.local
# Éditez backend/.env.local pour surcharger les variables d'environnement
```

```bash
# 3. Démarrez l'application
docker compose up -d
```

Lors du premier démarrage, l’image PHP sera construite (cela peut prendre 1‑2 minutes). Ensuite, les migrations de base de données sont exécutées automatiquement.

## 📦 Services lancés

| Service          | URL                              | Description                                   |
|------------------|----------------------------------|-----------------------------------------------|
| Symfony (backend) | http://localhost:8080            | Application Symfony servie via Nginx          |
| Vue (frontend)   | http://localhost:5173            | Application Vue en mode développement (Vite) |
| PostgreSQL       | localhost:5432 (user: `app`, password: `app`, DB: `app`) | Base de données |
| PHP‑FPM          | interne sur le port 9000         | Utilisé par Nginx en FastCGI                  |

## Arrêt et nettoyage

```bash
# Arrêter les conteneurs
docker compose down

# Supprimer aussi les volumes (perd la base de données)
docker compose down -v
```

## Accès aux logs

- Symfony (dev) : `docker compose logs symfony_php`
- Nginx : `docker compose logs symfony_nginx`
- Vue (Vite) : `docker compose logs vue_frontend`
- PostgreSQL : `docker compose logs postgres_db`

## Développement

### Backend (Symfony)

- Ouvrez un shell dans le conteneur PHP :
  ```bash
  docker compose exec symfony_php sh
  ```
- Utilisez les commandes Symfony habituelles :
  ```bash
  php bin/console cache:clear
  php bin/console make:controller
  php bin/console make:entity
  ```
- Le code source est monté en volume sous `./backend` → les modifications sont immédiatement visibles.

### Frontend (Vue)

- Ouvrez un shell dans le conteneur Node :
  ```bash
  docker compose exec vue_frontend sh
  ```
- Les commandes npm sont disponibles :
  ```bash
  npm run dev          # démarre le serveur Vite (déjà lancé par docker compose)
  npm run build        # crée une version de production dans ./frontend/dist
  ```
- Le code source est monté en volume sous `./frontend` → les modifications sont visibles instantanément grâce au hot‑module‑replacement de Vite.

## Structure du projet

```
.
├── backend/                 # Code Symfony
│   ├── config/
│   ├── src/
│   ├── templates/
│   ├── var/
│   └── ...
├── frontend/                # Code Vue + Vite
│   ├── src/
│   ├── public/
│   └── ...
├── docker/
│   ├── php/
│   │   └── Dockerfile       # Image PHP‑FPM personnalisée
│   └── nginx/
│       └── default.conf     # Configuration Nginx
├── docker-compose.yml       # Orchestration des services
├── README.md                # Ce fichier
└── .gitignore
```

## Configuration (variables d’environnement)

Le fichier `.env` à la racine du backend contient les valeurs par défaut utilisées par Symfony :

```dotenv
###> symfony/framework-bundle ###
APP_ENV=dev
APP_SECRET=
APP_SHARE_DIR=var/share
###< symfony/framework-bundle ###

###> doctrine/doctrine-bundle ###
# Format décrit dans docker-compose.yml :
DATABASE_URL=postgresql://app:app@database:5432/app?serverVersion=16&charset=utf8
###< doctrine/doctrine-bundle ###
```

Pour surcharger en local (non versionné), créez un fichier `.env.local` dans le répertoire `backend/`.