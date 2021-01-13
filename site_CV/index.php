<?php
 require 'inc/init.php';
 require 'inc/header.php';


// Requete SQL à utiliser pour l'affichage depuis la BDD

  #requêtes SQL en BDD pour afficher les compétences par leur ID
  // FRONT END
  $resultCompetencesFront = $pdo->query("SELECT * FROM competences ORDER BY id_competence LIMIT 3");
  // BACK END
  $resultCompetencesBack= $pdo->query("SELECT * FROM competences ORDER BY id_competence LIMIT 3 OFFSET 3");
  // Notions et Outils
  $resultCompetencesOther= $pdo->query("SELECT * FROM competences ORDER BY id_competence  LIMIT 3 OFFSET 6");

  # Partie réalisations
  $resultRealisations = $pdo->query("SELECT * FROM realisations");

  # Partie parcours =>formations
  $resultFormations = $pdo->query("SELECT * FROM formations");

  # Partie parcours => expériences 
  $resultExperiences = $pdo->query("SELECT * FROM experiences");

// ---------------------------------------------------------------

//-----------------Traitement des données du formulaire de contact ----------
  //debug($_POST);

  #variables à utiliser
  // $to = 'thomas.andyfr@gmail.com';

  // // vérification des champs
  // if (!empty ($_POST)) { // si le formulaire a été envoyé et $_POST n'est pas vide
  //     if(!isset($_POST['nom']) || strlen($_POST['nom']) < 2) {
  //       //si le champ "marque" n'existe pas ou que sa longeur est inférieur à 2 ou superieur à 20 (selon la BDD), alors on met un message à l'internaute       
  //       $contenu .= '<div class="alert alert-danger">La nom doit contenir minimum 2  caractères.</div>';
  //     }
  //     if(!isset($_POST['sujet']) || strlen($_POST['sujet']) < 4) {
  //       $contenu .= '<div class="alert alert-danger">Le champ sujet est obligatoire.</div>';
  //     }
  //     if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
  //     $contenu .= '<div class="alert alert-danger">l\'email n\'est pas valide</div>';
  //     }
  //     if(!isset($_POST['message']) || strlen($_POST['message']) < 10) {      
  //           $contenu .= '<div class="alert alert-danger">Le champ message est obligatoire !!.</div>';
  //     }

  //   //----------------

  //     if(empty($contenu)){// 

  //       $nom = $_POST['name'];
  //       $mail = $_POST['email'];
  //       $subject = $_POST['sujet'];
  //       $text = str_replace("\n.", "\n..", $_POST['message']);
  //       $message = "Nom : ". $_POST['nom'] . "\n";
  //       $message .= "Message : ".$text;
  //       $headers = array(
  //         'From' => $mail,
  //         'Reply-To' => $mail,
  //         'X-Mailer' => 'PHP/' . phpversion()
  //       );

  //       $success = mail($to,$subject,$message,$headers);
  //       if ($success){
  //         $contenu .='<div class="alert alert-success">Votre message est envoyé.</a></div>';
  //       } else{
  //         $contenu .='<div class="alert alert-danger">Echec de l\'envoi.</div>';
  //       }
  //     }// fin de if (empty($contenu))  
  // } 

  // ------------------------------------------------------------------------------

    // PHP SALMA
  $errors = '';
  $myemail = 'thomas.andyfr@gmail.com';

  if(empty($_POST['sujet'])  || empty($_POST['email']) || empty($_POST['message'])){
      $errors .= "\n Error: tous les champs sont requis";
    }
    if ( isset ($_POST['sujet']) && ($_POST ['email']) && ($_POST ['message'])){ 
      $subject = $_POST['sujet']; 
      $email_address = $_POST['email']; 
      $message = $_POST['message']; 
      if (!preg_match(
      "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
      $email_address)){
      $errors .= "\n Error: Adresse email invalide";
      }    if(empty($errors)){
        $to = $myemail; 
        $email_subject = "Contact form submission: $subject";
        // $email_body = "You have received a new message. ".
        // " Here are the details:\n Name: $name \n Email: $email_address \n Message \n $message"; 

        $email_body = "You have received a new message. ".
        " Here are the details: \n Email: $email_address \n Message \n $message"; 

        $headers = "From: $myemail\n"; 
        $headers .= "Reply-To: $email_address";      // mail($to,$email_subject,$email_body,$headers);

        mail($to,$email_subject, $email_body, $headers);
        //redirect to the 'thank you' page
        // header('Location: contact-form-thank-you.html');
      }
  
    } // fin empty (post)
  
  
  

// AFFICHAGE

?>

  <main>
    <section id="about" data-aos="zoom-in" data-aos-duration="1000" >
      <div class="container">
        <div class="row">
          <div class="col-md-5" data-aos-duration="1500" data-aos="fade-right">
            <h2>A propos de moi</h2>
            <p>Bonjour à vous .</p>
            <p>Je m'appelle Thomas Andy, je suis une personne passionné par la technologie de manière générale, mais j'ai décidé de jeter mon dévolu sur le développement web. 
            <p> Ce n'était pas mon premier choix mais après avoir réfléchi et regarder ce qui m'intéressait et ce qui me semblait plus utile c'est ce que j'ai décidé de faire.
            Aujourd'hui, je suis développeur web junior en quête d'expériences professionnelles.</p>
             <p>Je vous propose de me connaître un peu plus en visitant ce site et en téléchargeant mon CV çi-dessous. Bonne visite !</p> 
            </p>
            <button class="btn btn-default"><i class="fa fa-download"></i><a href="assets/img/CV_test.pdf" download>Télécharger mon CV</a></button>
          </div>
          <div class="col-md-7 pt-5" data-aos-duration="1500" data-aos="fade-left">
            <img class="img-fluid imgAbout " src="assets/img/pikachu.jpg" alt=Photo>
          </div>
        </div>
      </div>
    </section>

<!-- début compétences  -->

    <section id="competences" data-aos="zoom-in" data-aos-duration="1000">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2  data-wow-offset="50">Mes compétences</h2>
          </div>
            <div class="col-md-4" data-aos="fade-right">
              <i class="fa fa-laptop"></i>
              <h4>Front-end</h4>
                <ul>
                  <?php
                  while($competences = $resultCompetencesFront->fetch(PDO::FETCH_ASSOC)){
                    ?>
                   <li>
                     <?= $competences['nom_comp']?>
                    <!-- bleu clair -->
                    <div class="progress">
                      <div class="progress-bar bg-info" style="width:<?= $competences['progress']?>%"><?= $competences['progress']?>%</div>
                    </div>
                  </li>
                <?php } ?>
                  
                </ul>
            </div>
            
              <div class="col-md-4" data-aos="fade-down">
                <i class="fa fa-cloud"></i>
                <h4>Back-end</h4>
                  <ul>
                  <?php
                  while($competences = $resultCompetencesBack->fetch(PDO::FETCH_ASSOC)){
                    ?>
                   <li>
                     <?= $competences['nom_comp']?>
                    <!-- bleu clair -->
                    <div class="progress">
                      <div class="progress-bar bg-info" style="width:<?= $competences['progress']?>%"><?= $competences['progress']?>%</div>
                    </div>
                  </li>
                <?php } ?>
                  </ul>
              </div>
              
              <div class="col-md-4"data-aos="fade-left">
                <i class="fa fa-cog"></i>
                <h4>Notions et outils</h4>
                  <ul>
                  <?php
                  while($competences = $resultCompetencesOther->fetch(PDO::FETCH_ASSOC)){
                    ?>
                   <li>
                     <?= $competences['nom_comp']?>
                    <!-- bleu clair -->
                    <div class="progress">
                      <div class="progress-bar bg-info" style="width:<?= $competences['progress']?>%"><?= $competences['progress']?>%</div>
                    </div>
                  </li>
                <?php } ?>
                  </ul>
              </div>
            </div>
          </div>
    </section>
      
      <!-- Fin compétences -->

	<!-- début réalisations -->
  <section id="realisations" data-aos="zoom-in" data-aos-duration="1000">
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
    			<h2 class="wow bounceIn" data-wow-offset="50" > Mes réalisations </h2>
        </div>
        <?php while($realisations = $resultRealisations->fetch(PDO::FETCH_ASSOC)){?>
    	    <div class="col-md-3 col-sm-6 col-12" data-wow-offset="50" >
            <div class="realisations-thumb mb-3">
              <img src="<?= $realisations['img']?>" class="img-responsive" alt="realisation">
                <div class="realisations-overlay">
                  <h4><?= $realisations['titre']?></h4>
                    <p><?= $realisations['intro']?></p>
                </div>
            </div>
          </div>
         <?php }  ?>

        
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-git"><i class="fab fa-github pr-1"></i> <a href="https://github.com/ThomasA92"></a> Mon Github</button>
              </div>   
    		</div>
    	</section>
      <!-- Fin réalisations -->
      
      <!-- Début section parcours-->
  <section id="parcours"  data-aos="zoom-in" data-aos-duration="1000">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h2> Mon parcours </h2>
        </div>
        <div class="col-md-6" data-aos="fade-right" data-aos-duration="1500" >
          <h3>Expériences</h3>
          <table class="table table-bordered">
            <tr>
              <th scope="col">Année</th>
              <th scope="col">Description</th>
            </tr>
              </thead>
            <tbody>
            <?php 
            while ($experiences= $resultExperiences->fetch(PDO::FETCH_ASSOC)){
              echo '
               <tr>
              <td scope="row">' . $experiences['annee_exp'] .'</th>
              <td> ' . $experiences['desc_exp'] .'</td>
            </tr>';
          }
            ?>
            </tbody>
          </table>
        </div>

        <div class="col-md-6" data-aos="fade-left"  data-aos-duration="1500">
          <h3>Formations</h3>
          <table class="table table-bordered ">
            <thead>
              <tr>
                <th scope="col">Année</th>
                <th scope="col">Description</th>
              </tr>
            </thead>
            <tbody>
            <?php 
            while ($formations= $resultFormations->fetch(PDO::FETCH_ASSOC)){
              echo '
            <tr>
              <td scope="row">' . $formations['annee_for'] .'</th>
              <td> ' . $formations['desc_for'] .'</td>
            </tr>';
          }
            ?>
            </tbody>
          </table>
        </div>
    </div>
  </section>
  

<!-- Container (Contact Section) -->

  <section id="contact" data-aos-duration="1000">
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
    				<h2>Me contacter</h2>
        </div>
        <!-- début formulaire-->
    			<div class="col-md-6 col-sm-6 col-xs-12">
          <form action="" method="post">
    					<label>Nom</label>
              <input name="name" type="text" class="form-control" id="name" placeholder="Votre nom,pseudo">

              <label>Sujet</label>
                <input name="sujet" type="sujet" class="form-control" id="sujet" placeholder="L'objet de votre message" >
              
              <label>Votre E-mail</label>
                <input name="email" type="email" class="form-control" id="email" placeholder="Votre e-mail" >

              <label>Votre message</label>
    						<textarea name="message" rows="4" class="form-control" id="message" placeholder="Ecrivez votre message ici"></textarea>
                <input type="submit" class="form-control">
                
    				</form>
          </div> <!-- fin Formulaire -->
          <div class="col-md-6 col-sm-6 col-xs-12">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2622.4570411000227!2d2.2371383160107983!3d48.90668397929235!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e665adaf9faeb3%3A0x147bb10f95472bdb!2sLa%20Garenne-Colombes%20-%20Charlebourg!5e0!3m2!1sfr!2sfr!4v1608036473085!5m2!1sfr!2sfr" width="400" height="350" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>
    		</div>
    	</div>
  </section> <!-- Fin section contact-->
</main> 


<?php
require 'inc/footer.php'
?>
