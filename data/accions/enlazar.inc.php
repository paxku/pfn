<?php
/****************************************************************************
* data/accions/enlazar.inc.php
*
* Realiza la visualizaci�n o acci�n de enlazar un fichero o directorio
*******************************************************************************/

defined('OK') && defined('ACCION') or die();

$erro = false;

include ($PFN_paths['plantillas'].'cab.inc.php');
include ($PFN_paths['web'].'opcions.inc.php');

$PFN_tempo->rexistra('precodigo');

if ($PFN_vars->post('executa')) {
	if (!empty($cal) && !empty($dir)) {
		$orixinal = $arquivo;
		$destino = $PFN_conf->g('raiz','path').$PFN_accions->path_correcto($PFN_vars->post('escollido').'/')
			.'/'.$cal;

		if (strstr($destino, $orixinal)) {
			$estado_accion = PFN___('estado_copiar_dir_7');
			$erro = true;
		}

		if (!$erro && $tipo == 'dir') {
			$PFN_accions->enlazar($orixinal, $destino);
			$estado = $PFN_accions->estado_num('enlazar_dir');
			$estado_accion = PFN___('estado_enlazar_dir_'.intval($estado));
			
			if ($PFN_accions->estado('enlazar_dir')) {
				if ($PFN_conf->g('inc','indexar')) {
					include_once ($PFN_paths['include'].'class_indexador.php');
					$PFN_indexador = new PFN_Indexador($PFN_conf);

					$i_destino = $PFN_accions->path_correcto($PFN_vars->post('escollido').'/');
					$PFN_indexador->copiar("$dir/", "$i_destino/", "$cal/");
				}
			}
		} elseif (!$erro) {
			$PFN_accions->enlazar($orixinal,$destino);
			$estado = $PFN_accions->estado_num('enlazar_arq');
			$estado_accion = PFN___('estado_enlazar_arq_'.intval($estado));

			if ($PFN_accions->estado('enlazar_arq')) {
				if ($PFN_conf->g('inc','estado')) {
					include_once ($PFN_paths['include'].'class_inc.php');

					$PFN_inc = new PFN_INC($PFN_conf);
					$PFN_inc->copiar($orixinal, $destino);
				}

				if ($PFN_conf->g('inc','indexar')) {
					include_once ($PFN_paths['include'].'class_indexador.php');

					$i_destino = $PFN_accions->path_correcto($PFN_vars->post('escollido').'/');

					$PFN_indexador = new PFN_Indexador($PFN_conf);
					$PFN_indexador->copiar("$dir/", "$i_destino/", $cal);
				}

				if ($PFN_conf->g('imaxes','pequena')) {
					$PFN_imaxes->copiar($orixinal,$destino);
				}
			}
		}
	}

	include ($PFN_paths['web'].'navega.inc.php');
} else {
	if (file_exists($arquivo)) {
		include_once ($PFN_paths['include'].'class_arbore.php');
		$PFN_arbore = new PFN_Arbore($PFN_conf);

		$PFN_arbore->imaxes($PFN_imaxes);
		$PFN_arbore->pon_radio('escollido');
		$PFN_arbore->pon_enlaces(false);

		if ($PFN_accions->e_dir($arquivo)) {
			$contido = $PFN_accions->get_contido($arquivo);
			$PFN_arbore->pon_copia($arquivo);
	
			if (count($contido['dir']['nome']) || count($contido['arq']['nome'])) {
				$adv = PFN___('estado_enlazar_dir_2');
			} else {
				$adv = PFN___('estado_enlazar_dir_3');
			}
		} else {
			$adv = PFN___('estado_enlazar_arq_2');
		}

		$PFN_arbore->carga_arbore($PFN_conf->g('raiz','path'), './', false);

		include ($PFN_paths['plantillas'].'posicion.inc.php');
		include ($PFN_paths['plantillas'].'info_cab.inc.php');
		include ($PFN_paths['plantillas'].'enlazar.inc.php');
	} else {
		include ($PFN_paths['web'].'navega.inc.php');
	}
}

$PFN_tempo->rexistra('postcodigo');

include ($PFN_paths['plantillas'].'pe.inc.php');
?>
