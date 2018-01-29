<?php
include("tools/conx.php");
include("tools/tools.php");
include("tools/js-css.php");

	if(isset($_POST['lazone'])){
		$arrayHorraire = $_POST['lazone'];
		$listeHorraire ="";
	foreach($arrayHorraire as $key => $val) $listeHorraire = $listeHorraire.$val.',';
		$_SESSION['listageHorraire'] =  $listeHorraire;
	}else{
		$tempoDatePick = $_POST['datepicker'];
		$tempoNbPick = $_POST['nbPart'];
		header("Location: horraire.php?datepicker=$tempoDatePick&nbPart=$tempoNbPick&action=nsd");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>WeezJump - Etape 4 - Informations de contact</title>
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
		                    <li role="presentation" class="active">
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
			    <form class="form-signin" action="recap.php" method="post" enctype="application/x-www-form-urlencoded" name="clientForm" id="clientForm" >
				    <input type="hidden" name="datepicker" value="<? echo $_POST['datepicker']; ?>" />
					<input type="hidden" name="nbPart" value="<? echo $_POST['nbPart']; ?>" />
					<input type="hidden" name="listeHorraire" value="<? echo $listeHorraire; ?>" />
					
			      <img class="mb-4" src="img/logo-weezjump.png" alt="WeezJump - Trampoline Park" title="WeezJump - Trampoline Park" class="img-responsive" width="auto" height="72">
			      <h3 class="h3 mb-3 font-weight-normal">Qui êtes-vous ?</h3>
			      <p class="mb-3">(A quel nom doit-on enregistrer cette réservation?)</p>
			      
			      <div class="form-group">
<!-- 				    <label for="nom">Nom</label> -->
				    <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
				  </div>
				  <div class="form-group">
<!-- 				    <label for="prenom">Prénom</label> -->
				    <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom">
				  </div>
				  <div class="form-group">
<!-- 				    <label for="tel">Tél.</label> -->
				    <input type="text" class="form-control" name="tel" id="tel" placeholder="Tél">
				  </div>
			      <div class="form-group">
<!-- 				    <label for="mail">Email address</label> -->
				    <input type="email" class="form-control" name="mail" id="mail" placeholder="Email">
				  </div>
  
				   <button class="btn btn-lg btn-primary btn-block" type="submit" name="bouton" value="Suivant" name="bouton">Suivant</button>
				   
			    </form>
		    </div>
	
	  	</div>
	</div>

</body>

</html>
