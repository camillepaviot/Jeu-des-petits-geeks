<?php

session_start();

include('template.php');
require_once 'connexionBDD.php';

$template = new Template('./../Templates');

if(isset($_SESSION['user']) && $_SESSION['user']!=""){
	
	$template->set_filenames(array(
			'header' => 'header.html',
			'body' => 'parties.html',
			'footer' => 'footer.html'
	));

	$sql = "SELECT partie_id, partie_etat, couleur_desc, type_desc, geek_score
			FROM parties
			INNER JOIN typespartie ON type_id=partie_type
			LEFT JOIN sauvegardes ON sauvegarde_partie=partie_id
			INNER JOIN geeks ON geek_partie=partie_id 
				AND geek_ordi=0 AND geek_user='".$_SESSION['user']."'
			INNER JOIN couleursgeek ON couleur_id=geek_couleur
			GROUP BY partie_id
			ORDER BY partie_id ";
	$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	
	$partie_jouee=0;
	$partie_finie=0;
	$partie_gagnee=0;
	$pourcent=0;
	
	while($result = mysqli_fetch_assoc($query))
	{
		$template->assign_block_vars('parties', $result);
		if($result['partie_etat']==0){
			$template->assign_block_vars('parties.commence', $result);
		}
		else if($result['partie_etat']==1){
			$template->assign_block_vars('parties.encours', $result);
		}
		else if($result['partie_etat']==2){
			$score='perdu';
			if($result['geek_score']=='10'){
				$score='gagn�';
				$partie_gagnee++;
			}
			$template->assign_block_vars('parties.fini', array('score'=>$score));
			
			$partie_finie++;
		}
		$partie_jouee ++;
	}
	
	if($partie_finie!=0){
		$pourcent=number_format((100*$partie_gagnee)/$partie_finie, 2);
	}
	
	$template->assign_vars(array(
			'partie_jouee'=>$partie_jouee,
			'partie_finie'=>$partie_finie,
			'pourcentage'=>$pourcent	
	));
	
	require_once 'index.php';
	
	$template->pparse('header');
	$template->pparse('body');
	$template->pparse('footer');
}
else{
	header('location: ../PHP/accueil.php');
}

?>

