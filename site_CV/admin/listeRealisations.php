<?php

require_once '../inc/init.php';
require_once '../inc/headerAdmin.php';

// SUPPRESSION

// debug($_GET);

if (isset($_GET['id_realisation'])) { // s'il y a des "id_realisation" dans $_GET donc dans l'URL
    $resultat = $pdo->prepare('DELETE FROM realisations WHERE id_realisation = :id_realisation');
    $resultat->execute( array(':id_realisation' => $_GET['id_realisation']));

    // debug($resultat->rowCount()); // On obtient 1 lors de la suppression d'un competences.

    if ($resultat->rowCount() == 1){ // Si le DELETE retourne une ligne c'est que la requête a marché.
        $contenu .= '<div class="alert alert-success">Suppression réussie.</div>';
    }else {
        $contenu .= '<div class="alert alert-danger">Echec de la suppression.... </div>';
    }
}

// 1 - Afficher les competences 

$resultat = executeRequete("SELECT * FROM realisations");
// debug($resultat);
// ---------------------------------------------
?>

<h1 class="mt-4">Gestion des données</h1>
    <ul class="nav nav-tabs">
        <li class="nav-link"><a href="listeCompetences.php">Liste des compétences</a></li>
        <li class="nav-link"><a href="listeRealisations.php">Liste des réalisations</a></li>
        <li class="nav-link"><a href="listeExperiences.php">Listes des expériences</a></li>
        <li class="nav-link"><a href="listeFormations.php">Liste des formations</a></li>
    </ul>

<table class="table table-striped">
     <thead>
         <tr>
            <th scope="col">ID</th>
            <th scope="col">Titre</th>
            <th scope="col">Description</th>
            <th scope="col">image</th>
            <th scope="col">Action</th>
            </tr>
    </thead>
    <tbody> 
<?php
while($realisations = $resultat->fetch(PDO::FETCH_ASSOC)){ ?>
    <tr>
    <td> <?=$realisations['id_realisation'] ?> </td>
    <td> <?=$realisations['titre'] ?> </td>
    <td> <?=$realisations['intro'] ?> </td>
    <td><img src=" <?=$realisations['img'] ?>" style="width:80px" alt=""></td>
    <td><a href="formRealisations.php?id_realisation=<?=$realisations['id_realisation']?>&action=modifier">Modifier</a> | <a href="?id_realisation=<?= $realisations['id_realisation']?> "onclick="return confirm(\'Etes-vous certain de vouloir supprimer cette realisation ?\');">Supprimer </a></td>
    </tr>
    <?php } ?>

    </tbody>
 </table>
 
<?php  require_once '../inc/footerAdmin.php'; ?>