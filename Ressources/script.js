
var geek;
var tour;


var geekNom = new Array();
geekNom['geekB']='petit geek bleu';
geekNom['geekJ']='petit geek jaune';
geekNom['geekV']='petit geek vert';
geekNom['geekR']='petit geek rouge';

$(document).ready(function() {
	
		geek = '';
		tour = 0;
		
		$('#modal_de .modal-body h1').html('Au tour du ' + geekNom[geek]);
});

function tourSuivant() {

	switch(geek){
		case 'geekB' :
			geek = 'geekJ';
			break;
		case 'geekJ':
			geek = 'geekV';
			break;
		case 'geekV':
			geek = 'geekR';
			break;
		case 'geekR':
			geek = 'geekB';
			break;
		default:
			geek = geekJouer;
			break;
	}
	
	$('#modal_de .modal-body h1').html('Au tour du ' + geekNom[geek]);
	
	if(geekJouer==geek){
		$('#modal_de .modal-body #de').html('');
		$('#modal_de .modal-body #info').html('');
		$('#modal_de .modal-body #btn_de').show();
		$('#modal_de .modal-body #btn_suivant').hide();
		$('#modal_de .modal-body #btn_fermer').hide();
		
		$('body').addClass('modal-de-open');
		$('#modal_de').modal({backdrop:'static'});
	}
	else{
		lancerDeRobot();
	}
}

function lancerDeRobot() {
	
	$('#modal_de .modal-body #btn_de').hide();
	$('#modal_de .modal-body #btn_suivant').show();
	$('#modal_de .modal-body h1').html('Au tour du ' + geekNom[geek]);
	
	var D = Math.floor((Math.random() * 10) + 1);
	while(D > 6){
		D = Math.floor((Math.random() * 10) + 1);
	}
	$('#modal_de .modal-body #de').html(D);

	if ($('#' + geek).hasClass('enClasse') == true) {
		avancer('sortir', D, 1);
	} else if ($('#' + geek).hasClass('tourComplet') == true) {
		avancer('monter', D, 1);
	} else {
		avancer('avancer', D, 1);
	}
}

function lancerDe() {
	
	$('#modal_de .modal-body #btn_de').hide();
	$('#modal_de .modal-body #btn_suivant').show();
	
	var d;
	var D;

	var x = setInterval(function() {
		D = Math.floor((Math.random() * 10) + 1);
		if (D <= 6) {
			d=D
			$('#modal_de .modal-body #de').html(d);
		}
	}, 10);
	
	setTimeout(function() {
		clearInterval(x);
		if ($('#' + geek).hasClass('enClasse') == true) {
			avancer('sortir', d, 0);
		} else if ($('#' + geek).hasClass('tourComplet') == true) {
			avancer('monter', d, 0);
		} else {
			avancer('avancer', d, 0);
		}
	}, 1000);
}


function avancer(action, resultDe, robot){
	
	var couleur = '';
	var position = '';
	var newPosition = '';
	
	switch(action){
		case 'sortir':
			couleur = $('#' + geek).attr('id');
			couleur = couleur.substring(5, 4);
			
			if (resultDe == 6) {
				$('#' + geek).remove();
				$('#' + couleur + '1').append(
						'<div class="geek" id="' + geek + '"></div>');
				if(robot==1){
					$('#modal_de .modal-body #info')
					.html(
							'Le '+geekNom[geek]+' a fait 6, il sort de la classe');
				}
				else{
					$('#modal_de .modal-body #info')
					.html(
							'Tu as fait 6, tu sors de la classe');
				}
			} else {
				if(robot==1){
					$('#modal_de .modal-body #info')
					.html(
							'Le '+geekNom[geek]+' n\'a pas fait 6');
				}
				else{
					$('#modal_de .modal-body #info')
					.html(
							'Tu dois faire 6 pour sortir de la classe, ça sera peut-être pour le prochain tour');
				}
			}
			break;
		case 'monter':
			position = $('#' + geek).parent('div').attr('id');
			
			if (position == 'B0' || position == 'J0' || position == 'V0'
					|| position == 'R0')
				position = 'N' + position;
			
			couleur = position.substring(0, 2);
			position = position.replace(couleur, '');
			
			if(position == maxNum){
				if (resultDe == 6) {
					fini(geek);
				} else {
					if(robot==1){
						$('#modal_de .modal-body #info')
						.html(
								'Le '+geekNom[geek]+' n\'a pas fait 6');
					}
					else{
						$('#modal_de .modal-body #info')
						.html(
								'Tu dois faire 6 pour gagner, dommage, ça sera peut-être pour le prochain tour');
					}
				}
			}
			else if(position == resultDe - 1){

				$('#' + geek).remove();
				$('#' + couleur + resultDe).append(
						'<div class="geek tourComplet" id="' + geek + '"></div>');
				if(robot==1){
					$('#modal_de .modal-body #info')
					.html(
							'Le '+geekNom[geek]+' avance sur la case suivante');
				}
				else{
					$('#modal_de .modal-body #info')
					.html(
							'Tu avances à la case suivante');
				}
			}
			else{
				if(robot==1){
					$('#modal_de .modal-body #info')
					.html(
							'Le '+geekNom[geek]+' n\'avance pas');
				}
				else{
					$('#modal_de .modal-body #info').html(
							'Dommage, ça sera peut-être pour le prochain tour');
				}
			}
			break;
		case 'avancer':
			position = $('#' + geek).parent('div').attr('id');
			couleur = position.substring(0, 1);
			position = position.replace(couleur, '');
			$('#' + geek).remove();

			newPosition = parseInt(position) + resultDe;

			if (newPosition <= maxCase) {
				$('#' + couleur + newPosition).append(
						'<div class="geek" id="' + geek + '"></div>');
			} else {
				
				newPosition = newPosition - (maxCase+1);

				var complet = "";
				
				switch(couleur){
					case 'B' :
						couleur = 'J';
						if (geek == 'geekJ') {
							newPosition = 0;
							complet = "tourComplet";
						}
						break;
					case 'J':
						couleur = 'V';
						if (geek == 'geekV') {
							newPosition = 0;
							complet = "tourComplet";
						}
						break;
					case 'V':
						couleur = 'R';
						if (geek == 'geekR') {
							newPosition = 0;
							complet = "tourComplet";
						}
						break;
					case 'R':
						couleur = 'B';
						if (geek == 'geekB') {
							newPosition = 0;
							complet = "tourComplet";
						}
						break;
					default:
						break;
				}

				$('#' + couleur + newPosition).append(
						'<div class="geek ' + complet + '" id="' + geek + '"></div>');
			}
			if(complet == "tourComplet"){
				if(robot==1){
					$('#modal_de .modal-body #info')
					.html(
							'Le '+geekNom[geek]+' a fait un tour complet');
				}
				else{
					$('#modal_de .modal-body #info')
					.html(
							'Tu as fait un tour complet');
				}
			}
			else{
				if(robot==1){
					$('#modal_de .modal-body #info')
					.html(
							'Le '+geekNom[geek]+' avance de '+resultDe+' cases');
				}
				else{
					$('#modal_de .modal-body #info')
					.html(
							'Tu avances de '+resultDe+' cases');
				}
			}
			break;
	}
	
	tour++;
	if(tour==4){
		$('#modal_de .modal-body #btn_suivant').hide();
		$('#modal_de .modal-body #btn_fermer').show();
		tour=0;
	}

}

function sauvegarder(option) {
	var positionB = $('#geekB').parent('div').attr('id');
	var positionJ = $('#geekJ').parent('div').attr('id');
	var positionV = $('#geekV').parent('div').attr('id');
	var positionR = $('#geekR').parent('div').attr('id');
	
	var classeB = $('#geekB').attr('class').replace('geek', '');
	var classeJ = $('#geekJ').attr('class').replace('geek', '');
	var classeV = $('#geekV').attr('class').replace('geek', '');
	var classeR = $('#geekR').attr('class').replace('geek', '');
	
	$.ajax({
		  type: "POST",
		  url: '../PHP/sauvegarde.php',
		  data: 'positionB='+positionB+'&positionJ='+positionJ+'&positionV='+positionV
		  +'&positionR='+positionR+'&classeB='+classeB+'&classeJ='+classeJ+'&classeV='+classeV
		  +'&classeR='+classeR+'&partie_id='+partieId, 
		  dataType: 'php',
	});
	
	if(option==0){
	  $('#modal_sauvegarde').modal('toggle');
	}
	if(option==1){
	  document.location.href='../PHP/compte.php';
	}
}

function fini(gagnant) {
	
	$.ajax({
		  type: "POST",
		  url: '../PHP/sauvegarde.php',
		  data: 'gagnant='+gagnant+'&partie_id='+partieId, 
		  dataType: 'php',
	});
	
	$('#modal_de').modal('toggle');
	$('body').removeClass('modal-de-open');
	
	switch(gagnant){
		case 'geekB' :
			$('#modal_fini .modal-body div').html('<img src="../Ressources/geekB.png">');
			break;
		case 'geekJ':
			$('#modal_fini .modal-body div').html('<img src="../Ressources/geekJ.png">');
			break;
		case 'geekV':
			$('#modal_fini .modal-body div').html('<img src="../Ressources/geekV.png">');
			break;
		case 'geekR':
			$('#modal_fini .modal-body div').html('<img src="../Ressources/geekR.png">');
			break;
		default:
			break;
	}
	
	
	if(gagnant==geekJouer){
	    $('#modal_fini .modal-body span').html('<b>Félicitation !!! Tu as gagné !</b><br/> Célia t\'autorise à quitter les cours 2h avant :D');
	}
	else{
		$('#modal_fini .modal-body span').html('<b>Le '+geekNom[geek]+' a gagné.</b><br/> Célia l\'autorise à quitter les cours 2h avant. Dommage pour toi, tu retournes en cours :(');
	}
	
	$('#modal_fini').modal({backdrop:'static'});
}
