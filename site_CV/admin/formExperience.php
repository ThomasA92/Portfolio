<?php 
# require
   require_once "../inc/init.php"; 
   require_once "../inc/headerAdmin.php";

# vérification des champs
    if (!empty($_POST)){ // Si le formulaire a été envoyé 

        // On contrôle tout les champs du formulaire
        if (!isset($_POST['annee_exp']) || strlen($_POST['annee_exp']) < 1 || strlen($_POST['annee_exp']) > 20 ){ 
            $contenu .= '<div class ="alert alert-danger"> La compétence doit être spécifiée !</div>';
        }
    }
    
 /* Tout d'abord on vérifie que la valeur existe avec la fonction isset. C'est si 
 et seulement si la valeur existe, c'est à dire que les champs du formulaire ont été rempli et le bouton submit actionné que l'on entre dans la condition. On met dans les parenthèses toutes les données récupérées dans le formulaire au travers du "name" des inputs. Si les valeurs existent TOUTES on entre dans les accolades pour faire le traitement */
    if ( isset ($_POST ['annee_exp']) && ($_POST ['desc_exp']) ){ 
            $annee_exp = htmlspecialchars($_POST ['annee_exp']) ; //On stocke les données récupérées dans des variables (ça n'est pas une obligation, ça fonctionnerait en utilisant directement $_POST ['name'])
            $desc_exp = htmlspecialchars($_POST ['desc_exp']);
                // 5 types possibles 
                // $_FILES['image']['name'] Nomif
                // $_FILES ['image']['type'] Type
                // $_FILES ['image']['size'] Taille
                // $_FILES ['image']['tmp_name'] Emplacement temporaire
                // $_FILES ['image']['error'] Erreur si oui/non l'image a été réceptionné 

            #On prépare la requête grâce à la méthode "prepare". Dans les parenthèses on met le début de la requete SQL sans préciser les valeurs à insérer
            $requete = $pdo->prepare('INSERT INTO experiences (annee_exp, desc_exp) VALUE (?,?)')              
            or die (print_r($pdo->errorInfo()));    //Permet de capturer l'erreur et de l'afficher.       
                $requete->execute(array ($annee_exp, $desc_exp)); // c'est avec la méthode execute que l'on précise qu'elles sont les valeurs à insérer dans la base de données
                
            // #On finit par un header location pour faire une redirection après l'action et éviter ainsi de renvoyer plusieurs fois les données en BDD
            //     header('location:espaceAdmin.php');
    }

    #Modification
    if(!empty($_GET['id_experience']) && ($_GET['action']=='modifier')){
        $idExp = htmlspecialchars($_GET ['id_experience']) ;
        $queryIt = $pdo->prepare('SELECT * FROM experiences WHERE id_experience = ?');
        $queryIt->execute(array($idExp));
        $result = $queryIt->fetch(PDO::FETCH_ASSOC);

        if(!empty($_POST)){
            $annee_exp = htmlspecialchars($_POST['annee_exp']) ;
            $desc_exp = htmlspecialchars($_POST ['desc_exp']);
                    
            $requete = $pdo->prepare('UPDATE experiences SET annee_exp =?, desc_exp=?  WHERE id_experience = ?')
            or die (print_r($pdo->errorInfo()));
            $requete->execute(array($annee_exp, $desc_exp, $idExp));

            header('location:listeExperiences.php');
        }
    }
?>
    <h1 class="text-center mt-5 mb-5" id="formulaire" >Ajouter une expérience</h1>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                     <form class="col-md-6" method="post" action="" ><!-- Pour pouvoir envoyer des données en POST il faut renseigner la method avec la valeur "post", la page sur laquelle se passe l'action (à savoir le traitement PHP), et l'enctype qui doit être sur "multipart/form-data" pour pouvoir télécharger des fichiers -->
                        <div class="form-group">
                            <label for="annee_exp">Année</label>
                    <!-- Pour la récupération des données, on utilise la valeur du name qu'on mettra dans $_POST pour ce champs par exemple ça sera $_POST['name']-->
                            <input type="text" name="annee_exp" class="form-control" id="marque" placeholder="Année">
                        </div>
                        <div class="form-group">
                             <label for="desc_exp">Description</label>
                            <input type="text" name="desc_exp" class="form-control" id="desc_exp" placeholder="Nom et description">
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