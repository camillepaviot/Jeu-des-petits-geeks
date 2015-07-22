<?php

session_start();

include('template.php');
require_once 'connexionBDD.php';

$template = new Template('./../Templates');

$template->set_filenames(array(
		'header' => 'header.html',
		'body' => 'profil.html',
		'footer' => 'footer.html'
));

if(isset($_POST) && !empty($_POST)){
	
	$error=0;
	
	$sql = "UPDATE users
		SET user_nom = '".addslashes($_POST['user_nom'])."',
		user_prenom = '".addslashes($_POST['user_prenom'])."',
		user_mail = '".addslashes($_POST['user_mail'])."',
		user_pseudo = '".addslashes($_POST['user_pseudo'])."',
		user_couleur = '".$_POST['user_couleur']."'
		WHERE user_id = '".$_SESSION['user']."' ";
	$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	
	if(isset($_POST['user_mdp1']) && $_POST['user_mdp1']!=''){
		
		$sql = "SELECT *
			FROM users
			WHERE user_id='".$_SESSION['user']."'
			AND user_mdp = '".sha1($_POST['user_old_mdp'])."' ";
		$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
		
		if($result = mysqli_fetch_assoc($query)){
			$sql = "UPDATE users
				SET user_mdp = '".sha1($_POST['user_mdp1'])."'
				WHERE user_id = '".$_SESSION['user']."' ";
			$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
		}
		else{
			$error=1;
		}
	}
	
	if($error==1){
		$template->assign_block_vars('erreur', array());
	}
	else{
		$template->assign_block_vars('succes', array());
	}
}

$sql = "SELECT *
	FROM users
	WHERE user_id='".$_SESSION['user']."' ";
$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
$result = mysqli_fetch_assoc($query);
$template->assign_vars($result);

$sql = "SELECT *
	FROM couleursuser
	ORDER BY couleur_id";
$query = mysqli_query($db, $sql) or exit(mysqli_error($db));

while($result_couleur = mysqli_fetch_assoc($query))
{
	$result_couleur['checked']='';
	if($result_couleur['couleur_id']==$result['user_couleur']){
		$result_couleur['checked']='checked';
	}
	$template->assign_block_vars('couleur', $result_couleur);
}

require_once 'index.php';

$template->pparse('header');
$template->pparse('body');
$template->pparse('footer');