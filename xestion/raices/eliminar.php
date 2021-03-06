<?php
/****************************************************************************
* xestion/raices/eliminar.php
*
* Elimina una ra�z y su relaci�n con los usuarios
*******************************************************************************/

$relativo = '../../';

include ($relativo.'paths.php');
include_once ($PFN_paths['include'].'basicweb.php');
include_once ($PFN_paths['include'].'Xusuarios.php');

PFN_quita_url_SERVER(array('id','borrar_inc'));

session_write_close();

$erros = array();
$id = intval($PFN_vars->get('id'));
$borrar_inc = intval($PFN_vars->get('borrar_inc'));

if (empty($id) || $sPFN['raiz']['id'] == $id) {
	$erros[] = 5;
} else {
	$PFN_usuarios->init('raiz', $id);
	$path_raiz = $PFN_usuarios->get('path');

	$query = 'DELETE FROM '.$PFN_usuarios->tabla('raices')
		.' WHERE id = "'.$id.'";';

	if ($PFN_usuarios->actualizar($query) == -1) {
		$erros[] = 6;
	} else {
		$query = 'DELETE FROM '.$PFN_usuarios->tabla('r_u')
			.' WHERE id_raiz = "'.$id.'";';
		$PFN_usuarios->actualizar($query);

		$query = 'DELETE FROM '.$PFN_usuarios->tabla('r_g_c')
			.' WHERE id_raiz = "'.$id.'";';
		$PFN_usuarios->actualizar($query);

		include_once ($PFN_paths['include'].'class_indexador.php');

		$PFN_indexador = new PFN_Indexador($PFN_conf);
		$PFN_indexador->eliminar_raiz($id);

		$info_raiz = $PFN_paths['info'].'raiz'.$id;

		if (is_dir($info_raiz)) {
			include_once ($PFN_paths['include'].'class_accions.php');

			$PFN_conf->p(false, 'logs', 'accions');

			$PFN_accions = new PFN_Accions($PFN_conf);

			$PFN_accions->rexistro(false);
			$PFN_accions->eliminar($info_raiz);
		}

		$PFN_usuarios->init('raices');
		$parecida = false;

		for (; $PFN_usuarios->mais(); $PFN_usuarios->seguinte()) {
			if ($PFN_usuarios->get('id') == $id) {
				continue;
			}

			$este_path = $PFN_usuarios->get('path');

			if (strstr($este_path, $path_raiz) || strstr($path_raiz, $este_path)) {
				$parecida = true;
				break;
			}
		}

		if (!$parecida) {
			include_once ($PFN_paths['include'].'class_extra.php');
			$PFN_extra->vacia_path($path_raiz, true, true, true);
		}
	}
}

$ok = count($erros)?false:2;

Header('Location: index.php?'.PFN_cambia_url(array('id', 'erros', 'ok'), array(false, implode(',', $erros), $ok), false, true));
exit;
?>
