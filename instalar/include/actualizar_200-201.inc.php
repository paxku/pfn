<?php
/*******************************************************************************
* instalar/include/actualizar_200-201.inc.php
*
* Ejectula la acci�n de actualizaci�n desde la versi�n entre 2.0.0 y 2.0.1
*******************************************************************************/

defined('OK') or die();

if (count($erros) == 0) {
	$arq_mysql = $PFN_paths['instalar'].'mysql/actualizar_200-201.sql';
	$consultas = @fread(@fopen($arq_mysql, 'r'), @filesize($arq_mysql));
	$consultas = str_replace('EXISTS ', 'EXISTS '.$basicas['db']['prefixo'], $consultas);
	$consultas = str_replace('ALTER IGNORE TABLE ', 'ALTER IGNORE TABLE '.$basicas['db']['prefixo'], $consultas);
	$consultas = explode(';', $consultas);

	foreach ((array)$consultas as $q) {
		$q = preg_replace("/''([0-9-]*)''/", "'\\1'", trim($q)); 

		if (empty($q)) {
			continue;
		}

		if (!@mysql_query($q, $con)) {
			$erros['mysql_200-201'] = 17;
			$erros_q['mysql_200-201'][] = array(
				'consulta' => $q,
				'erro' => mysql_error($con)
			);
		}
	}

	$paso_feito[] = '200-201';
	$feito[] = 'mysql_200-201';
}
?>
