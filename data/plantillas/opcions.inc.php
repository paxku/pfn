<?php
/****************************************************************************
* data/plantillas/opcions.inc.php
*
* plantilla para la visualizaci�n del men� superior de opciones
*******************************************************************************/

defined('OK') or die();
?>
<div id="menu_principal">
	<div id="escolle_ancho"><a href="#" onclick="return marca_ancho_corpo(true);" title="<?php echo PFN___('maximizar_corpo'); ?>"><img src="<?php echo $relativo.$PFN_conf->g('estilo'); ?>imx/ancho_corpo.png" alt="<?php echo PFN___('maximizar_corpo'); ?>" /></a></div>
	<h1 id="logo"><a href="navega.php?<?php echo PFN_quita_url('dir',false); ?>"><span>&nbsp;</span><?php echo PFN___('PFN'); ?></a></h1>
	<ul id="menu1">
<?php if (!$PFN_conf->g('raiz','unica')) { ?>
		<li><a href="<?php echo $menu_opc['escoller_raiz']; ?>"><?php echo PFN___('escoller_raiz'); ?></a></li>
<?php } if (!empty($menu_opc['zona_admin'])) { ?>
		<li class="admin"><a href="<?php echo $menu_opc['zona_admin']; ?>"><?php echo PFN___('zona_admin'); ?></a></li>
<?php } if (!empty($menu_opc['buscador'])) { ?>
		<li><a href="<?php echo $menu_opc['buscador']; ?>"><?php echo PFN___('buscador'); ?></a></li>
<?php } if (!empty($menu_opc['axuda'])) { ?>
		<li><a href="<?php echo $menu_opc['axuda']; ?>"><?php echo PFN___('axuda'); ?></a></li>
<?php } if (!empty($menu_opc['sair'])) { ?>
		<li><a href="<?php echo $menu_opc['sair']; ?>"><?php echo PFN___('sair'); ?></a></li>
<?php } ?>
	</ul>

	<br class="nada" />


	<ul id="menu2">
		<?php if (!empty($menu_opc['actualizar'])) { ?>
		<li><a href="<?php echo $menu_opc['actualizar']; ?>" onmouseover="amosa('menu_txt_actualizar');" onmouseout="oculta('menu_txt_actualizar');"><img src="<?php echo $PFN_conf->g('estilo'); ?>imx/actualizar.png" alt="<?php echo PFN___('actualizar'); ?>" /></a></li>
		<?php } if (!empty($menu_opc['crear_dir'])) { ?>
		<li><a href="<?php echo $menu_opc['crear_dir']; ?>" onmouseover="amosa('menu_txt_crear_dir');" onmouseout="oculta('menu_txt_crear_dir');"><img src="<?php echo $PFN_conf->g('estilo'); ?>imx/crear_dir.png" alt="<?php echo PFN___('crear_dir'); ?>" /></a></li>
		<?php } if (!empty($menu_opc['novo_arq'])) { ?>
		<li><a href="<?php echo $menu_opc['novo_arq']; ?>" onmouseover="amosa('menu_txt_novo_arq');" onmouseout="oculta('menu_txt_novo_arq');"><img src="<?php echo $PFN_conf->g('estilo'); ?>imx/novo_arq.png" alt="<?php echo PFN___('novo_arq'); ?>" /></a></li>
		<?php } if (!empty($menu_opc['subir_arq'])) { ?>
		<li><a href="<?php echo $menu_opc['subir_arq']; ?>" onmouseover="amosa('menu_txt_subir_arq');" onmouseout="oculta('menu_txt_subir_arq');"><img src="<?php echo $PFN_conf->g('estilo'); ?>imx/subir_arq.png" alt="<?php echo PFN___('subir_arq'); ?>" /></a></li>
		<?php } if (!empty($menu_opc['subir_url'])) { ?>
		<li><a href="<?php echo $menu_opc['subir_url']; ?>" onmouseover="amosa('menu_txt_subir_url');" onmouseout="oculta('menu_txt_subir_url');"><img src="<?php echo $PFN_conf->g('estilo'); ?>imx/subir_url.png" alt="<?php echo PFN___('subir_url'); ?>" /></a></li>
		<?php } if (!empty($menu_opc['ver_imaxes'])) { ?>
		<li><a href="<?php echo $menu_opc['ver_imaxes']; ?>" onmouseover="amosa('menu_txt_ver_imaxes');" onmouseout="oculta('menu_txt_ver_imaxes');"><img src="<?php echo $PFN_conf->g('estilo'); ?>imx/ver_imaxes.png" alt="<?php echo PFN___('ver_imaxes'); ?>" /></a></li>
		<?php } if (!empty($menu_opc['arbore'])) { ?>
		<li><a href="<?php echo $menu_opc['arbore']; ?>" onmouseover="amosa('menu_txt_arbore');" onmouseout="oculta('menu_txt_arbore');"><img src="<?php echo $PFN_conf->g('estilo'); ?>imx/arbore.png" alt="<?php echo PFN___('arbore'); ?>" /></a></li>
		<?php } if (!empty($menu_opc['preferencias'])) { ?>
		<li><a href="<?php echo $menu_opc['preferencias']; ?>" onmouseover="amosa('menu_txt_preferencias');" onmouseout="oculta('menu_txt_preferencias');"><img src="<?php echo $PFN_conf->g('estilo'); ?>imx/preferencias_usuario.png" alt="<?php echo PFN___('preferencias_usuario'); ?>" /></a></li>
		<?php } ?>
		<li id="menu_texto">
			<?php if (!empty($menu_opc['actualizar'])) { ?>
			<span id="menu_txt_actualizar" style="display: none;"><?php echo PFN___('actualizar'); ?></span>
			<?php } if (!empty($menu_opc['crear_dir'])) { ?>
			<span id="menu_txt_crear_dir" style="display: none;"><?php echo PFN___('crear_dir'); ?></span>
			<?php } if (!empty($menu_opc['novo_arq'])) { ?>
			<span id="menu_txt_novo_arq" style="display: none;"><?php echo PFN___('novo_arq'); ?></span>
			<?php } if (!empty($menu_opc['subir_arq'])) { ?>
			<span id="menu_txt_subir_arq" style="display: none;"><?php echo PFN___('subir_arq'); ?></span>
			<?php } if (!empty($menu_opc['subir_url'])) { ?>
			<span id="menu_txt_subir_url" style="display: none;"><?php echo PFN___('subir_url'); ?></span>
			<?php } if (!empty($menu_opc['ver_imaxes'])) { ?>
			<span id="menu_txt_ver_imaxes" style="display: none;"><?php echo PFN___('ver_imaxes'); ?></span>
			<?php } if (!empty($menu_opc['arbore'])) { ?>
			<span id="menu_txt_arbore" style="display: none;"><?php echo PFN___('arbore'); ?></span>
			<?php } if (!empty($menu_opc['preferencias'])) { ?>
			<span id="menu_txt_preferencias" style="display: none;"><?php echo PFN___('preferencias_usuario'); ?></span>
			<?php } ?>
		</li>
	</ul>
</div>
