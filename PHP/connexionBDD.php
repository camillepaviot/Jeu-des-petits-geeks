<?php

/*$serveur = 'localhost';
$user = 'root';
$pass = '';
$bdd = 'petitsgeeks';
$port = '3306';

try{
	$db = new PDO('mysql:host='.$serveur.';port='.$port.'dbname='.$bdd, $user, $pass);
}
catch(PDOException $e){
	echo $e->getMessage();
}*/


// on se connecte � MySQL
$db = mysqli_connect('localhost', 'root', '');
// on s�lectionne la base
mysqli_select_db($db, 'petitsgeeks');

?>