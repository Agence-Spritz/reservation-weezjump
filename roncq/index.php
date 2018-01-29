<?php
include("tools/conx.php");
include("tools/tools.php");
include("tools/js-css.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>WeezJump - Etape 1 - Nombre de personnes</title>
</head>

<body class="text-center">

	<div class="container">
		<div class="row" style="">
			<section>
		        <div class="wizard">
		            <div class="wizard-inner">
		                <div class="connecting-line"></div>
		                <ul class="nav nav-tabs" role="tablist">
		
		                    <li role="presentation" class="active">
		                        <a href="#" data-toggle="tab" aria-controls="Nombre de personnes" role="tab" title="Nombre de personnes">
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
			    <form class="form-signin" action="date.php" method="post" enctype="application/x-www-form-urlencoded" name="loginForm">
			      <img class="mb-4" src="img/logo-weezjump.png" alt="WeezJump - Trampoline Park" title="WeezJump - Trampoline Park" class="img-responsive" width="auto" height="72">
			      <h3 class="h3 mb-3 font-weight-normal">Combien serez-vous ?</h3>
			      <p class="mb-3">Veuillez indiquer le nombre de participants concernés par cette réservation</p>
			      
				    <select name="nbPart" id="boutonChoix" class="form-control " required>
				        <?php for($i=$minQtepersonnes;$i<=26;$i++){
							  echo '<option value="'.$i.'">'.$i.'</option>';
						  }
						?>
					</select>
			      
			      <button class="btn btn-lg btn-primary btn-block" type="submit" value="Suivant" name="bouton">Suivant</button>
			      
			    </form>
		    </div>
	
	  	</div>
	</div>

</body>
</html>
