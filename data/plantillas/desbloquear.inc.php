<?php
/****************************************************************************
* data/plantillas/contrasinal.inc.php
*
* plantilla para la visualizaci�n de la pantalla de recuperaci�n de
* contrase�a
*

PHPfileNavigator versi�n 2.3.0

Copyright (C) 2004-2005 Lito <lito@eordes.com>

http://phpfilenavigator.litoweb.net/

Este programa es software libre. Puede redistribuirlo y/o modificarlo bajo los
t�rminos de la Licencia P�blica General de GNU seg�n es publicada por la Free
Software Foundation, bien de la versi�n 2 de dicha Licencia o bien (seg�n su
elecci�n) de cualquier versi�n posterior. 

Este programa se distribuye con la esperanza de que sea �til, pero SIN NINGUNA
GARANT�A, incluso sin la garant�a MERCANTIL impl�cita o sin garantizar la
CONVENIENCIA PARA UN PROP�SITO PARTICULAR. V�ase la Licencia P�blica General de
GNU para m�s detalles. 

Deber�a haber recibido una copia de la Licencia P�blica General junto con este
programa. Si no ha sido as�, escriba a la Free Software Foundation, Inc., en
675 Mass Ave, Cambridge, MA 02139, EEUU. 
*******************************************************************************/

defined('OK') or die();
?>

<h1 id="benvido"><span><?php echo PFN___('desbloquear_usuario'); ?><span></h1>

<div class="aviso" style="width: 230px; text-align: center; margin-left: 250px;"><?php echo $txt_erro; ?></div>

<?php if ($ok !== 1) { ?>
<div id="login">
	<form action="desbloquear.php" method="post" id="formulario">
		<fieldset>
			<input type="hidden" name="executa" value="true" />

			<p>
				<label for="desbloquear_usuario"><?php echo PFN___('usuario'); ?>:</label>
				<br /><input type="text" id="desbloquear_usuario" name="desbloquear_usuario" class="formulario" />
			</p>

			<p>
				<label for="desbloquear_email"><?php echo PFN___('correo'); ?>:</label>
				<br /><input type="text" id="desbloquear_email" name="desbloquear_email" class="formulario" />
			</p>

			<p><input type="submit" name="Submit" value=" <?php echo PFN___('enviar'); ?> " class="boton" /></p>
		</fieldset>
	</form>

	<script type="text/javascript"><!--

	document.getElementById('desbloquear_usuario').focus();

	//--></script>
</div>
<?php } ?>

<div id="login_mais_opcions">
	<a href="index.php"><?php echo PFN___('voltar'); ?></a>
</div>
