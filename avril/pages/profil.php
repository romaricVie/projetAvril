<?php
session_start();

    $dbHost = "localhost";
    $dbName = "espace_membre";
    $dbUser = "root";
    $dbcharset="utf8";
    $dbUserPassword = "";
     
  try
  {
   $connexion = new PDO("mysql:host=".$dbHost.";dbname=".$dbName.";charset=".$dbcharset,$dbUser,$dbUserPassword);
   $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e)
  {
    die($e->getMessage());
  }

 

if(isset($_GET['id']) AND $_GET['id'] > 0) {

  $getid = intval($_GET['id']);
  
  $req = $connexion->prepare("SELECT * FROM membres WHERE id = ?");
  $req -> execute(array($getid));

   $userinfos = $req->fetch();
  
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>profil</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="../assets/jquery/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="monstyle.css">
</head>
<body>
      <div style="text-align: center;">

         <h1 style="color: blue">Profil de <?php  echo $userinfos['psuedo']; ?></h1>
         <h3><?php echo $userinfos['psuedo']; ?> </h3>
         <h3>votre email: <?php echo $userinfos['email']; ?></h3>
          <script type="text/javascript">
              </script>
    <div id="boucle">Connecté :</div>
    
    <script type="text/javascript">
          var d = new Date();
      
          var annee = d.getFullYear();
          var jourSemaine = d.getDay();
          var joursmois = d.getDate()
          var dmois = d.getMonth();
          var heure = d.getHours();
          var minute = d.getMinutes();
          var seconde = d.getSeconds();

        var mois = ["Janvier","Février","Mars","Avril","Mai","Juin","juillet","Aout","Septembre","Octobre","Novembre","Decembre"];
        var jours = ["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
        var dat = ("le "+jours[jourSemaine]+" "+joursmois+" "+mois[dmois]+" "+annee+
          ".\n à "+heure+":"+minute+":"+seconde+" s");

          document.getElementById('boucle').innerHTML+= dat;
    </script>
          </script>
          <?php
         if(isset($_SESSION['id']) AND $userinfos['id'] == $_SESSION['id']){

          echo "<a href='#'>editer mon profil</a> <br>";
          echo "<a href='deconnection.php'>se deconnecter</a><br>";
          echo "<a href='../index.php' class='btn btn-success btn-lg'><span class='glyphicon glyphicon-home'></span> Menu</a>";
         }
         
          ?>
       
      </div>
         
         
</body>
</html>