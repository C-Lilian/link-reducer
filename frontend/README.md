# Link Reducer — Frontend

Frontend de l’application **Link Reducer**, développé avec **React**.

Il permet :
- de saisir une URL
- de l’envoyer au backend
- d’afficher le lien raccourci retourné par l’API

## Technologies utilisées

- React
- Axios
- Node.js
- Docker

## Lancement du projet

Le frontend est prévu pour être lancé via **Docker**.

Depuis la racine du projet :

```bash
docker-compose up frontend
````

L’application est ensuite accessible à l’adresse :

```
http://localhost:3000
```

## Communication avec le backend

Le frontend communique avec l’API backend via l’endpoint :

```
POST http://localhost:8000/reduce
```

## Auteur

Développé avec passion par [C-Lilian](https://lilian-cleret.com) 🥋.Projet réalisé dans le cadre d’un exercice technique.
