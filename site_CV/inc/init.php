<?php
// Ce fichier init.php sera inclus dans tout les scripts du site(hors inclusions) pour initialiser les éléments nécessaires au fonctionnement du site.

// Connexion à la BDD boutique.
$pdo = new PDO('mysql:host=localhost;dbname=site_cv', // Le driver "mysql" + le serveur de la BDD + le nom de la BDD 
'root', // pseudo de la BDD
'', // mot de passe
array( // les options
    PDO::ATTR_ERRMODE => PDO ::ERRMODE_WARNING, // options 1: pour afficher les erreurs mysql dans le navigateur.
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' // option 2 : pour définir le jeu de caractère des échanges avec la BDD.
));

// Session
session_start(); // Crée un fichier appelé session sur le serveur dans lequel on stockes des données : celles du membre ou de son panier.Si la session existe déjà, on y accède directement à l'aide de l'identifiant reçu dans un cookie depuis le navigateur de l'internaute.

// Constante qui contient le chemin du site.
define('RACINE_SITE','/site_cv/'); // Ici, on indique le dossier dans lequel se trouve le site à partir de "localhost".S'il n'est dans aucun dossier , on met un "/" seul.Permet de créer des chemins absollus à partir de "localhost".Rappel: le "/" au début du chemin caractérise un chemin absolu.

// Initialisation d'une variable pour afficher du contenu HTML/
$contenu = ''; // On y mettra du HTML.

// Inclusion des fonctions :
require_once 'functions.php';
?>

