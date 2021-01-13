<?php 
# require
    require_once "../inc/init.php"; 
   require_once "../inc/header.php";

# vérification des champs
    if (!empty($_POST)){ // Si le formulaire a été envoyé 

        // On contrôle tout les champs du formulaire
        if (!isset($_POST['annee_for']) || strlen($_POST['annee_for']) < 1 || strlen($_POST['annee_for']) > 20 ){ 
            $contenu .= '<div class ="alert alert-danger"> La compétence doit être spécifiée !</div>';
        }
    }
    
    #INSERTION EN BDD

 /* Tout d'abord on vérifie que la valeur existe avec la fonction isset. C'est si 
 et seulement si la valeur existe, c'est à dire que les champs du formulaire ont été rempli et le bouton submit actionné que l'on entre dans la condition. On met dans les parenthèses toutes les données récupérées dans le formulaire au travers du "name" des inputs. Si les valeurs existent TOUTES on entre dans les accolades pour faire le traitement */
    if ( isset ($_POST ['annee_for']) && ($_POST ['desc_for']) ){ 
            $annee_for = htmlspecialchars($_POST ['annee_for']) ; //On stocke les données récupérées dans des variables (ça n'est pas une obligation, ça fonctionnerait en utilisant directement $_POST ['name'])
            $desc_for = htmlspecialchars($_POST ['desc_for']);
                // 5 types possibles 
                // $_FILES['image']['name'] Nomif
                // $_FILES ['image']['type'] Type
                // $_FILES ['image']['size'] Taille
                // $_FILES ['image']['tmp_name'] Emplacement temporaire
                // $_FILES ['image']['error'] Erreur si oui/non l'image a été réceptionné 

            #On prépare la requête grâce à la méthode "prepare". Dans les parenthèses on met le début de la requete SQL sans préciser les valeurs à insérer
            $requete = $pdo->prepare('INSERT INTO formations (annee_for, desc_for) VALUE (?,?)')              
            or die (print_r($pdo->errorInfo()));    //Permet de capturer l'erreur et de l'afficher.       
                $requete->execute(array ($annee_for, $desc_for)); // c'est avec la méthode execute que l'on précise qu'elles sont les valeurs à insérer dans la base de données
                
            // #On finit par un header location pour faire une redirection après l'action et éviter ainsi de renvoyer plusieurs fois les données en BDD
            //     header('location:espaceAdmin.php');
    }

    # MODIFICATION

    if(!empty($_GET['id_formation']) && ($_GET['action']=='modifier')){
        $idFor = htmlspecialchars($_GET ['id_formation']) ;
        $queryIt = $pdo->prepare('SELECT * FROM formations WHERE id_formation = ?');
        $queryIt->execute(array($idFor));
        $result = $queryIt->fetch(PDO::FETCH_ASSOC);

        if(!empty($_POST)){
            $annee_for = htmlspecialchars($_POST['annee_for']) ;
            $desc_for = htmlspecialchars($_POST ['intro']);
                    
            $requete = $pdo->prepare('UPDATE formations SET annee_for =?, desc_for=?  WHERE id_formation = ?')
            or die (print_r($pdo->errorInfo()));
            $requete->execute(array($annee_for, $desc_for, $idFor));

            header('location:listeFormations.php');
        }
    }
?>

    <h1 class="text-center mt-5 mb-5" id="formulaire" >Ajouter une formation</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                     <form class="col-md-6" method="post" action="" ><!-- Pour pouvoir envoyer des données en POST il faut renseigner la method avec la valeur "post", la page sur laquelle se passe l'action (à savoir le traitement PHP), et l'enctype qui doit être sur "multipart/form-data" pour pouvoir télécharger des fichiers -->
                        <div class="form-group">
                            <label for="annee_for">Année</label>
                    <!-- Pour la récupération des données, on utilise la valeur du name qu'on mettra dans $_POST pour ce champs par exemple ça sera $_POST['name']-->
                            <input type="text" name="annee_for" class="form-control" id="marque" placeholder="Nom de la compétence">
                        </div>
                        <div class="form-group">
                             <label for="desc_for">Description</label>
                            <input type="text" name="desc_for" class="form-control" id="desc_for" placeholder="description">
                        </div>
                        
                        <div class="form-group">
                        <!-- Il faut aussi mettre un bouton ou input de type "submit" -->
                        <input class="btn btn-primary" type="submit" value="Envoyer">
                        </div>
                    </form>
                <div class="col-md-3"></div>
            </div>
        </div>
        
<?php 
    require_once "../inc/footer.php";
?>