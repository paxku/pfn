<?php
/****************************************************************************
* data/accions/descargar.inc.php
*
* Realiza la acci�n de descarga de un fichero
*******************************************************************************/

defined('OK') && defined('ACCION') or die();

PFN_quita_url_SERVER('zlib');

include_once ($PFN_paths['include'].'class_arquivos.php');
include_once ($PFN_paths['include'].'class_inc.php');

$PFN_arquivos = new PFN_Arquivos($PFN_conf);
$PFN_inc = new PFN_INC($PFN_conf);

$PFN_inc->arquivos($PFN_arquivos);
$PFN_inc->carga_datos($arquivo);
$PFN_accions->arquivos($PFN_arquivos);

if ($PFN_vars->get('zlib')
&& ($PFN_conf->g('zlib') == true)
&& $PFN_conf->g('permisos', 'comprimir')) {
	@set_time_limit($PFN_conf->g('tempo_maximo'));
	@ini_set('memory_limit', $PFN_conf->g('memoria_maxima'));

	include_once ($PFN_paths['include'].'class_easyzip.php');

	$EasyZIP->comeza($arquivo);
	$contido = &$EasyZIP->zipFile();
	$tamano = strlen($contido);

	$estado = $PFN_accions->log_ancho_banda($tamano);

	if ($estado === true) {
		$PFN_inc->mais_datos('descargado', ($PFN_inc->valor('descargado') + 1));
		$PFN_inc->crea_inc($arquivo.(($tipo == 'dir')?'/':''), $tipo);

		header('Pragma: private');
		header('Expires: 0');
		header('Cache-control: private, must-revalidate');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Content-Type: application/force-download; charset='.$PFN_conf->g('charset'));
		header('Content-Transfer-Encoding: binary');
		header('Content-Disposition: attachment; filename="'.str_replace(array(' ','"'),'_',$cal.'.zip').'"');
		header('Content-Length: '.$tamano);

		echo $contido;

		$PFN_accions->log_accion('descargar', $arquivo, str_replace(array(' ','"'),'_',$cal.'.zip'));
		exit;
	} elseif ($estado === -1) {
		$erro = true;
		$estado_accion = PFN___('estado_descargar_3', $PFN_paths['info']);
	} else {
		$erro = true;
		$estado_accion = PFN___('estado_descargar_2');
	}

	unset($contido);
} elseif (is_file($arquivo)) {
	@set_time_limit($PFN_conf->g('tempo_maximo'));
	@ini_set('memory_limit', $PFN_conf->g('memoria_maxima'));

	$tamano = PFN_espacio_disco($arquivo, true);

	$estado = $PFN_accions->log_ancho_banda($tamano);

	if ($estado === true) {
		$PFN_inc->mais_datos('descargado', ($PFN_inc->valor('descargado') + 1));
		$PFN_inc->crea_inc($arquivo, 'arq');

		$modo = ($PFN_vars->get('modo') == '')?$PFN_conf->g('descarga_defecto'):$PFN_vars->get('modo');

		if ($modo == 'enlace') {
			header('Location: '.$enlace_abs);

			$PFN_accions->log_accion('descargar', $arquivo, $enlace_abs);

			exit;
		}

		$mime = ($PFN_imaxes->mime($cal) == '')?$PFN_imaxes->mime(''):$PFN_imaxes->mime($cal);

		header('Pragma: private');
		header('Expires: 0');
		header('Cache-control: private, must-revalidate');
		header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header('Content-Type: '.$mime.'; charset='.$PFN_conf->g('charset'));

		if ($modo == 'descargar') {
			header('Content-Type: application/force-download');
			header('Content-Transfer-Encoding: binary');
			header('Content-Disposition: attachment; filename="'.str_replace(array(' ','"'),'_',$ucal).'"');
		} else {
			header('Content-Disposition: inline; filename="'.str_replace(array(' ','"'),'_',$ucal).'"');
		}

		header('Content-Length: '.$tamano);

		$PFN_arquivos->get_contido($arquivo, true);

		$PFN_accions->log_accion('descargar', $arquivo);
		exit;
	} elseif ($estado === -1) {
		$erro = true;
		$estado_accion = PFN___('estado_descargar_3');
	} else {
		$erro = true;
		$estado_accion = PFN___('estado_descargar_2');
	}
} else {
	$erro = true;
}

if ($erro) {
	$PFN_tempo->rexistra('preplantillas');

	include ($PFN_paths['plantillas'].'cab.inc.php');
	include ($PFN_paths['web'].'opcions.inc.php');

	$PFN_tempo->rexistra('precodigo');

	include ($PFN_paths['web'].'navega.inc.php');

	$PFN_tempo->rexistra('postcodigo');

	include ($PFN_paths['plantillas'].'pe.inc.php');
}
?>
