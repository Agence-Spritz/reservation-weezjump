$(document).ready(function() {
	
	//RECHERCHER UNE RESERVATION
	$('#form1').submit(function () {
		var name = $.trim($('#nomEvenement').val());

		// Check if empty of not
		if (name  === '') {
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Veuillez saisir une r&eacute;servation !</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true'
			});
			return false;
		}

	});
	
	
	$('#clientForm').submit(function () {
		var nom = $.trim($('#nom').val());
		// Check if empty of not
		if (nom  === '') {
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Veuillez saisir votre nom !</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true',
				'onClose': function(alertElem){
					$('#nom').focus();
			    }
			});
			
			return false;
		}
		var prenom = $.trim($('#prenom').val());
		if (prenom  === '') {
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Veuillez saisir votre pr&eacute;nom !</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true',
				'onClose': function(alertElem){
					$('#prenom').focus();
			    }
			});
			
			return false;
		}
		
		var nom = $.trim($('#mail').val());
		// Check if empty of not
		if (mail  === '') {
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Veuillez saisir votre email !</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true'
			});
			return false;
		}
		
		var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
		var tel = $.trim($('#tel').val());
		if (tel  === '') {
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Veuillez saisir votre t&eacute;l&eacute;phone !</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true'
			});
			return false;
		}
		if (tel.length< 10) {
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Num&eacute;ro invalide !<br />Il doit comporter 10 chiffres !</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true'
			});
			return false;
		}
		
		var regmail = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
		var mail = $.trim($('#mail').val());
		if (mail  === '') {
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Veuillez saisir votre adresse email !</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true'
			});
			return false;
		}
		if(regmail.test(mail))
		{
			return(true);
		}
		else
		{
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Adresse email invalide!</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true'
			});
			return false;
		}

	});
	
	$('#formHoraire').submit(function () {
		var coches = $('input:checkbox:checked.option').map(function () {
		  return this.value;
		}).get();
		if(coches.length==0){
			$.jAlert({
				'id': 'error1',
				'title':'Erreur',
				'content': '<div class="alerte">Veuillez choisir au moins une heure pour votre session !</div>',
				'size':'md',
				'theme': 'red',
				/*'showAnimation':'shake',*/
				/*'hideAnimation' :'zoomOutUp',*/
				'closeOnClick':'true'
			});
			return false;
		}
		if(coches.length>0){
			return true;
		}
		
	});
	
	
	function check1() {
		var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i')
		
		 var ss = document.loginForm.tel.value;
			var result = ss.length
			
		  
		  if(ss.length< 10){
			 Jalert('N° de téléphone non valide');
			document.loginForm.tel.focus();
			return false; 
		  }
		  
		  
	  if (document.loginForm.nom.value == '') {
		alert('Nom obligatoire.');
		document.loginForm.nom.focus();
		return false;
	  }
	  
	   if (document.loginForm.prenom.value == '') {
		alert('Prénom obligatoire.');
		document.loginForm.prenom.focus();
		return false;
	  }
	  
	  
	   var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	 
		if(reg.test(document.loginForm.mail.value))
		  {
			return(true);
		  }
		else
		  {
			  alert("Votre adresse mail n'est pas valide");
			return(false);
		  }
	 
	  return true;
	}
	
	
	




});