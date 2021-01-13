<?php

require_once '../inc/init.php';
// ---------------------------------------------

// SUPPRESSION
// debug($_GET);

if (isset($_GET['id_formation'])) { // s'il y a des "id_formation" dans $_GET donc dans l'URL
    $resultat = $pdo->prepare('DELETE FROM formations WHERE id_formation = :id_formation');
    $resultat->execute( array(':id_formation' => $_GET['id_formation']));

    // debug($resultat->rowCount()); // On obtient 1 lors de la suppression d'un competences.

    if ($resultat->rowCount() == 1){ // Si le DELETE retourne une ligne c'est que la requête a marché.
        $contenu .= '<div class="alert alert-success">Suppression réussie.</div>';
    }else {
        $contenu .= '<div class="alert alert-danger">Echec de la suppression.... </div>';
    }
}

// 1 - Afficher les competences 

$resultat = executeRequete("SELECT * FROM formations");
// debug($resultat);
$contenu .= '<table class="table">';
    // Les entêtes 
    $contenu .= '<tr>';
        $contenu .= '<th>ID</th>';
        $contenu .= '<th>Annee</th>';
        $contenu .= '<th>Nom et description</th>';
    $contenu .= '</tr>';

while($formations = $resultat->fetch(PDO::FETCH_ASSOC)){
    $contenu .= '<tr>'; // On créé une ligne  par compétence
    foreach($formations as $indice => $information) { // $information parcours les valeurs de $formations
        $contenu .= '<td>' . $information . '</td>';
    }
    $contenu .= '<td>
            <a href="formformations.php?id_formation=' . $formations['id_formation'] . '">action=modifier</a>
             | <a href="?id_formation=' . $formations['id_formation'] . '"onclick="return confirm(\'Etes-vous certain de vouloir supprimer cette donnée ?\');">Supprimer </a>
                </td>';
 $contenu .= '</tr>';
}

$contenu .= '</table>';

require_once '../inc/headerAdmin.php';
?>

  <h1 class="mt-4">Gestion des données</h1>
    <ul class="nav nav-tabs">
        <li class="nav-link"><a href="listeCompetences.php">Liste des compétences</a></li>
        <li class="nav-link"><a href="listeRealisations.php">Liste des réalisations</a></li>
        <li class="nav-link"><a href="listeExperiences.php">Listes des expériences</a></li>
        <li class="nav-link"><a href="listeFormations.php">Liste des formations</a></li>
    </ul>
    
  
<?php 
echo $contenu; // Pour afficher les messages et le tableau des competencess. 
require_once '../inc/footerAdmin.php';
?>