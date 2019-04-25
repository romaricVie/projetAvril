<!DOCTYPE html>
<html>
<head>
	<title>deconnection</title>
</head>
<body>
<?php
session_start();
$_SESSION = array();
session_destroy();
header("location:connexion.php");


 ?>
</body>
</html>