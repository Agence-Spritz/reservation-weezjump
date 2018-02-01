<?php
/*
$host="localhost";
$user = "root";
$pass = "root";
$base = "reservation-weezjump-v2";
*/

$host="weezjumpsgresbdd.mysql.db";
$user = "weezjumpsgresbdd";
$pass = "4ox8zZq2zA";
$base = "weezjumpsgresbdd";


   // CONNEXION
	$bdd = mysqli_connect($host,$user,$pass,$base) or die("Error " . mysqli_error($bdd)); 

?>