<?php
include("tools/conx.php");
include("tools/tools.php");
include("tools/js-css.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>WeezJump - Etape 2 - Date de la réservation</title>
	
<?php 	

if(isset($_POST['nbPart'])){
	$nbPartJS = $_POST['nbPart'];
}else if(isset($_GET['nbPart'])){
	$nbPartJS = $_GET['nbPart'];
}else {
	$nbPartJS = "nsb";
}

if(isset($_GET['motif'])){
	$css = "FC3";
}else{
	$css = "FFF";
}

?>
<!-- Permet de faire fonctionner le calendrier datepicker -->
<script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.23.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-fr.js"></script>

<script>	
		
	$(function() {
		$( "#datepicker" ).datepicker({
			onSelect: function(dateText, inst) {
				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth()+1; //January is 0!
				
				var yyyy = today.getFullYear();
				if(dd<10){
					dd='0'+dd;
				} 
				if(mm<10){
					mm='0'+mm;
				} 
				var today = dd+'/'+mm+'/'+yyyy;
				if(dateText == today){
					//alert("Pour des raisons d'organisation, nous ne prenons pas de réservation pour le jour même.");
					$.jAlert({
						'id': 'error1',
						'title':'Erreur',
						'content': '<div class="alerte">Pour des raisons d\'organisation, nous ne prenons pas de réservation pour le jour même.</div>',
						'size':'md',
						'theme': 'red',
						/*'showAnimation':'shake',*/
						/*'hideAnimation' :'zoomOutUp',*/
						'closeOnClick':'true'
					});
					return false;
				}
				location.href = 'horraire.php?datepicker='+dateText+'&nbPart=<? echo $nbPartJS; ?>';
			},
			minDate: new Date(), 
			defaultDate: -1, 
		});
	});
</script>

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
		
		                    <li role="presentation" class="active">
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
			    <div class="form-signin">
			      <img class="mb-4" src="img/logo-weezjump.png" alt="WeezJump - Trampoline Park" title="WeezJump - Trampoline Park" class="img-responsive" width="auto" height="72">
			      <h3 class="h3 mb-3 font-weight-normal">Pour quelle date ?</h3>
			      <p class="mb-3">(Pour des raisons d'organisation, nous ne prenons pas de réservation pour le jour même.)</p>
			      
				   <div id="datepicker"></div>
				   
			    </div>
		    </div>
	
	  	</div>
	</div>




</body>

</html>
