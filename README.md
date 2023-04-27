# Énoncé de la SAÉ S4.A.01 Développement d'application
 
L’objectif de cette SAÉ (=projet en groupe. Vocabulaire faisant partie du référentiel du [B.U.T Informatique](https://www.but-genie-mecanique.fr/sae/)) sera de réaliser un site de gestion d’une ludothèque. Il sera possible de consulter la collection de jeux, regarder les jeux de la base de données, ajouter le dernier jeu acheté, …

La première phase concernera la mise en place d’un back-end qui s’appuiera sur un serveur Restful API.


# Installation
Afin de pouvoir lancer le serveur, il faut premièrement lancer la commande :
`composer install`
ensuite il est possible de lancer la commande
`php artisan serve`

Afin de voir les résultats des requêtes vous pouvez utiliser le fichier resquests_example.json dans le dossier Insomnia.


## Introduction

Pour bâtir notre serveur Restful API, nous allons utiliser le cadriciel Laravel. Comme la notion du rôle de visiteur du site sera omniprésente, il est important d’aborder rapidement la couche identification, authentification et gestion des droits d’accès. Dans les sections suivantes les droits en fonction du rôle de l’utilisateur vous seront précisés.

Comme nous l’avons précisé pendant les séances de travaux pratiques, la documentation des points d’accès aux informations accessibles est indispensable pour la réalisation de clients. À chaque requête, on mentionnera le format attendu et le format des données retournées en réponse.

## La gestion des adhérents

Comme on utilise le cadriciel Laravel, la gestion des adhérents se fera à l’aide de la table users. Il faudra adapter le contenu de la table pour correspondre au modèle conceptuel de l’entité Adherent.

### L’enregistrement d’un adhérent
Le serveur accepte des requêtes de demande d’adhésion à la ludothèque. Dans cette requête, on récupérera les informations de création d’un adhérent du service (login, email, password,nom, prenom, pseudo). Un avatar par défaut sera associé au nouvel adhérent.

### Demande de connexion au serveur
Le serveur accepte des requêtes de demande de connexion au serveur (email, password). L’utilisateur identifié aura un role (voir plus bas) et en fonction de celui-ci il aura le droit d’effectuer certaines actions.

### Demande de déconnexion au serveur
Le serveur accepte des requêtes de déconnexion au serveur. Si l’utilisateur est connecté il pourra demander à être déconnecté.

### Demande de modification de l’avatar
Le serveur accepte des requêtes de téléversement d’une image qui représentera l’avatar de l’utilisateur. Si l’utilisateur est connecté il pourra modifier son avatar.

### Profil d’un adhérent
Le serveur accepte des requêtes de profil de l’utilisateur. Si l’utilisateur est connecté il pourra récupérer son profil avec notamment :
- Le contenu de la table adhérent,
- La liste des commentaires qui aura postés,
- Les achats qu’il aura indiqués (role adhérent-premium),
- Les jeux qu’il a likés.

## Les services disponibles

### La liste des jeux
Le serveur accepte des requêtes sur les jeux répertoriés dans la ludothèque. Si l’utilisateur n’est pas connecté, il ne pourra obtenir qu’une liste aléatoire de 5 jeux. Si l’utilisateur est connecté (role adhérent) :

il pourra lister la totalité des jeux valides.
il pourra filtrer les jeux en fonction de critères comme l’age minimum, la durée de la partie, le nombre de joueurs minimum, maximum.
il pourra lister les cinq jeux les plus ‘likés’.
il pourra lister les cinq jeux les mieux notés.
La création d’un jeu
Le serveur accepte des requêtes de création d’un nouveau jeu. Si l’utilisateur est connecté avec le role adhérent-premium, il pourra ajouter de nouveaux jeux à la ludothèque.

### La modification d’un jeu
Le serveur accepte des requêtes de modification d’un jeu. Si l’utilisateur est connecté avec le role adhérent-premium, il pourra modifier les jeux.

### La vue détaillée d’un jeu
Le serveur accepte des requêtes de la vue détaillée d’un jeu. Si l’utilisateur est connecté (role adhérent), il pourra récupérer la liste des commentaires postés sur le jeu ainsi que la liste des adhérents qui ont acheté le jeu.

### L’achat d’un jeu
Le serveur accepte une requête qui va permettre à un utilisateur connecté avec le role adhérent-premium d’indiquer l’achat d’un jeu.

### Like/Unlike d’un jeu
Le serveur accepte une requête qui va permettre à un utilisateur connecté (role adhérent), de liké ou d’unliké un jeu.

### Création d’un commentaire
Le serveur accepte des requêtes de création d’un commentaire sur un jeu. Si l’utilisateur est connecté (role adhérent), il pourra ajouter un commentaire sur un jeu.

### Modification d’un commentaire
Le serveur accepte des requêtes de modification d’un commentaire. Si l’utilisateur est connecté (role adhérent), il pourra modifier les commentaires qu’il a lui-même ajoutés. Si l’utilisateur est connecté avec le role commentaire-moderateur, il pourra modifier tous les commentaires.

### Suppression d’un commentaire
Le serveur accepte des requêtes de suppression d’un commentaire. Si l’utilisateur est connecté (role adhérent), il pourra supprimer les commentaires qu’il a lui-même ajoutés.

### Variante avec validation des commentaires
Le serveur accepte des requêtes de validation d’un commentaire. Si l’utilisateur est connecté avec le role commentaire-moderateur, il pourra valider les commentaires postés par les adhérents.

Dans cette variante, seuls les commentaires qui ont été validés par un modérateur (état public) seront visibles par les autres adhérents et utilisés pour la notation du jeu.

## Les règles d’accès au système d’information

Notre application va gérer les rôles suivants :

* administrateur : l’utilisateur a tous les droits sur toutes les données du système d’information.
* commentaire-moderateur : l’utilisateur aura le droit de valider un commentaire en plus des droits de l’adhérent.
* adhérent-premium : l’utilisateur aura le droit d’ajouter un nouveau jeu à la ludothèque.
* adherent : l’utilisateur aura l’accès à la liste des jeux répertoriés (utilisation de filtres,…), il pourra créer des commentaires.

On a une relation d’ordre entre les rôles : adherent < adhérent-premium < commentaire-moderateur < administrateur. Cela signifie que si un utilisateur a le rôle commentaire-moderateur il a aussi les rôles adhérent-premium et adherent
