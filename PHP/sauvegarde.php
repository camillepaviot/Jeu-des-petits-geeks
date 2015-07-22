<?php

session_start();

require_once 'connexionBDD.php';

if(isset($_POST) && !empty($_POST)){
	
	$couleur=array('1'=>'B', '2'=>'J', '3'=>'V', '4'=>'R');
	
	if(isset($_POST['gagnant']) && $_POST['gagnant']!=''){
		$sql = "UPDATE parties
				SET partie_etat = 2
				WHERE partie_id = '".$_POST['partie_id']."' ";
		$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
		
		$gagnant = substr($_POST['gagnant'], 4, 1);
		
		$gagnant = array_search($gagnant, $couleur);

		$sql = "UPDATE geeks
			SET geek_score = 10
			WHERE geek_partie='".$_POST['partie_id']."'
			AND geek_couleur='".$gagnant."' ";
		$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	}
	else{
		
		foreach ($couleur as $key=>$value){
					
			$sql = "SELECT geek_id
				FROM geeks
				WHERE geek_couleur='".$key."' ";
					
			$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
			$result_geek = mysqli_fetch_assoc($query);
					
			$sql = "UPDATE parties
				SET partie_etat = 1
				WHERE partie_id = '".$_POST['partie_id']."' ";
			$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
			
			$sql = "SELECT *
				FROM sauvegardes
				WHERE sauvegarde_partie='".$_POST['partie_id']."'
				AND sauvegarde_geek='".$result_geek['geek_id']."' ";
			$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
			
			if($result = mysqli_fetch_assoc($query)){
				$sql = "UPDATE sauvegardes
					SET sauvegarde_case = '".$_POST['position'.$value]."',
					sauvegarde_classe = '".$_POST['classe'.$value]."'
					WHERE sauvegarde_partie = '".$_POST['partie_id']."'
					AND sauvegarde_geek='".$result_geek['geek_id']."' ";
				$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
			}
			else{
				$sql = "INSERT INTO sauvegardes
					(sauvegarde_geek,
					sauvegarde_case,
					sauvegarde_classe,
					sauvegarde_partie)
					VALUES(
					'".$result_geek['geek_id']."',
					'".$_POST['position'.$value]."',
					'".$_POST['classe'.$value]."',
					'".$_POST['partie_id']."' ) ";
				$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
				
			}
		
		}
	}
}
