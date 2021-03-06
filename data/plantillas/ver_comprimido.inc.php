<?php
/****************************************************************************
* data/plantillas/ver_comprimido.inc.php
*
* plantilla para la visualización del contenido de un fichero
*******************************************************************************/

defined('OK') && defined('ACCION') or die();
?>
		<div class="bloque_info"><h1><?php echo PFN___('accion').' &raquo; '.PFN___('ver_comprimido'); ?></h1></div>
		<div class="bloque_info">
			<table summary="" class="tabla_informes">
				<thead>
				<tr>
					<th><a href="accion.php?<?php echo PFN_cambia_url(array('accion','orde_comprimido','pos_comprimido','cal'),array($accion,'nome',(($orde == 'nome')?$pos:'ASC'),$cal),false); ?>"><?php echo PFN___('nome'); ?></a></th>
					<th><a href="accion.php?<?php echo PFN_cambia_url(array('accion','orde_comprimido','pos_comprimido','cal'),array($accion,'tamano',(($orde == 'tamano')?$pos:'ASC'),$cal),false); ?>"><?php echo PFN___('tamano'); ?></a></th>
					<th><a href="accion.php?<?php echo PFN_cambia_url(array('accion','orde_comprimido','pos_comprimido','cal'),array($accion,'data',(($orde == 'data')?$pos:'ASC'),$cal),false); ?>"><?php echo PFN___('data'); ?></a></th>
					<th><a href="accion.php?<?php echo PFN_cambia_url(array('accion','orde_comprimido','pos_comprimido','cal'),array($accion,'propietario',(($orde == 'propietario')?$pos:'ASC'),$cal),false); ?>"><?php echo PFN___('propietario'); ?></a></th>
					<th><a href="accion.php?<?php echo PFN_cambia_url(array('accion','orde_comprimido','pos_comprimido','cal'),array($accion,'grupo',(($orde == 'grupo')?$pos:'ASC'),$cal),false); ?>"><?php echo PFN___('grupo'); ?></a></th>
					<th><a href="accion.php?<?php echo PFN_cambia_url(array('accion','orde_comprimido','pos_comprimido','cal'),array($accion,'permisos',(($orde == 'permisos')?$pos:'ASC'),$cal),false); ?>"><?php echo PFN___('permisos'); ?></a></th>
				</tr>
				</thead>
				<tfoot>
				<tr>
					<td>
						<?php
						echo (($cnt_cantos['dir'] > 0)?
							($cnt_cantos['dir'].' '.PFN___(($cnt_cantos['dir'] == 1)?'dir':'dirs')):'')
							.(($cnt_cantos['arq'] > 0)?
							((($cnt_cantos['dir'] > 0)?
							' - ':'').$cnt_cantos['arq'].' '.PFN___(($cnt_cantos['arq'] == 1)?
							'arq':'arqs')):'');
						?>
					</td>
					<td><?php echo PFN_peso($cnt_peso); ?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				</tfoot>
				<tbody>
				<?php echo $txt; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
