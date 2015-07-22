<?php

session_start();

include('template.php');
require_once 'connexionBDD.php';

$template = new Template('./../Templates');

if(isset($_POST) && !empty($_POST)){
	
	$couleur=array('1'=>'B', '2'=>'J', '3'=>'V', '4'=>'R');
	
	$sql = "INSERT INTO parties
		(partie_etat,
		partie_type)
		VALUES(
		0,
		'".addslashes($_POST['type_id'])."' ) ";
	
	$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	$partie_id = mysqli_insert_id($db);
	
	foreach ($couleur as $key=>$value){
		$ordi=1;
		if(isset ($_POST['couleur_id']) && $_POST['couleur_id']==$key){
			$ordi=0;
		}
		$sql = "INSERT INTO geeks
			(geek_couleur,
			geek_partie,
			geek_user,
			geek_score,
			geek_ordi)
			VALUES(
			'".$key."',
			'".$partie_id."',
			'".$_SESSION['user']."',
			0,
			'".$ordi."') ";
			
		$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
		
	}
	
	header('location: ../PHP/partie.php?partie='.$partie_id);
	exit();
	
}

if(isset($_GET['partie']) && $_GET['partie']!=''){
	
	$sql = "SELECT type_case, type_num, partie_type, partie_id
		FROM parties
		INNER JOIN typespartie ON type_id = partie_type
		WHERE partie_id='".$_GET['partie']."' ";
	
	$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	$result = mysqli_fetch_assoc($query);
			
	if($result['partie_type']=='1'){
		$plateau='plateau_petit.html';
	}
	else if($result['partie_type']=='2'){
		$plateau='plateau_moyen.html';
	}
	else if($result['partie_type']=='3'){
		$plateau='plateau_grand.html';
	}
		
	$template->set_filenames(array(
			'header' => 'header.html',
			'body' => $plateau,
			'footer' => 'footer.html'
	));
	
	$sql = "SELECT couleur_lettre
		FROM geeks
		INNER JOIN couleursgeek ON couleur_id = geek_couleur
		WHERE geek_partie='".$_GET['partie']."'
		AND geek_ordi='0' ";
	
	$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	$result_geek = mysqli_fetch_assoc($query);
	
	$result['geek_joueur']='geek'.$result_geek['couleur_lettre'];
	
	
	$sql = "SELECT sauvegarde_case, sauvegarde_classe, couleur_lettre
		FROM sauvegardes
		INNER JOIN geeks ON geek_id = sauvegarde_geek
		INNER JOIN couleursgeek ON couleur_id = geek_couleur	
		WHERE sauvegarde_partie='".$_GET['partie']."' ";
	$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	
	$result['positionB']='DB';
	$result['positionJ']='DJ';
	$result['positionV']='DV';
	$result['positionR']='DR';
	
	$result['classeB']='enClasse';
	$result['classeJ']='enClasse';
	$result['classeV']='enClasse';
	$result['classeR']='enClasse';
	
	while($result_sauvegarde = mysqli_fetch_assoc($query)){
		$result['position'.$result_sauvegarde['couleur_lettre']]=$result_sauvegarde['sauvegarde_case'];
		$result['classe'.$result_sauvegarde['couleur_lettre']]=$result_sauvegarde['sauvegarde_classe'];
	}
	
	$template->assign_block_vars('partie', $result);
	
	require_once 'index.php';
	
	$template->pparse('header');
	$template->pparse('body');
	$template->pparse('footer');
	
}
else{
	header('location: ../PHP/accueil.php');
}

?>

