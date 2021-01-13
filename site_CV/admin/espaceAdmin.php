<?php


require_once '../inc/init.php';
// - On vérifie que le membre est bien connecté, sinon on le redirige vers la page de connexion.
if(!isLogged()){
  header('location:../login.php');
  exit;
}
// ---------------------------------------------

require_once '../inc/headerAdmin.php';
?>

  <h1 class="mt-4">Gestion des données</h1>
    <ul class="nav nav-tabs">
        <li class="nav-link"><a href="listeCompetences.php">Liste des compétences</a></li>
        <li class="nav-link"><a href="listeRealisations.php">Liste des réalisations</a></li>
        <li class="nav-link"><a href="listeExperiences.php">Listes des expériences</a></li>
        <li class="nav-link"><a href="listeFormations.php">Liste des formations</a></li>
    </ul>

    <p> Cliquez sur un des onglet pour afficher les données de la table.</p>
    
  
<?php 
echo $contenu; // Pour afficher les messages et le tableau des produits. 
require_once '../inc/footerAdmin.php';
?>