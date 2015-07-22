<?php

if(isset($_SESSION['user']) && $_SESSION['user']!=''){
	$template->assign_block_vars('connect', array());
}
else{
	$sql = "SELECT *
			FROM couleursuser
			ORDER BY couleur_id";
	
	$query = mysqli_query($db, $sql) or exit(mysqli_error($db));
	
	while($result = mysqli_fetch_assoc($query))
	{
		$template->assign_block_vars('couleur', $result);
	}
	
	$template->assign_block_vars('no_connect', array());
}
