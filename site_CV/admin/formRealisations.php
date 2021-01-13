<?php 
# require
    require_once "../inc/init.php"; 
    require_once "../inc/headerAdmin.php" ; 

# vérification des champs
    if (!empty($_POST)){ // Si le formulaire a été envoyé 

        // On contrôle tout les champs du formulaire
        if (!isset($_POST['titre']) || strlen($_POST['titre']) < 1 || strlen($_POST['titre']) > 20 ){ // si le champ "pseudo" n'existe pas OU que sa longueur est inférieure à 4 OU que sa longueur est supérieure à 20 (selon le BDD), alors on met un message à l'internaute
            $contenu .= '<div class ="alert alert-danger"> Le titre doit être spécifiée !</div>';
        }
    }
    
 /* Tout d'abord on vérifie que la valeur existe avec la fonction isset. C'est si 
 et seulement si la valeur existe, c'est à dire que les champs du formulaire ont été rempli et le bouton submit actionné que l'on entre dans la condition. On met dans les parenthèses toutes les données récupérées dans le formulaire au travers du "name" des inputs. Si les valeurs existent TOUTES on entre dans les accolades pour faire le traitement */
    if ( isset ($_POST ['titre']) && ($_POST ['intro']) && ($_FILES['img']['name']) && ($_GET['action']=='ajouter')){ 
            $titre = htmlspecialchars($_POST ['titre']) ; //On stocke les données récupérées dans des variables (ça n'est pas une obligation, ça fonctionnerait en utilisant directement $_POST ['name'])
            $intro = htmlspecialchars($_POST ['intro']);
            $img = '../assets/img/'.date("mdYHis").$_FILES['img']['name']; 
            copy($_FILES['img']['tmp_name'], $img);
           
            #On prépare la requête grâce à la méthode "prepare". Dans les parenthèses on met le début de la requete SQL sans préciser les valeurs à insérer
            $requete = $pdo->prepare('INSERT INTO realisations (titre, intro,img) VALUE (?,?,?)')              
            or die (print_r($bdd->errorInfo()));    //Permet de capturer l'erreur et de l'afficher.       
                $requete->execute(array ($titre, $intro,$img)); // c'est avec la méthode execute que l'on précise qu'elles sont les valeurs à insérer dans la base de données
                
            #On finit par un header location pour faire une redirection après l'action et éviter ainsi de renvoyer plusieurs fois les données en BDD
                // header('location:listeRealisations.php');
            } // Fin du if

    #Modification
    if(!empty($_GET['id_realisation']) && ($_GET['action']=='modifier')){
        $idReal = htmlspecialchars($_GET ['id_realisation']) ;
        $queryIt = $pdo->prepare('SELECT * FROM realisations WHERE id_realisation = ?');
        $queryIt->execute(array($idReal));
        $result = $queryIt->fetch(PDO::FETCH_ASSOC);

        if(!empty($_POST)){
            $titre = htmlspecialchars($_POST['titre']) ;
            $intro = htmlspecialchars($_POST ['intro']);
            $img_bdd = ""; 

            if (isset($_POST['photo_actuelle'])) { 
             $img_bdd = $_POST['photo_actuelle'];  
            }       
             if (!empty($_FILES['img']['name'])) {  
                $nom_fichier = $_FILES['img']['name'] ; 
                $img_bdd = '../assets/img/' . $nom_fichier;
                copy($_FILES['img']['tmp_name'], $img_bdd);  
            }        
            $requete = $pdo->prepare('UPDATE realisations SET titre =?, intro=?, img=? WHERE id_realisation = ?')
            or die (print_r($pdo->errorInfo()));
            $requete->execute(array($titre, $intro,$img_bdd, $idReal));

             header('location:listeRealisations.php');
        }
            $divImg = '<div><img src="'. $result['img'] . '" style="width: 90px"></div>';
    } // fin du if

    ?>

    <h1 class="text-center mt-5 mb-5" id="formulaire" >Ajouter une réalisation</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                     <form class="col-md-6" method="post" action="" enctype="multipart/form-data"> <!-- Pour pouvoir envoyer des données en POST il faut renseigner la method avec la valeur "post", la page sur laquelle se passe l'action (à savoir le traitement PHP), et l'enctype qui doit être sur "multipart/form-data" pour pouvoir télécharger des fichiers -->
                        <div class="form-group">
                            <label for="titre">Titre</label>
                    <!-- Pour la récupération des données, on utilise la valeur du name qu'on mettra dans $_POST pour ce champs par exemple ça sera $_POST['name']-->
                            <input type="text" name="titre" class="form-control" id="titre" placeholder="titre du projet" value="<?= $result['titre']??""?>">
                        </div>
                        <div class="form-group">
                             <label for="intro">Introduction</label>
                            <input type="text" name="intro" class="form-control" id="intro" placeholder="Description du projet" value="<?= $result['intro']??""?>">
                        </div>
                        <div class="form-group">
                            <label for="img">Image</label>
                            <input type="file" class="form-control" name="img" id="img" value="">
                            <?=($_GET['action']=='modifier') ?  $divImg : "" ; // Pour la modification de l'image.
                             if (isset($result['miniature'])) { 
                            echo '<input type="hidden" name="photo_actuelle" value="' . $result['img'] . '">';
                        }
                        ?>
                        </div>
                        
                        <div class="form-group">
                        
                        <input class="btn btn-primary" type="submit" value="Envoyer">
                        </div>
                    </form>
                <div class="col-md-3"></div>
            </div>
        </div>
        
<?php 
    require_once "../inc/footerAdmin.php";
?>