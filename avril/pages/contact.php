 <!DOCTYPE html>
 <html>
 <head>
 	<title>contact</title>
 	<meta charset="utf-8">
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
			<h1 class="contact">Nous Contactez</h1>

			<div class="diveder"></div>

			<label for="nom" class="">Nom:</label><br>
			<input id="nom" type="text" name="nom" placeholder="Votre Nom" class="form-control" required><br><br>

			<label for="prenom" class="red">Prenom:</label><br>
			<input id="prenom" type="text" name="prenom" placeholder="votre Prenom" class="form-control" required><br><br>

			<label for="email" required class="red">email:</label><br>
			<input id="email" type="email" name="email" placeholder="votre email" class="form-control" required><br><br>

			<label for="message" class="red">Message</label><br>

		  <textarea id="message" cols="10" rows="8" name="text" placeholder="Votre message"class="form-control" required></textarea><br><br><br><br><br><br><br><br><br><br>
			
			<input type="submit" name="submit" value="Envoyer votre message" class="btn btn-primary">

		</fieldset>
		
	 </form>
	
	</div>
 
 </body>
 </html>
 