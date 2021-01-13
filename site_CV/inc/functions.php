<?php 
// Ce fichier contient toutes les fonctions et sera inclus dans toutes les pages.

function debug($variable){
    echo '<div style="border: 1px solid orange">';
        echo '<pre>';
            print_r($variable);
        echo '</pre>';
    echo '</div>';
}

// -------------------------------
// Fonctions liées au membre
function isLogged(){
    //  Cette fonction indique si l'internaute est connecté.
    if(isset($_SESSION['membre'])){ // Si existe "membre" dans la session, c'est que l'internaute est mpassé par la page de connexion avec les bons identifiants, et que nous avons rempli cette dernière avec ses inforlmations;
        return true; // Il est connecté.
    }else {
        return false; // Il est pas connecté.
    }
}

function isAdmin(){
    // Cette fonction indique si le membre est admin et connecté.
    if(isLogged()&& $_SESSION['membre']['statut'] == 1){ // Si le membre est connecté et que dans le même temps son statut est égal à 1, il est donc admin connecté.
        return true;
    } else {
        return false;
    }
}

// ---------------------------------
// Fonction qui exécute des requêtes

function executeRequete($requete, $param = array()){ // Le paramètre $requete attend de recevoir une requête SQL sous forme de string. $param attend un array avec les marqueurs associés à leur valeur.Ce paramètre est optionnel car on lui a affecté un array() vide par défaut.

    // Echapper les données 
    foreach($param as $indice => $valeur) {
        $param[$indice] = htmlspecialchars ($valeur);
        // boîte          valeur "toto"
        // htmlspecialchars transforme les chevrons pour neutraliser les balises <script> et <style> (évite les failles XSS et CSS). Dans cette boucle, on prend à chaque tour la valeur du tableau $param que l'on échappe et que l'on réaffecte à son emplacement d'origine.
    }
        // Requête préparée :
        global $pdo; // On accède à la variable globale $pdo qui est définie dans init.php à l'extérieur de cette fonction.
        $resultat = $pdo->prepare($requete);  // On prépare la requête envoyée à notre fonction.
        $success = $resultat->execute($param); // Puis on exécute la requête en lui passant le tableau qui contient les marqueurs et leur valeur pour faire les bindParam().On récupère dans la variable $success true si la requête a marché, sinon false.

        if ($success){
            return $resultat; // si $success contient true, donc que la requête a marché, je retourne le résultat de ma requête.
        } else {
            return false;  // Si la requête n'a pas marché on retourne false.
        }
    
}

