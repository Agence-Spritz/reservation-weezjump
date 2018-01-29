<?php
include("tools/conx.php");
include("tools/tools.php");
include("tools/js-css.php");

if(isset($_POST["nomParticipant"]) ){

	// Récupération des variables
	$datepicker = $_POST["datepicker"];
	$nbPart = $_POST["nbPart"];
	$listeHorraire = $_POST["listeHorraire"];
	$nomParticipant = strtoupper($_POST["nomParticipant"]);
	$prenomParticipant = $_POST["prenomParticipant"];
	$telParticipant = $_POST["telParticipant"];
	$mailParticipant = $_POST["mailParticipant"];
	$lieuClient = 1;
	$validationClient = 0;
	$ipClient = $_SERVER["REMOTE_ADDR"];
	$dateTempL = explode('/',$datepicker);
	$datepicker = $dateTempL[2]."-".$dateTempL[1]."-".$dateTempL[0];
	$dateAction = date("Y-m-d H:i:s");
	
	//////////// Generation de code aleatoire
	$characts    = 'abcdefghijklmnopqrstuvwxyz';
	$characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
	$characts   .= '1234567890'; 
	$code_aleatoire      = ''; 
	
	$dateAction = date("Y-m-d H:i:s");

	for($i=0;$i < 20; $i++)    //10 est le nombre de caractères
	{ 
        $code_aleatoire .= substr($characts,rand()%(strlen($characts)),1); 
	}
	
	$codeValidationClient =  $code_aleatoire;
	///////////////////////////////////////////
	
	// Avant d'enregistrer le client, on va vérifier que celui-ci n'existe pas deja
	$sql = mysqli_query($bdd, "SELECT COUNT(idClient) as occ_client, idClient FROM clients WHERE nomClient = '".$nomParticipant."' AND prenomClient = '".$prenomParticipant."' AND mailClient = '".$mailParticipant."'");
	$rowclient = mysqli_fetch_assoc($sql);
	
	// On regarde le nbr d'occurences
	$occ_client = $rowclient['occ_client'];
	
	// si existe, alors on récupére l'ID,
	if($occ_client>0) {
		// On récupére son ID
		$dernier_id = $rowclient['idClient'];
		
	} 
	// Ce client n'existe pas, on va le créer
	else {
		// Enregistrement du client
		$queryA = mysqli_query($bdd,"INSERT INTO clients(nomClient, prenomClient, telClient, mailClient) VALUE ('$nomParticipant','$prenomParticipant','$telParticipant','$mailParticipant')");
		// On récupére l'ID créé
		$dernier_id = mysqli_insert_id($bdd);
	}	
	
		// Enregistrement en BDD de la réservation
		$tableauHorro = explode (',',$listeHorraire);
		
		for($o=0; $o<count($tableauHorro);$o++){
			$tempo = $tableauHorro[$o];
			if($tempo != ""){
				
				$queryB = mysqli_query($bdd,"INSERT INTO 	
				reservationClient (dateResa, heureResa, ipClient, nbClient, validationClient, lieuClient, codeValidationClient, dateAction, idClient, resaDone, type, commentaire)
				VALUE ('$datepicker','$tempo','$ipClient','$nbPart','$validationClient','$lieuClient','$codeValidationClient','$dateAction', '$dernier_id','0','part','')");
				
			}
		
		}
	



	// Création de la fonction d'envoi de mail
	function emailClient($destinataire, $expediteur, $reponse, $idtempo, $codeValidationClient, $datepicker, $nbPart, $listeHorraire){
		
		$timestamp = strtotime($datepicker);
		$dateecrite = date_fr(" l d F Y",$timestamp);
		
		$From  = "From:".$reponse."\n";
		$From .= "MIME-version: 1.0\n";
		$From .= "Content-type: text/html; charset= UTF-8\n";
		
		$urlSite = "http://reservation.weezjump.com";
		
		$Message = '<style type="text/css">
			body{
				background-color:#ef7c00;
			}
			.txtSTD {
				color: #FFF;
				font-family:Verdana, Geneva, sans-serif;
				font-size:10px;
			}

			.bigText{
				color: #FFF;
				font-family:Verdana, Geneva, sans-serif;
				font-size:14px;
				font-weight:bold;
				line-height:12px;
			}
			.bigMots{
					color: #FFF;
				font-family:"Arial",Verdana, Geneva, sans-serif;
				font-size:16px;
				font-weight:bold;

				text-decoration:none;
			}
			a.bigMots:link{
				color: #38611E;
				font-family:"Arial",Verdana, Geneva, sans-serif;
				font-size:16px;
				font-weight:bold;

				text-decoration:none;
			}
			a.bigMots:visited{
				color: #38611E;
				font-family:"Arial",Verdana, Geneva, sans-serif;
				font-size:16px;
				font-weight:bold;
				
				text-decoration:none;
			}
			a.bigMots:hover{
				color: #38611E;
				font-family:"Arial", Verdana, Geneva, sans-serif;
				font-size:16px;
				font-weight:bold;
				
				text-decoration:none;
			}

			</style>
			
			<body bgcolor="#ef7c00" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
			
			<table border="0" cellpadding="0" cellspacing="0"  bgcolor="#ef7c00">
			  <tr>
				<td colspan="2"><img src="'.$urlSite.'/imagesMAIL/resa_01.jpg" width="622" height="99" alt="" /></td>
			  </tr>
			  <tr>
				<td width="40"  bgcolor="#ef7c00"><img src="'.$urlSite.'/imagesMAIL/resa_02.jpg" width="40" height="59" alt="" /></td>
				<td width="576" bgcolor="#ef7c00"><span class="bigMots">Merci d\'avoir réservé pour le '.$dateecrite.' au WeezJump de Roncq<br> Session à '.$listeHorraire.' pour  '.$nbPart.' personnes </span><br /><span class="bigMots">
				Afin de valider votre réservation, merci de cliquer sur le lien ci-dessous</span></td>
			  </tr>
			  <tr>
				<td colspan="2"><a href="'.$urlSite.'/validation.php?codeVal='.$codeValidationClient.'"><img src="'.$urlSite.'/imagesMAIL/resa_04.jpg" width="622" height="74" alt="" border="0" /></a></td>
			  </tr>
			  <tr>
				<tr>
				<!--<td colspan="2"><img src="'.$urlSite.'/imagesMAIL/resa_05.jpg"  alt="" /></td>-->
				<td width="40"  bgcolor="#ef7c00"><img src="'.$urlSite.'/imagesMAIL/resa_02.jpg" width="40" height="59" alt="" /></td>
				<td class="bigText">
				Merci pour votre réservation !<br>
				Voici des instructions importantes concernant votre venue :<br><br>

				-	Merci de bien vouloir être présent au complet 20 minutes avant le début de votre session. Sans cela, votre réservation ne sera plus prise en compte et d’autres participants pourront être inscrits à votre place.<br>
				-	En cas de retard ou d’annulation, merci de bien vouloir nous prévenir au plus tôt au 03 20 01 32 00.<br>
				-	Assurez vous d’avoir réservé pour suffisamment de participants : nous ne pouvons vous garantir de disposer de places supplémentaires pour votre groupe.<br>
				-	Les réservations jugées fantaisistes (nombre de participants ou nombre de sessions jugés anormaux, informations erronées) ne seront pas prises en compte.<br>
				-	Pour des raisons de sécurité et d’assurance, les participants doivent être âgés d’au moins 5 ans. Jusque 7 ans, un accompagnateur responsable (entrée payante) sera demandé.<br>
				-	Effectuer une réservation ne privatise ni le site, ni l’aire de trampolines. Les sessions sont toujours ouvertes à d’autres participants ayant réservé ou non.<br>
				-	Pensez à venir dans une tenue adaptée à la pratique du trampoline.<br>
				-   Lors de votre première visite, l\'achat d\'une paire de chaussettes antidérapante WeezJump ( à 2&euro; et réutilisable) est obligatoire.<br><br>

				Nous restons à votre disposition au 03 20 01 32 00 durant les horaires d’ouverture pour répondre à vos questions et vous conseiller sur l’organisation de vos sessions.<br><br>

				A bientôt dans votre Trampoline Park WEEZJUMP !
				</td>
			  </tr>
			  </tr>
			  <tr>
				<td colspan="2">&nbsp;</td>
			  </tr>
			</table><br>';
		
		mail($destinataire, "Validation de la réservation en ligne WeezJump",$Message, $From);	
		return true;
	}

 
	//Envoi du mail de confirmation au client
	if(emailClient($mailParticipant, "contact@weezjump.com", "contact@weezjump.com", "2", $codeValidationClient, $datepicker, $nbPart, $listeHorraire)) {
		$valid_envoi = 1;    
	} else {
		$valid_envoi = 0;  
	}

	$_SESSION = array();
	$_SESSION['resafaite'] = 'ok';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>WeezJump - Confirmation de votre demande</title>
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
			    
			    <div class="form-signin" >
				    
				    <img class="mb-3" src="img/logo-weezjump.png" alt="WeezJump - Trampoline Park" title="WeezJump - Trampoline Park" class="img-responsive" width="auto" height="72">
				    
				    <?php if($ipClient != "2.5.144.40" && $ipClient != "92.92.128.85"){ ?>
				    
				    	<?php if($valid_envoi==1) { ?>
					    <div class="panel panel-success">
						    
						    <div class="panel-heading"><i style="color: green" class="glyphicon glyphicon-ok-circle"></i> Merci pour votre réservation !</div>
							
							<div class="panel-body text-center" style="line-height: 1.7em;">
									<p><strong>L'équipe du WeezJump vous remercie pour votre réservation !</strong><br /><br />
									Un email vient de vous être envoyé sur <strong><?php echo $mailParticipant; ?></strong> afin de valider cette réservation, veuillez suivre les indications y figurant.
									</p>
							</div>
						    
					    </div>
					    <?php } else { ?>
					    
								<div class="alert alert-danger">
									<p><strong>Attention !</strong> Une erreur est survenue lors de l'envoi du mail de confirmation, veuillez renouveler votre réservation.</p>
								</div>
							    
					    <?php } ?>
				    
				    <? } else {?>
				    
							<div class="alert alert-danger">
								<p><strong>Attention !</strong> Votre adresse IP ne vous permet plus de faire de réservation en ligne, vous pouvez toutefois nous téléphoner.</p>
							</div>
						    	
					<? } ?>
					
				</div>
			    
		    </div>
	
	  	</div>
	</div>
	
</body>


</html>
