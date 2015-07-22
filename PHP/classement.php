<?php

session_start();

include('template.php');
require_once 'connexionBDD.php';

$template = new Template('./../Templates');

$template->set_filenames(array(
		'header' => 'header.html',
		'body' => 'classement.html',
		'footer' => 'footer.html'
));

$sql = "SELECT SUM(geek_score) AS user_score, COUNT(geek_id) as user_nb_partie, 
		user_nom, user_prenom, user_pseudo, couleur_hexa
		FROM users
		INNER JOIN geeks ON geek_user=user_id AND geek_ordi=0
		INNER JOIN couleursuser ON couleur_id=user_couleur
		INNER JOIN parties ON partie_id=geek_partie AND partie_etat=2
		GROUP BY user_id
		ORDER BY SUM(geek_score) DESC
		LIMIT 10 ";
$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	
while($result = mysqli_fetch_assoc($query))
{
	$result['user_nb_gagne']=number_format($result['user_score']/10,2);
	$result['user_pourcent']=($result['user_score']*10)/$result['user_nb_partie'];
	if(!isset($result['user_pseudo']) || $result['user_pseudo']==''){
		$result['user_pseudo']=$result['user_prenom'].' '.$result['user_nom'];
	}
	$template->assign_block_vars('joueurs', $result);
}

require_once 'index.php';
	
$template->pparse('header');
$template->pparse('body');
$template->pparse('footer');


?>

