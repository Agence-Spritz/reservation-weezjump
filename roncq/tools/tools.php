<?php

$minQtepersonnes = 1;

function recup($var)
	{	if (isset($_POST[$var])) return addslashes($_POST[$var]);
		else return "";
	}
	
	
	
function date_fr($format, $timestamp=false) {
	
	if ( !$timestamp ) $date_en = date($format);
	else               $date_en = date($format,$timestamp);

	$texte_en = array(
		"Monday", "Tuesday", "Wednesday", "Thursday",
		"Friday", "Saturday", "Sunday", "January",
		"February", "March", "April", "May",
		"June", "July", "August", "September",
		"October", "November", "December"
	);
	$texte_fr = array(
		"Lundi", "Mardi", "Mercredi", "Jeudi",
		"Vendredi", "Samedi", "Dimanche", "Janvier",
		"F&eacute;vrier", "Mars", "Avril", "Mai",
		"Juin", "Juillet", "Ao&ucirc;t", "Septembre",
		"Octobre", "Novembre", "D&eacute;cembre"
	);
	$date_fr = str_replace($texte_en, $texte_fr, $date_en);

	$texte_en = array(
		"Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun",
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul",
		"Aug", "Sep", "Oct", "Nov", "Dec"
	);
	$texte_fr = array(
		"Lun", "Mar", "Mer", "Jeu", "Ven", "Sam", "Dim",
		"Jan", "F&eacute;v", "Mar", "Avr", "Mai", "Jui",
		"Jui", "Ao&ucirc;", "Sep", "Oct", "Nov", "D&eacute;c"
	);
	$date_fr = str_replace($texte_en, $texte_fr, $date_fr);

	return $date_fr;
}


function rectifHeure($heure){
	
	
			if($heure>23){
				$tempofdg = $heure-24;
				return "0".$tempofdg;
				}else{
					return $heure;
				}
}
?>