# 🔗 Link Shortener – Projet Web

Projet de **raccourcisseur de liens** (type bit.ly) réalisé avec une architecture **full Docker**, comprenant un **frontend React**, un **backend PHP** et une **base de données PostgreSQL 17**.

---

## 🚀 Fonctionnalités

* Raccourcissement d’URL
* Génération automatique de liens courts
* Redirection depuis un lien court vers l’URL originale
* Interface web responsive
* API REST
* Tests automatisés via GitHub Actions
* Déploiement simplifié avec Docker

---

## 🧰 Stack technique

* **Frontend** : React
* **Backend** : PHP
* **Base de données** : PostgreSQL 17
* **Conteneurisation** : Docker & Docker Compose
* **CI/CD** : GitHub Actions
* **Tests** :
  * Shell (backend)
  * Jest (frontend)

---

## 🧠 Fonctionnement du raccourcissement

Les liens raccourcis sont générés sous la forme :

```
http://localhost:8000/{code}
```

* `{code}` est une chaîne de **25 caractères**
* Composée de :
  * Lettres majuscules
  * Lettres minuscules
  * Chiffres (`A–Z`, `a–z`, `0–9`)
* Chaque code est unique et stocké en base de données

---

## 📦 Architecture du projet

```
link-shortener/
│
├── backend/        # API PHP
├── frontend/       # Application React
├── db/             # Initialisation PostgreSQL
├── .github/
│   └── workflows/  # GitHub Actions (CI)
├── docker-compose.yml
└── README.md
```

---

## ▶️ Lancer le projet

### Prérequis

* Docker
* Docker Compose

### Démarrage

```bash
docker-compose up --build
```

### Accès

* Frontend : [http://localhost:3000](http://localhost:3000)
* Backend API : [http://localhost:8000](http://localhost:8000)
* Base de données : localhost:5432

---

## 🔌 API

### Raccourcir une URL

**POST** `/reduce`

```json
{
  "url": "https://www.google.com"
}
```

**Réponse**

```json
{
  "short_url": "http://localhost:8000/AbC123..."
}
```

---

## 🧪 Tests & CI

Les tests sont exécutés automatiquement via **GitHub Actions** à chaque `push` et `pull_request`.

* Backend : tests unitaires Shell
* Frontend : tests Jest

---

## 📝 Auteur

Développé avec passion par [C-Lilian](https://lilian-cleret.com) 🥋.Projet réalisé dans le cadre d’un exercice technique.
