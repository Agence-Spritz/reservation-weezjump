<?php
include("tools/conx.php");
include("tools/tools.php");
include("tools/js-css.php");


if(isset($_POST["nom"]) ){
	$datepicker = $_POST["datepicker"];
	$nbPart = $_POST["nbPart"];
	$listeHorraire = $_POST["listeHorraire"];
	$nomParticipant = $_POST["nom"];
	$prenomParticipant = $_POST["prenom"];
	$telParticipant = $_POST["tel"];
	$mailParticipant = $_POST["mail"];
}


if(isset($_POST['datepicker'])){
		//echo "j'ai reçu un datePicker";
		$dateTempL = explode('/',$_POST['datepicker']);
		$dateATester = $dateTempL[2]."-".$dateTempL[1]."-".$dateTempL[0];
		$datepickeEcritr = strtotime($dateATester);
		//echo "et la date a tester est ".	$dateATester;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>WeezJump - Etape 5 - Validation</title>
</head>

<body class="text-center">
	
	
	<div class="container">
		<div class="row" style="">
			<section>
		        <div class="wizard">
		            <div class="wizard-inner">
		                <div class="connecting-line"></div>
		                <ul class="nav nav-tabs" role="tablist">
		
		                    <li role="presentation" class="disabled">
		                        <a href="index.php" data-toggle="tab" aria-controls="Nombre de personnes" role="tab" title="Nombre de personnes">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-home"></i>
		                            </span>
		                        </a>
		                    </li>
		
		                    <li role="presentation" class="disabled">
		                        <a href="#" data-toggle="tab" aria-controls="Date de réservation" role="tab" title="Date de réservation">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-calendar"></i>
		                            </span>
		                        </a>
		                    </li>
		                    <li role="presentation" class="disabled">
		                        <a href="#" data-toggle="tab" aria-controls="Horaire de réservation" role="tab" title="Horaire de réservation">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-time"></i>
		                            </span>
		                        </a>
		                    </li>
		                    <li role="presentation" class="disabled">
		                        <a href="#" data-toggle="tab" aria-controls="Informations personnelles" role="tab" title="Informations personnelles">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-user"></i>
		                            </span>
		                        </a>
		                    </li>
		
		                    <li role="presentation" class="active">
		                        <a href="#" data-toggle="tab" aria-controls="Validation" role="tab" title="Validation">
		                            <span class="round-tab">
		                                <i class="glyphicon glyphicon-ok"></i>
		                            </span>
		                        </a>
		                    </li>
		                </ul>
		            </div>
		        </div>
		    </section>
			
	        <div class="formulaire">
			    
			    <form class="form-signin" action="merci.php" method="post" enctype="application/x-www-form-urlencoded" name="loginForm">
				    
				    <img class="mb-4" src="img/logo-weezjump.png" alt="WeezJump - Trampoline Park" title="WeezJump - Trampoline Park" class="img-responsive" width="auto" height="72">
					<h3 class="h3 mb-3 font-weight-normal">Validation de votre réservation</h3>
					
					<?php
					$arrayHeure = explode(",",$listeHorraire);
					$nbCreno = count($arrayHeure)-1;
					
					// On gére les pluriels
					$plurielPart = NULL;
					if($nbPart>1) {
						$plurielPart = "s";
					}
					
					$plurielCreno = NULL;
					if($nbCreno>1) {
						$plurielCreno = "s";
					}
					?>
			      
					<div class="panel panel-primary">
						
						<div class="panel-heading">Voici le récapitulatif de votre réservation</div>
						
						<div class="panel-body text-left" style="line-height: 1.7em;">
						
							<?php echo "Votre nom : <strong>".$prenomParticipant."&nbsp".$nomParticipant."</strong>, <br />"; 
								
							echo "Vous réservez pour <strong>".$nbPart." personne".$plurielPart."</strong>, ";
							echo "le <strong>".date_fr('l d F Y', $datepickeEcritr)."</strong> <br /><br />";
							echo "Pour <strong>".$nbCreno."</strong> session".$plurielCreno." à : ";
							 
								foreach($arrayHeure as $key => $val) {
									if($val != "")
									{
										echo "<label style='margin: 4px;' class='btn btn-warning'>";
											echo str_replace ( ":", "h",substr($val,0,-3));
										echo "</label>";
									}
								}
							?>
							<input type="hidden" name="datepicker" value="<?php echo $datepicker; ?>" />
							<input type="hidden" name="nbPart" value="<?php echo $nbPart; ?>" />
							<input type="hidden" name="listeHorraire" value="<?php echo $listeHorraire; ?>" />
							<input type="hidden" name="nomParticipant" value="<?php echo $nomParticipant; ?>" />
							<input type="hidden" name="prenomParticipant" value="<?php echo $prenomParticipant; ?>" />
							<input type="hidden" name="telParticipant" value="<?php echo $telParticipant; ?>" />
							<input type="hidden" name="mailParticipant" value="<?php echo $mailParticipant; ?>" />
						</div>
						
						<div class="panel-footer">
							<ul class="list-inline">
	                            <li class="first"><button type="button" class="btn btn-default prev-step" onClick="location.href='index.php'">Modifier ma réservation</button></li>
	                            <li class="last"><button type="submit" value="suivant" class="btn btn-primary next-step">Valider ma réservation</button></li>
	                        </ul>
						</div>
					
					</div>
					
				</form>
			    
		    </div>
	
	  	</div>
	</div>

</body>

</html>
