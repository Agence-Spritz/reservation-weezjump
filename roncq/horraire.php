<?php
include("tools/conx.php");
include("tools/tools.php");
include("tools/js-css.php");

$idLieuDeVente = 1;
$_SESSION["LVSelected"] = 1;


if(isset($_GET['datepicker'])){
		$dateBrutPicker = $_GET['datepicker'];
		$nbPart = $_GET['nbPart'];
		$dateTempL = explode('/',$_GET['datepicker']);
		$dateATester = $dateTempL[2]."-".$dateTempL[1]."-".$dateTempL[0];
		$_SESSION['dateSelectFormatA'] = $dateATester;
		//echo "et la date a tester est ".	$dateATester;
		
}

$today = date("Y-m-d");
if($dateATester == date("Y-m-d")){
	$tempoNbPers = $_GET['nbPart'];
	header("Location: date.php?motif=today&nbPart=$tempoNbPers");
}
else if($dateATester < date("Y-m-d")){
	header('Location: date.php?motif=avant&dateTeste='.$_SESSION["dateSelectFormatA"].'&datetoday='. date("Y-m-d"));
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>WeezJump - Etape 3 - Choix des sessions</title>

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
		                    <li role="presentation" class="active">
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
		
		                    <li role="presentation" class="disabled">
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
		        <?php $fermetureActive = "";
				$timestamp = strtotime($dateATester);
				$dgjki = strtotime($dateATester);
				$jourLet = date_fr("l",$timestamp);
				?>
			    <div class="form-signin">
				    <img class="mb-4" src="img/logo-weezjump.png" alt="WeezJump - Trampoline Park" title="WeezJump - Trampoline Park" class="img-responsive" width="auto" height="72">
				    <h3 class="h3 mb-1 font-weight-normal">A quelle heure ?</h3>
				    <h4 class="h4 mb-3 font-weight-normal"><? echo date_fr(" l d F Y",$timestamp); ?></h4>
				    
			      	<?php 
						if(isset($_GET['action']) && $_GET['action'] =='nsd') {
					
							echo '<div class="alert alert-danger" role="alert">Vous n\'avez pas sélectionné d\'heure pour votre session</div>';
							
						} 
   		
						// Verification si la date est exeptionnelle
						
						$_SESSION['dateSelectFormatB'] = date_fr("l d F Y",$timestamp);
						
						// requête de sélection
						$sql = mysqli_query($bdd,"SELECT * FROM ouvertureExp WHERE idLieuVente='$idLieuDeVente'  "); 
						
						$expOuNorm = 0;
						$dateATester = $_SESSION["dateSelectFormatA"];
						
						
						// On associe les résultats dans un tableau
					  	while ($row = mysqli_fetch_array($sql)) {
						  	
						  	if ($dateATester>= $row['dateDebut'] && $dateATester <= $row['dateFin']) {
									$expOuNorm ++;
									
									//echo "<br />".stripslashes($row['nonEven'])." /".$dateATester."<br>";
						  	
									if($row['fermetureExp'] == "oui") {
										$fermetureActive = "oui";
									}
									
							} 
				
						}
		
						//echo $timestamp.'nb Occurance : '.$expOuNorm;
						if($expOuNorm>0){$normalEx = "Exeptionnel";}else{$normalEx = "Normal";};
						//echo "Nous sommes donc un ".date_fr("l",$timestamp)." est dans une période : ".$normalEx;
						$jour = strtolower(date_fr("l",$timestamp));
						
						$queryHorraire = mysqli_query($bdd,"SELECT * FROM semaine WHERE jour='$jour' AND idLV='$idLieuDeVente' ");
				
						$rowHorraire = mysqli_fetch_array($queryHorraire);
						if($normalEx=="Normal"){
							//echo "<br> L'heure d'ouverture est : ".$rowHorraire['ouvNorm']."h";
							$horraireDebut = $rowHorraire['ouvNorm'];
							//echo "<br> L'heure de fermeture est : ".$rowHorraire['fermNorm']."h";
							$horraireFin = 	$rowHorraire['fermNorm'];
						}else{
							//echo "<br> L'heure d'ouverture est : ".$rowHorraire['ouvEx']."h";
							$horraireDebut = $rowHorraire['ouvEx'];
							//echo "<br> L'heure de fermeture est : ".$rowHorraire['fermEx']."h";
							$horraireFin = 	$rowHorraire['fermEx'];
						}
				
						$queryLV = mysqli_query($bdd,"SELECT * FROM lieuVente WHERE idLieuVente='$idLieuDeVente'");
						
						$rowLV = mysqli_fetch_array($queryLV);
		
		
						////////////////////////////////////// VERIF RESA EN COURS /////////////////////////////////////
						$dateResaSelect = $dateATester;
						$queryRESA = mysqli_query($bdd,"SELECT * FROM reservationClient WHERE lieuClient='$idLieuDeVente' AND dateResa='$dateResaSelect'  ");
						
						$stringHorraire ="";
						
						while ($rowRESA = mysqli_fetch_array($queryRESA)) {
							$stringHorraire = $stringHorraire.",".$rowRESA['heureResa'] ;
						}
						$arrayResaHorraire = explode(",",$stringHorraire);
						?>
        

					<form action="clientB.php" method="post" name="formHoraire" id="formHoraire">
						
				        <input name="datepicker" value="<? echo $dateBrutPicker; ?>" type="hidden" />
				        <input name="nbPart" value="<? echo $_GET['nbPart']; ?>" type="hidden" />
				        
				        <?php
						// On stocke le nom du lieu de vente en session
						$_SESSION['nomLieuDeVente'] = $rowLV['nomLV'];
						
						echo '<div class="alert alert-warning mb-3" style="font-size: 12px;" role="alert"><strong>La durée d\'une session est de : '.$rowLV["trancheLV"].' min</strong><br />
						<strong>Important !</strong> Une présence 20 minutes avant le début de la session est obligatoire</div>';
						
						
							$varTempoA = 1;
							if($rowLV['trancheLV'] == 60){
								$AA = 60; $BB=0;
							}else if($rowLV['trancheLV'] == 30){
								$AA = 30; $BB=30;
							
							}
						
						
						if($fermetureActive != "oui") {
							//echo "on n'est pas fermé";
							$horraireFinRectif = $horraireFin-1;
							
							echo "<div class='mb-3' data-toggle='buttons'>";
							echo "<p class='mb-1'>(Vous pouvez sélectionner plusieurs sessions)</p>";
						
							for ($i= $horraireDebut ;$i<= $horraireFin-1 ;$i++) {
					
							        for ($j=0;$j<=$BB;$j+=$AA) {
											
										if($j!= 0){
											$jO= $j;
										}else{
											$jO ="00";
										}
										
										if($j!= 0){
											$jF= $j;
										}else{
											$jF ="00";
										}
										
										if($j !=60 || $i != 9){
											
											$stringdeTest = $i.":".$jF.":00";
											
											if(in_array($stringdeTest, $arrayResaHorraire)) {
												
												$heure = $i.":".$jF.':00';
												
												$dateTempo = $dateATester;
												$queryInfo = mysqli_query($bdd,"SELECT * FROM reservationClient,clients WHERE reservationClient.idClient = clients.idClient AND reservationClient.dateResa = '$dateTempo' AND reservationClient.heureResa = '$heure' AND reservationClient.lieuClient = '$idLieuDeVente'");
												
												$comptagePlaceDispo = 0;
												$nbreservation = 0;
												while ($rowDE = mysqli_fetch_array($queryInfo)){
													$nbreservation++;
													//echo $rowDE->nbClient.'- idResa : '.$queryInfo;
													$comptagePlaceDispo += intval($rowDE['nbClient']);
													
												}
												
												$lvPlacedispo = 26;
												$reste = $lvPlacedispo - $comptagePlaceDispo;
												if(intval($reste) >= $nbPart && $nbreservation<4){
													
													//echo '<input class="option" type="checkbox" name="lazone['.$varTempoA.']" value="'.$i.":".$jF.':00" id="check'.$varTempoA .'"   /><label for="check'.$varTempoA .'"  class = "optionL" id ="label'.$varTempoA .'" >'.rectifHeure($i)."h".$jO.''.'</label>';
													
													echo "<label style='margin: 4px;' class='btn btn-warning'>";
														echo '<input class="option" type="checkbox" name="lazone['.$varTempoA.']" value="'.$i.":".$jF.':00" id="check'.$varTempoA .'" autocomplete="off">'.rectifHeure($i)."h".$jO;
													echo "</label>";

												$varTempoA ++;
												}else {
													
													echo "<label style='margin: 4px;' class='btn btn-primary' disabled>";
														echo rectifHeure($i)."h".$jO;
													echo "</label>";
												}
												
											}else{
												
											    echo "<label style='margin: 4px;' class='btn btn-warning'>";
											      echo '<input class="option" type="checkbox" name="lazone['.$varTempoA.']" value="'.$i.":".$jF.':00" id="check'.$varTempoA .'" autocomplete="off">'.rectifHeure($i)."h".$jO;
											    echo "</label>";
												 
												$varTempoA ++;
											}
										}
							
							        }
							}
							
							echo "</div>";
				
						}else{
							echo '<div class="alert alert-danger" role="alert">Désolé, WeezJump est exceptionnellement fermé ce jour</div>';
						}
					?>
						<ul class="list-inline">
                            <li><button type="button" class="btn btn-default prev-step" OnClick="window.location.href='date.php?nbPart=<? echo $_GET['nbPart']; ?>'">changer de date</button></li>
                            <li><button type="submit" value="suivant" class="btn btn-primary next-step">Continuer</button></li>
                        </ul>
				    </form>
					
			    </div>
	        </div>
	        
	  	</div>
	</div>
		
</body>

</html>
