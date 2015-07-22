<?php

session_start();

include('template.php');
require_once 'connexionBDD.php';

$template = new Template('./../Templates');

$template->set_filenames(array(
		'header' => 'header.html',
		'body' => 'accueil.html',
		'footer' => 'footer.html'
));

require_once 'index.php';

$template->pparse('header');
$template->pparse('body');
$template->pparse('footer');