<?php 
   
	  $dbHost = "localhost";
    $dbName = "espace_membre";
    $dbUser = "root";
    $dbcharset="utf8";
    $dbUserPassword = "";
		 
	try
	{
	 $connexion=new PDO("mysql:host=".$dbHost.";dbname=".$dbName.";charset=".$dbcharset,$dbUser,$dbUserPassword);
	 $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e)
	{
		die($e->getMessage());
	}
 
  // Vérifie si l'utilisaeur a soumit le formalaire 
 if(isset($_POST['submit'])){

     // Vérifie si les champs ne sont pas vide
     if(!empty($_POST['psuedo']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
          
          //Récupération des variable name par la methode POST

          $psuedo = htmlspecialchars($_POST['psuedo']);
          $email  = htmlspecialchars($_POST['email']);
          $email2 = htmlspecialchars($_POST['email2']);
          $mdp = sha1($_POST['mdp']);
          $mdp2 = sha1($_POST['mdp2']);
          
        //Vérification de la taille du spuedo
          $psuedolength = strlen($psuedo) ;


          if($psuedolength <= 255) {

            // Vérification du mail
             if($email == $email2){
                //Vérification de l'unicité du mail dans la BD

                $reqemail = $connexion -> prepare("SELECT * FROM membres WHERE email = ?");
                $reqemail -> execute(array($email));
                $emailexist = $reqemail -> rowCount();
                if($emailexist == 0){
                   
                  // Vérification de mot de passe
                 if($mdp == $mdp2){
                //Vérification de l'unicité du mail dans la BD
                $reqmdp = $connexion -> prepare("SELECT * FROM membres WHERE motdepasse = ?");
                $reqmdp -> execute(array($mdp));
                $mdpexist = $reqmdp -> rowCount();
                    if($mdpexist == 0) {

                          // Toutes les conditions sont respectées
                          // Insertion dans la BD

                          $req = $connexion ->prepare("INSERT INTO membres(psuedo, email, motdepasse) VALUES(?,?,?)");
                          $rep = $req -> execute(array($psuedo, $email, $mdp));
                          $erreur = "<p style='color:green'>Votre compte a été créer avec Succès!<P> <a href='connexion.php'>Se connecter</a>";
             
                 }
                 else
                     {
                         $erreur = "mot de passe déja utiliser!";
                     }
                 }
                 else
                    {
                      $erreur = "Vos mots de passe ne correspondent pas!";
                    }

                  }

               else
                     {
                       $erreur = "Adresse emil déja utiliser!";
                     }
                
              }

             else
                  {
                      $erreur = "Vos adresses email ne correspondent pas!";
                  }

            }
          else
              {
                 $erreur = "votre psuedo ne doit pas dépasser 255 caractères";
              }

         }
     else
         {
           $erreur = "Tous les Champs sont réquis!!!";
         }
   }

?>




<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<title>register</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="monstyle.css">
</head>
<body>
  <div class="container">
    <form action="" method="POST">
     <fieldset align="center" class="form-group">
              <h1 class="inscri">INSCRIPTION</h1>
              <label for="psuedo">Psuedo</label><br>
              <input type="text" id="psuedo" name="psuedo" placeholder="Entrez votre psuedo" value="<?php if(isset($psuedo)){ echo $psuedo;}?>" class="form-control"><br><br>

              <label for="email">email</label><br>
              <input type="email" id="email" name="email" placeholder="Entrez votre email" value="<?php if(isset($email)){ echo $email;}?>" class="form-control"><br><br>
                
                <label for="email2">Email Confirm</label><br>
              <input type="email" name="email2" id="email2" placeholder="Confirm email" value="<?php if(isset($email2)){ echo $email2;}?>" class="form-control"><br><br>


              <label for="mdp">Mot de Passe</label><br>
              <input type="password" name="mdp" id="mdp" placeholder="Entrez votre Mot de Passe" class="form-control"><br><br>
              <label for="mdp2">Mot de Passe</label><br>
              <input type="password" name="mdp2" id="mdp2" placeholder="Mot de Passe Confirm" class="form-control"><br><br>

                <input type="submit" name="submit" value="valider" class="btn btn-primary btn-lg">

              <?php
            if(isset($erreur)){
                      echo "<p style ='color:red;'>".$erreur."</p>";
                 }
            ?>
     </fieldset>
   </form>


  </div>
   
</body>
</html>