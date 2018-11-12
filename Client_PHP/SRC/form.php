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
<!-- Start Formoid form-->
<link rel="stylesheet" href="<?php echo dirname($form_path); ?>/formoid-biz-green.css" type="text/css" />
<script type="text/javascript" src="<?php echo dirname($form_path); ?>/jquery.min.js"></script>
<form class="formoid-biz-green" action="resultat.php" style="background-color:#1A2223;font-size:17px;font-family:'Trebuchet MS',Helvetica,sans-serif;color:#ECECEC;max-width:330px;min-width:150px" method="post"><div class="title"><h2>Service Web Calculatrice</h2></div>
	<div class="element-separator"><hr><h3 class="section-break-title"></h3></div>
	<div class="element-number<?php frmd_add_class("number"); ?>"><label class="title"><span class="required">*</span></label><input class="large" type="text" min="0" max="10000000" name="ope1" required="required" placeholder="Operande 1" value=""/></div>
	<div class="element-select<?php frmd_add_class("select"); ?>" title="Selectionnez une opération"><label class="title"><span class="required">*</span></label><div class="large"><span><select name="operation" required="required">
		<option value="+ (plus)">+ (plus)</option>
		<option value="- (moins)">- (moins)</option>
		<option value="/ (divisé par)">/ (divisé par)</option>
		<option value="* (multiplié par)">* (multiplié par)</option>
		<option value="% (modulo)">% (modulo)</option>
		<option value="exp() (puissance)">exp() (puissance)</option></select><i></i></span></div></div>
	<div class="element-number<?php frmd_add_class("number1"); ?>"><label class="title"><span class="required">*</span></label><input class="large" type="text" min="0" max="10000000" name="ope2" required="required" placeholder="Operande 2" value=""/></div>
	<div class="element-separator"><hr><h3 class="section-break-title"></h3></div>
<div class="submit"><input type="submit" value="Calculer"/></div></form><script type="text/javascript" src="<?php echo dirname($form_path); ?>/formoid-biz-green.js"></script>

<!-- Stop Formoid form-->
<?php endif; ?>

<?php frmd_end_form(); ?>