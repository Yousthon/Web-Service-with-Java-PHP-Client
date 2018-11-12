<?php

define('EMAIL_FOR_REPORTS', '');
define('RECAPTCHA_PRIVATE_KEY', '@privatekey@');
define('FINISH_URI', 'http://');
define('FINISH_ACTION', 'redirect');
define('FINISH_MESSAGE', 'Thanks for filling out my form!');
define('UPLOAD_ALLOWED_FILE_TYPES', 'doc, docx, xls, csv, txt, rtf, html, zip, jpg, jpeg, png, gif');

define('_DIR_', str_replace('\\', '/', dirname(__FILE__)) . '/');
require_once _DIR_ . '/handler.php';

?>

<?php if (frmd_message()): ?>
<link rel="stylesheet" href="<?php echo dirname($form_path); ?>/formoid-biz-green.css" type="text/css" />
<span class="alert alert-success"><?php echo FINISH_MESSAGE; ?></span>
<?php else: ?>


<!-- Traitement et appel du web service -->
<?php

	// Recuperation des paramètres

	 $params['p1']=$_POST['ope1'];
	 $params['p2']=$_POST['ope2'];
	 $op=$_POST['operation'] ;
	 $test=0; // Pour detecter la division par 0

	 // Creation d'un objet SOAPCLIENT.
	 $wsdl = "http://localhost:8080/axis2/services/Calculator?wsdl";
	 $client = new SoapClient($wsdl);

	 // Traitement selon opération choisie
	 switch ($_POST['operation']) {
		case "+ (plus)":
			$result = $client->add($params);
			$result1= $result->return;
			break;

		case "- (moins)":
			$result = $client->subtract($params);
			$result1= $result->return;
			break;
			
		case "* (multiplié par)":
			$result = $client->multip($params);
			$result1= $result->return;
			break;

		case "/ (divisé par)": // Division entière. Gestion de la division par 0
			if ($params['p2'] != 0){
				$result = $client->division($params);
				$result1= $result->return;
			}else
				$test=1;
			break;

		case "% (modulo)": // Gestion de la division par 0
			if ($params['p2'] != 0){
				$result = $client->modulo($params);
				$result1= $result->return;
			}else
				$test=1;
			break;
		
		case "exp() (puissance)":
			$result = $client->puissance($params);
			$result1= $result->return;
			break;
	}

?>

<!-- Debut Formulaire-->
<link rel="stylesheet" href="<?php echo dirname($form_path); ?>/formoid-biz-green.css" type="text/css" />
<script type="text/javascript" src="<?php echo dirname($form_path); ?>/jquery.min.js"></script>
<form class="formoid-biz-green" action="index.php" style="background-color:#1A2223;font-size:17px;font-family:'Trebuchet MS',Helvetica,sans-serif;color:#ECECEC;max-width:330px;min-width:150px" method="post"><div class="title"><h2>Service Web Calculatrice</h2></div>
	<div class="element-separator"><hr><h3 class="section-break-title"></h3></div>
	<div class="element-number<?php frmd_add_class("number1"); ?>"><label class="title"></label><input class="large" type="text" readonly="readonly" name="ope1"  placeholder="Operande 1" value="<?php echo($params['p1'])?>"/></div>
	<div class="element-text<?php frmd_add_class("text"); ?>"><label class="title"></label><input class="large" type="text" readonly="readonly" name="op"  placeholder="Operation choisie" value="<?php echo($op)?>"/></div>
	<div class="element-number<?php frmd_add_class("number2"); ?>"><label class="title"></label><input class="large" type="text" readonly="readonly" name="ope2" value="<?php echo($params['p2'])?>" placeholder="Operande 2"/></div>
	<div class="element-text<?php frmd_add_class("text"); ?>"><label class="title"></label><input class="large" type="text" name="res" readonly="readonly" placeholder="Résultat" value="<?php if ($test) echo ("Erreur : Division par 0 !"); else echo("= ".$result1);?>"/></div>
	<div class="element-separator"><hr><h3 class="section-break-title"></h3></div>
<div class="submit"><input type="submit" value="Nouveau Calcul"/></div></form><script type="text/javascript" src="<?php echo dirname($form_path); ?>/formoid-biz-green.js"></script>

<!-- Fin Formulaire-->
<?php endif; ?>

<?php frmd_end_form(); ?>