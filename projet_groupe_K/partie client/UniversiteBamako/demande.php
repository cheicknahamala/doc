<?php
        require 'database.php';
		$prenom = $nom = $email = $telephone = $addresse= "";
		$prenomError = $nomError = $emailError = $telephoneError = $addresseError = "";
		$isSucces = false;
		$emailTo = "cheickna-hamala.soumounou@u-sud.fr";

		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$prenom = veryfyInput($_POST["prenom"]);
			$nom = veryfyInput($_POST["nom"]);
			$email = veryfyInput($_POST["email"]);
			$telephone = veryfyInput($_POST["telephone"]);
			$addresse = veryfyInput($_POST["addresse"]);


			$isSucces=true;
			$emailText ="";
			


			if(empty($prenom))
		    {
				$prenomError = "je veux connaitre votre prenom !";
					$isSucces=false;

			}
			 

			if(empty($nom))
			{
				$nomError = "je veux connaitre votre  !";
					$isSucces=false;

			}
			
			if(empty($addresse))
			{
				$addresseError = "votre addresse svp";
					$isSucces=false;

			}
			if(!IsEmail($email))
			{
				$emailError = "c'est pas un email valide";
					$isSucces=false;

			}
			
			if(!isTelephone($telephone)){
				$telephoneError = "des chiffres et des espaces !";
					$isSucces=false;
			}
			
			if($isSucces)
			{
			    $db = Database::connect();
	            $statement = $db->prepare("INSERT INTO demande (nom,prenom,email,addresse) values(?, ?, ?, ?)");
	            $statement->execute(array($nom,$prenom,$email,$addresse));
	            Database::disconnect();
	            header("Location: index.php");
				$prenom = $nom = $email = $telephone = $addresse = "";
			}

		}


		function isTelephone($var)
		{
			return preg_match("/^[0-9]*$/", $var);
		}


		function IsEmail($var)
		{
			return filter_var($var, FILTER_VALIDATE_EMAIL);
		}

		function veryfyInput($data) 
		{


 			 $data = trim($data); 
 			 $data = stripslashes($data);
  			 $data = htmlspecialchars($data);
  				return $data;

		}	


?>





<!DOCTYPE html>
<html>
<head>
	<title> </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" ></script>
<link href="https:/fonts.googleapis.com/css?family=lato" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="demande_css/demande.css">
</head>
<body>
	<div class="container">
		
	
			
		
		<div class="row">
			<div class="col-lg-10 col-lg-offset-1">
				<form id="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" role="form">
					<div class="row">

						<div class="col-md-6">
							<label for="prenom">Prénom<span class="red">*</span></label>
							<input type="text" id="prenom" name="prenom" class="form-control" placeholder="Votre prenom" value = "<?php echo $prenom; ?>" >
							<p class="comments"><?php echo $prenomError; ?></p>
						</div>	

						<div class="col-md-6">
							<label for="nom">nom<span class="red">*</span></label>
							<input type="text" id="nom" name="nom" class="form-control" placeholder="Votre nom" value = "<?php echo $nom; ?>">
							<p class="comments"><?php echo $nomError; ?></p>
						</div>	

						<div class="col-md-6">
							<label for="email">email<span class="red">*</span></label>
							<input type="text" id="email" name="email" class="form-control" placeholder="Votre email" value = "<?php echo $email; ?>">
							<p class="comments"><?php echo $emailError; ?></p>
						</div>

						<div class="col-md-6">
							<label for="telephone">telephone</label>
							<input type="text" id="telephone" name="telephone" class="form-control" placeholder="Votre telephone" value = "<?php echo $telephone; ?>">
							<p class="comments"><?php echo $telephoneError; ?></p> 
						</div>

						<div class="col-md-12">
							<label for="addresse">addresse <span class="red">*</span></label>
							<textarea id="addresse" name="addresse" class="form-control" rows = "4"  placeholder="Ajouter un commentaire" ><?php echo $addresse; ?></textarea>   
							<p class="comments"><?php echo $addresseError; ?></p>
						</div>

						<div class="col-md-12">
							<p class="red"><strong>* ces informations sont requises</strong></p>
						</div>	

						<div class="col-md-12">
							<input type="submit" class="button1" value="Envoyer">
						</div>	

					</div>
					<p class="thank-you" style="display:<?php if($isSucces) echo "block";else echo "none"; ?>">Merci pour votre soumission. Vous recevrez une reponse bientôt :-)</p>
					
				</form>	
			</div>	
		</div>
	</div>

</body>
</html>
