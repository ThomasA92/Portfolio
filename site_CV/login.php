<?php
require_once 'inc/init.php';


#   1 - Traitement du formulaire
// debug($_POST);

if(!empty($_POST)){ // Si le formulaire a été envoyé

    // Contrôles du formulaire
    if(empty($_POST['pseudo']) || empty($_POST['mdp'])){ // Si le pseudo OU le mdp est vide.
        $contenu .= '<div class=" alert alert-danger">Les identifiants sont obligatoires ! </div>';
    }
//  debug($_POST['pseudo']);

    // Si les champs sont remplis, on vérifie le pseudo puis le MDP en BDD:
        if(empty($contenu)){ // Si la variable est vide, c'est qu'il n'y a pas de message d'erreur.
            $requete = $pdo -> prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
            $requete -> bindParam(':pseudo', $_POST['pseudo']); // 
            $requete -> execute();
            
            
            // if ($resultat->rowCount() ==1){ // SI il y a une ligne de résultats, c'est que le pseudo est dans la BDD: on peut alors vérifier le mdp.
                // debug($resultat);

                 $membre = $requete->fetch(PDO::FETCH_ASSOC); // On "fetch" pour en extraire les données, sans boucle car le pseudo est unique en BDD.
                // debug($membre);

                if ($_POST['mdp'] == $membre['mdp']){ // password_verify() retourne true si le hash de la BDD correspond au mdp du formulaire.
                    // On peut connecter le membre :
                    $_SESSION['membre'] = $membre; // Pour connecter le membre on crée une session appelée "membre" avec toutes les infos du membre qui viennent de la BDD.

                    header('location:admin/espaceAdmin.php'); // Les identifiants étant corrects, on redirige l'utilisateur vers la page espaceAdmin.php.
                    exit; //Et on quitte ce script.
                } else { // Sinon c'est que le MDP est erroné
                    $contenu .= '<div class=" alert alert-danger"> Erreur sur les identifiants ! </div>';
                }

            }else { // Sinon, c'est que le pseudo n'est pas dans la BDD.
                $contenu .= '<div class=" alert alert-danger"> Erreur sur les identifiants ! </div>';
            }
        } // fin du if(!empty($_POST)

// ---------------AFFICHAGE --------------------

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
     <!-- fontawesome-->
  <script src="https://kit.fontawesome.com/2e96f60fd8.js" crossorigin="anonymous"></script>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">*
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <!--  animate on scroll-->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- mon CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  
</head>
<body>
    
</body>
</html>

<h1 class="mt-4">Connexion</h1>

<?php
echo $contenu; // Pour afficher les autres messages.
?>

<form action="" method="post">

    <div><label for="pseudo">Pseudo</label></div>
    <div><input type="text" name="pseudo" id="pseudo"></div>

    <div><label for="mdp">Mot de passe</label></div>
    <div><input type="password" name="mdp" id="mdp"></div>

    <div><input type="submit" value="Se connecter" class="btn btn-success mt-4"></div>

</form>

<?php
require_once 'inc/footer.php';
?>