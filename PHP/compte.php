<?php

session_start();

include('template.php');
require_once 'connexionBDD.php';

$template = new Template('./../Templates');

$template->set_filenames(array(
		'header' => 'header.html',
		'body' => 'compte.html',
		'footer' => 'footer.html'
));

if(isset($_GET['action']) && $_GET['action']=='deconnexion'){
	unset($_SESSION['user']);
}

if(isset($_POST) && !empty($_POST)){
	
	// creation d'un nouveau compte
	if(isset($_GET['action']) && $_GET['action']=='creation'){
		
		$sql = "SELECT user_mail, user_mdp, user_id
			FROM users
			where user_mail='".$_POST['user_mail']."' ";
		
		$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
		
		// si l'adresse mail est d�j� utilis�e pour un compte on met un message d'erreur
		if($result = mysqli_fetch_assoc($query)) {
					
			$template->assign_block_vars('erreur', array());
			$template->assign_block_vars('erreur.exist', array());
					
		}
		// sinon on cr�e le compte
		else{
					
			$sql = "INSERT INTO users
				(user_nom,
				user_prenom,
				user_mail,
				user_mdp,
				user_pseudo,
				user_couleur)
				VALUES(
				'".addslashes($_POST['user_nom'])."',
				'".addslashes($_POST['user_prenom'])."',
				'".addslashes($_POST['user_mail'])."',
				'".sha1($_POST['user_mdp'])."',
				'".addslashes($_POST['user_pseudo'])."',
				'".$_POST['user_couleur']."' ) ";
		
			$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
					
			$_SESSION['user'] = mysqli_insert_id($db);
					
		}
	}
	// identification
	else{
		$sql = "SELECT user_mail, user_mdp, user_id
			FROM users
			where user_mail='".$_POST['user_mail']."'
			and user_mdp='".sha1($_POST['user_mdp'])."' ";
		
		$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
		
		if($result = mysqli_fetch_assoc($query)) {
			$_SESSION['user'] = $result['user_id'];
		}
		else {
			$template->assign_block_vars('erreur', array());
			$template->assign_block_vars('erreur.no_exist', array());
		}
	}
}
else if(!isset($_SESSION['user']) || $_SESSION['user']==""){
	$template->assign_block_vars('erreur', array());
	$sql = "SELECT *
			FROM couleursuser
			ORDER BY couleur_id ";
	
	$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	
	while($result = mysqli_fetch_assoc($query))
	{
		$template->assign_block_vars('erreur.couleur', $result);
	}
}

require_once 'index.php';

$template->pparse('header');
$template->pparse('body');
$template->pparse('footer');


?>

