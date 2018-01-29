<?php
include("tools/conx.php");
include("tools/tools.php");
include("tools/js-css.php");
 
if (isset($_GET['codeVal'])) {
	$getCode = $_GET['codeVal'];
	
	$erreur = 0; 
	
	// On lance la requête de validation de la réservation
	$queryA = mysqli_query($bdd,"UPDATE  reservationClient  SET validationClient =1 WHERE codeValidationClient = '$getCode'");

} else {
	$getCode = NULL;
	
	$erreur = 1;
	$erreur_msg = "Une anomalie est survenue dans le processus de validation de votre réservation, veuillez nous contacter par téléphone.";
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>WeezJump - Validation de votre réservation</title>
</head>

<body class="text-center">
	
	<div class="container">
		<div class="row" style="">
			
	        <div class="formulaire">
			    
			    <div class="form-signin" >
				    
				    <img class="mb-3" src="img/logo-weezjump.png" alt="WeezJump - Trampoline Park" title="WeezJump - Trampoline Park" class="img-responsive" width="auto" height="72">
				    
				    <?php if($erreur!=1) { ?>
				    	<div class="panel panel-success">
						    
						    <div class="panel-heading"><i style="color: green" class="glyphicon glyphicon-ok-circle"></i> Réservation validée !</div>
							
							<div class="panel-body text-center" style="line-height: 1.7em;">
									<p><strong>Votre réservation est validée !</strong><br /><br />
									Vous pouvez retourner sur le site de Weezjump<br /> en cliquant <a href="http://www.weezjump.com">ici</a>
									</p>
							</div>
						    
					    </div>
					    
					<? } else {?>
				    
							<div class="alert alert-danger">
								<p><strong>Erreur !</strong> <?php echo $erreur_msg; ?></p>
							</div>
						    	
					<? } ?>
					
				</div>
			    
		    </div>
	
	  	</div>
	</div>

</body>

</html>
