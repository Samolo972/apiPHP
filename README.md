# apiPHP
Ceci est une API développée en PHP natif avec une approche orientée objet (POO), permettant de gérer une liste d'exercices de musculation. L'API offre des fonctionnalités complètes pour afficher, ajouter, modifier et supprimer des exercices de musculation. 

gérer une liste d'exercices de musculation. L'API offre des fonctionnalités complètes pour afficher, ajouter, modifier et supprimer des exercices. Voici un aperçu des principales opérations disponibles :

Opérations Disponibles
Afficher les Exercices

Méthode HTTP: GET
Endpoint: /api/exercices/read
Description: Récupère la liste complète des exercices de musculation. Les données sont retournées au format JSON.
Ajouter un Exercice

Méthode HTTP: POST
Endpoint: /api/exercices/create
Description: Ajoute un nouvel exercice à la base de données. Les détails de l'exercice doivent être envoyés en JSON dans le corps de la requête.
Modifier un Exercice

Méthode HTTP: PUT
Endpoint: /api/exercices/update
Description: Met à jour les informations d'un exercice existant. L'exercice à mettre à jour est spécifié par son identifiant (id). Les nouvelles données doivent être envoyées en JSON dans le corps de la requête.
Supprimer un Exercice

Méthode HTTP: DELETE
Endpoint: /api/exercices/delete
Description: Supprime un exercice de la base de données. L'exercice à supprimer est spécifié par son identifiant (id), qui doit être envoyé en JSON dans le corps de la requête.
Exemples de Requêtes
Afficher les Exercices
