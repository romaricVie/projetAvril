<?php
session_start();

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

  


if(isset($_POST['submit'])){

     if(!empty($_POST['emailconnecte']) AND !empty($_POST['mdpconnecte'])){
          $emailconnecte = htmlspecialchars($_POST['emailconnecte']);
          $mdpconnecte = sha1($_POST['mdpconnecte']);

        $requser = $connexion -> prepare("SELECT * FROM membres WHERE email = ? AND motdepasse = ? ");
         $requser -> execute(array($emailconnecte, $mdpconnecte));

         $userexiste = $requser -> rowCount();
         if($userexiste == 1){

          $userinfos = $requser -> fetch();
          $_SESSION['id'] = $userinfos['id'];
          $_SESSION['psuedo'] = $userinfos['psuedo'];
          $_SESSION['email'] = $userinfos['email'];
          header("location:profil.php?id=".$_SESSION['id']);
           
         }
         else
         {
          $erreur = "Mauvais mail ou Mot de passe!";
         }
      
     }
     else
     {
       $erreur = "Les champs sont réquis!";
     }

   }

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>connexion</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="monstyle.css">

</head>
<body>
   <form action="" method="POST">
       <fieldset align="center">
         <h1 class="connect">CONNEXION</h1>

         
         <label for="email">email</label><br>
         <input type="email" name="emailconnecte" placeholder="Entrez votre email" class="form-control"><br><br>
         <label for="password">Mot de Passe</label><br>
         <input type="password" name="mdpconnecte" placeholder="Entrez votre Mot de Passe" class="form-control"><br><br>
         <input type="submit" name="submit" value="Je me connecte" class="btn btn-success">
         <a href="register.php">Pas encore de Compte?</a>
         <?php
          if(isset($erreur)){
            echo "<p style=color:red>".$erreur."</p>";
          }

         ?>
       </fieldset>
   </form>
</body>
</html>