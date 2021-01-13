<?php 
# require
    require_once "../inc/init.php"; 
   require_once "../inc/headerAdmin.php";

# vérification des champs
    if (!empty($_POST)){ // Si le formulaire a été envoyé 

        // On contrôle tout les champs du formulaire
        if (!isset($_POST['nom_comp']) || strlen($_POST['nom_comp']) < 1 || strlen($_POST['nom_comp']) > 20 ){ 
            $contenu .= '<div class ="alert alert-danger"> La compétence doit être spécifiée !</div>';
        }
    }
    
    #INSERTION EN BDD
 /* Tout d'abord on vérifie que la valeur existe avec la fonction isset. C'est si 
 et seulement si la valeur existe, c'est à dire que les champs du formulaire ont été rempli et le bouton submit actionné que l'on entre dans la condition. On met dans les parenthèses toutes les données récupérées dans le formulaire au travers du "name" des inputs. Si les valeurs existent TOUTES on entre dans les accolades pour faire le traitement */
    if ( isset ($_POST ['nom_comp']) && ($_POST ['progress']) ){ 
            $nom_comp = htmlspecialchars($_POST ['nom_comp']) ; //On stocke les données récupérées dans des variables (ça n'est pas une obligation, ça fonctionnerait en utilisant directement $_POST ['name'])
            $progress = htmlspecialchars($_POST ['progress']);
            

            #On prépare la requête grâce à la méthode "prepare". Dans les parenthèses on met le début de la requete SQL sans préciser les valeurs à insérer
            $requete = $pdo->prepare('INSERT INTO competences (nom_comp, progress) VALUE (?,?)')              
            or die (print_r($pdo->errorInfo()));    //Permet de capturer l'erreur et de l'afficher.       
                $requete->execute(array ($nom_comp, $progress)); // c'est avec la méthode execute que l'on précise qu'elles sont les valeurs à insérer dans la base de données
                
            // #On finit par un header location pour faire une redirection après l'action et éviter ainsi de renvoyer plusieurs fois les données en BDD
                header('location:listeCompetences.php');
    }

    #MODIFICATION
    if(!empty($_GET['id_competence']) && ($_GET['action']=='modifier')){
        $idComp = htmlspecialchars($_GET ['id_competence']) ;
        $queryIt = $pdo->prepare('SELECT * FROM competences WHERE id_competence = ?');
        $queryIt->execute(array($idComp));
        $result = $queryIt->fetch(PDO::FETCH_ASSOC);

        if(!empty($_POST)){
            $nom_comp = htmlspecialchars($_POST['$nom_comp']) ;
            $progress = htmlspecialchars($_POST ['$progress']);
                    
            $requete = $pdo->prepare('UPDATE competences SET nom_comp =?, progress=?  WHERE id_competence = ?')
            or die (print_r($pdo->errorInfo()));
            $requete->execute(array($nom_comp, $progress, $idComp));

            header('location:listeCompetences.php');
        }
    }

?>
    
        <div class="container">
        <h1 class="text-center mt-5 mb-5" id="formulaire" >Ajouter une compétence</h1>
            <div class="row">
                <div class="col-md-3"></div><!-- Pour pouvoir envoyer des données en POST il faut renseigner la method avec la valeur "post", la page sur laquelle se passe l'action (à savoir le traitement PHP), et l'enctype qui doit être sur "multipart/form-data" pour pouvoir télécharger des fichiers -->
                     <form class="col-md-6" method="post" action="" >
                        <div class="form-group">
                            <label for="nom_comp">Compétences</label>
                    <!-- Pour la récupération des données, on utilise la valeur du name qu'on mettra dans $_POST pour ce champs par exemple ça sera $_POST['name']-->
                            <input type="text" name="nom_comp" class="form-control" id="marque" placeholder="Nom de la compétence">
                        </div>
                        <div class="form-group">
                             <label for="progress">Progression(%)</label>
                            <input type="text" name="progress" class="form-control" id="progress" placeholder="progression ">
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
    require_once "../inc/footerAdmin.php";
?>