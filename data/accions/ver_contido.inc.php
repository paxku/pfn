<?php
/****************************************************************************
* data/accions/ver_contido.inc.php
*
* Visualiza el contenido de un fichero de texto
*

PHPfileNavigator versi�n 2.2.0

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

defined('OK') && defined('ACCION') or die();

$PFN_tempo->rexistra('precodigo');

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

if ($PFN_niveles->filtrar($cal) && is_file($arquivo)) {
	$PFN_accions->arquivos($PFN_arquivos);

	$tamano = PFN_espacio_disco($arquivo, true);
	$estado = $PFN_accions->log_ancho_banda($tamano);

	if ($estado === true) {
		$ext = explode('.', $arquivo);
		$ext = strtolower(end($ext));
		$e_php = (($ext == 'php') || ($ext == 'php3') || ($ext == 'phtml'));

		include ($PFN_paths['plantillas'].'posicion.inc.php');
		include ($PFN_paths['plantillas'].'info_cab.inc.php');
		include ($PFN_paths['plantillas'].'ver_contido.inc.php');
	} elseif ($estado === -1) {
		$estado_accion = PFN___('estado_descargar_3');
		include ($PFN_paths['web'].'navega.inc.php');
	} else {
		$estado_accion = PFN___('estado_descargar_2');
		include ($PFN_paths['web'].'navega.inc.php');
	}
} else {
	include ($PFN_paths['web'].'navega.inc.php');
}

$PFN_tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
