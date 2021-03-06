<?php
/****************************************************************************
* data/plantillas/subir_arq.inc.php
*
* plantilla para la visualizaci�n de la acc�on de subir un fichero
*******************************************************************************/

defined('OK') && defined('ACCION') or die();
?>
<div id="ver_info">
	<div class="bloque_info"><h1><?php echo PFN___('accion').' &raquo; '.PFN___('subir_arq'); ?></h1></div>
	<div class="bloque_info">
		<form id="form_accion" action="accion.php?<?php echo PFN_get_url(false); ?>" method="post" enctype="multipart/form-data" onsubmit="return submitonce();">
		<fieldset>

		<div id="subida_espera" style="overflow: hidden; display: none;">
			<div class="aviso"><?php echo PFN___('estado_subir_arq_8'); ?></div><br /><br />
			<input type="hidden" id="cancelar" name="cancelar" value="" />
			<input type="button" id="btn_cancelar" value=" <?php echo PFN___('cancelar'); ?> " class="boton" onclick="anula_envio();" />
		</div>

		<div id="capa_formulario" style="overflow: visible; display: block;">
			<div style="text-align: center;">
				<?php echo PFN___('numero_arquivos'); ?>:&nbsp;&nbsp;&nbsp;
				<select id="cantos" name="cantos" onchange="cambia_cantos(this.value);">
				<?php
				for ($i=1; $i <= $PFN_conf->g('inc','limite'); $i++) {
					echo '<option value="'.$i.'" '.(($i==$cantos)?'selected="selected"':'').'> '.$i.' </option>';
				}
				?>
				</select>
			</div><br />

			<input type="hidden" name="accion" value="subir_arq" />
			<input type="hidden" name="executa" value="true" />
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $PFN_conf->g('inc','peso'); ?>" />

			<?php for ($i = 1; $i <= $PFN_conf->g('inc','limite'); $i++) {?>
			<div id="cantos<?php echo $i; ?>">
				<?php if ($PFN_conf->g('avisos','subida') === 'always') { ?>
				<input type="hidden" name="aviso_subida[<?php echo $i; ?>]" value="1" />
				<?php } ?>

				<table class="tabla_info" summary="">
					<tr>
						<th><label for="nome_arquivo_<?php echo $i; ?>"><?php echo PFN___('arq'); ?>:</label></th>
						<td><input type="file" id="nome_arquivo_<?php echo $i; ?>" name="nome_arquivo[<?php echo $i; ?>]" class="file" /></td>
					</tr>
					<?php
					$PFN_inc->multiple($i);

					foreach ($PFN_inc->crea_formulario('arq') as $v) {
					?>
					<tr>
						<th><?php echo $v['campo']; ?></th>
						<td><?php echo $v['valor']; ?></td>
					</tr>
					<?php } ?>
					<?php if ($PFN_conf->g('imaxes','pequena')) { ?>
					<tr>
						<th><label for="imaxe_<?php echo $i; ?>"><?php echo PFN___('imaxe_reducida'); ?></label></th>
						<td>
							<select id="imaxe_<?php echo $i; ?>" name="imaxe[<?php echo $i; ?>]">
								<option value="" <?php echo ($PFN_conf->g('imaxes','defecto')=='false' || !$PFN_conf->g('imaxes','defecto'))?'selected="selected"':''; ?>><?php echo PFN___('non_crear'); ?></option>
								<option value="reducir" <?php echo $PFN_conf->g('imaxes','defecto')=='reducir'?'selected="selected"':''; ?>><?php echo PFN___('reducir'); ?></option>
								<option value="recortar" <?php echo $PFN_conf->g('imaxes','defecto')=='recortar'?'selected="selected"':''; ?>><?php echo PFN___('recortar'); ?></option>
							</select>
						</td>
					</tr>
					<?php } ?>
					<tr>
						<th><label for="sobreescribir_<?php echo $i; ?>"><?php echo PFN___('sobreescribir'); ?></label></th>
						<td><input type="checkbox" id="sobreescribir_<?php echo $i; ?>" name="sobreescribir[<?php echo $i; ?>]" value="1" class="checkbox" /></td>
					</tr>
					<?php if ($PFN_conf->g('avisos','subida')) { ?>
					<tr>
						<th><label for="aviso_subida_<?php echo $i; ?>"><?php echo PFN___('avisar_subida'); ?></label></th>
						<?php if ($PFN_conf->g('avisos','subida') === 'always') { ?>
						<td><input type="checkbox" id="aviso_subida_<?php echo $i; ?>" class="checkbox" checked="checked" disabled="disabled" /></td>
						<?php } else { ?>
						<td><input type="checkbox" id="aviso_subida_<?php echo $i; ?>" name="aviso_subida[<?php echo $i; ?>]" value="1" class="checkbox" /></td>
						<?php } ?>
					</tr>
					<?php } ?>
				</table><br />
			</div>
			<?php } ?>
			<div class="centro">
				<input type="reset" value=" <?php echo PFN___('cancelar'); ?> " class="boton" onclick="location.href='navega.php?<?php echo PFN_get_url(false); ?>'" />
				<input type="submit" name="btn_aceptar" value=" <?php echo PFN___('aceptar'); ?> " class="boton" onclick="amosa_espera();" style="margin-left: 40px;" />
			</div>
		</div>

		</fieldset>
		</form>
	</div>
</div>
<script type="text/javascript"><!--

cambia_cantos(1);

function cambia_cantos (val) {
	for (ic = 1; ic <= <?php echo $PFN_conf->g('inc','limite'); ?>; ic++) {
		if (ic <= val) {
			amosa('cantos'+ic);
		} else {
			oculta('cantos'+ic);
		}
	}
}

function anula_envio (boton) {
	var obx_form = document.getElementById('form_accion');
	var obx_cancelar = document.getElementById('cancelar');
	var obx_btn_cancelar = document.getElementById('btn_cancelar');

	obx_cancelar.value = 'cancelar';
	obx_btn_cancelar.value = '<?php echo addslashes(PFN_quitaHtmlentities(PFN___('anulando'))); ?>';
	obx_btn_cancelar.disabled = true;

	obx_form.submit();
}

function amosa_espera () {
  document.getElementById('capa_formulario').style.overflow = 'hidden';
  document.getElementById('capa_formulario').style.display = 'none';
  document.getElementById('subida_espera').style.overflow = 'visible'; 
  document.getElementById('subida_espera').style.display = 'block';
}

//--></script>
