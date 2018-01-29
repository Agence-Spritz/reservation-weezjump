<?php
$host="localhost";
$user = "root";
$pass = "root";
$base = "reservation-weezjump-v2";


   // CONNEXION
	$bdd = mysqli_connect($host,$user,$pass,$base) or die("Error " . mysqli_error($bdd)); 

?>