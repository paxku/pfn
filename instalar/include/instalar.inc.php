<?php
/*******************************************************************************
* instalar/include/instalar.inc.php
*
* Ejectula la acci�n de nueva instalaci�n
*******************************************************************************/

defined('OK') or die();

$erros = $erros_q = array();

if (empty($form['charset'])) {
	$erros[] = 1;
} if (empty($form['db_servidor'])) {
	$erros[] = 2;
} if (empty($form['db_nome'])) {
	$erros[] = 3;
} if (empty($form['db_usuario'])) {
	$erros[] = 4;
} if (empty($form['ad_nome'])) {
	$erros[] = 5;
} if (empty($form['ad_usuario'])) {
	$erros[] = 6;
} if (empty($form['ad_contrasinal'])) {
	$erros[] = 7;
} if ($form['ad_contrasinal'] != $form['ad_rep_contrasinal']) {
	$erros[] = 8;
} if (empty($form['ad_correo'])) {
	$erros[] = 9;
} if (empty($form['ra_nome'])) {
	$erros[] = 10;
} if (empty($form['ra_path'])) {
	$erros[] = 11;
} if (empty($form['ra_web'])) {
	$erros[] = 12;
} if (empty($form['ra_dominio'])) {
	$erros[] = 13;
}

$form['charset'] = addslashes($form['charset']);

$form['db_servidor'] = addslashes($form['db_servidor']);
$form['db_nome'] = addslashes($form['db_nome']);
$form['db_usuario'] = addslashes($form['db_usuario']);
$form['db_contrasinal'] = addslashes($form['db_contrasinal']);
$form['db_prefixo'] = addslashes($form['db_prefixo']);

$form['ad_nome'] = addslashes($form['ad_nome']);
$form['ad_usuario'] = addslashes($form['ad_usuario']);
$form['ad_contrasinal'] = addslashes($form['ad_contrasinal']);
$form['ad_correo'] = addslashes($form['ad_correo']);

$form['ra_nome'] = addslashes($form['ra_nome']);
$form['ra_path'] = addslashes($form['ra_path']);
$form['ra_path'] = str_replace('\\', '/', $form['ra_path']).'/';
$form['ra_path'] = preg_replace('/\/+/', '/', $form['ra_path']);
$form['ra_web'] = addslashes($form['ra_web']);
$form['ra_web'] = str_replace('\\', '/', $form['ra_web']).'/';
$form['ra_web'] = preg_replace('/\/+/', '/', $form['ra_web']);
$form['ra_dominio'] = addslashes($form['ra_dominio']);

if (!is_dir($form['ra_path'])) {
	$erros[] = 14;
}

if ($con = @mysql_connect($form['db_servidor'], $form['db_usuario'], $form['db_contrasinal'])) {
	if (!@mysql_select_db($form['db_nome'], $con)) {
		$erros[] = 15;
	}
} else {
	$erros[] = 16;
}

if (count($erros) == 0) {
	$arq_mysql = $PFN_paths['instalar'].'mysql/instalar.sql';
	$consultas = @fread(@fopen($arq_mysql, 'r'), @filesize($arq_mysql));
	$consultas = str_replace('EXISTS ', 'EXISTS '.$form['db_prefixo'], $consultas);
	$consultas = explode(';', $consultas);

	foreach ((array)$consultas as $q) {
		$q = preg_replace("/''([0-9-]*)''/", "'\\1'", trim($q)); 

		if (empty($q)) {
			continue;
		}

		if (!@mysql_query($q, $con)) {
			$erros[] = 17;
			$erros_q[key($erros)] = '<br />'.$q.'<br />'.mysql_error($con);
		}
	}

	$consultas = include ($PFN_paths['instalar'].'mysql/instalar.php');

	foreach ($consultas as $q) {
		$q = preg_replace("/''([0-9-]*)''/", "'\\1'", trim($q)); 

		if (empty($q)) {
			continue;
		}

		if (!@mysql_query($q, $con)) {
			$erros[] = 17;
			$erros_q[key($erros)] = '<br />'.$q.'<br />'.mysql_error($con);
		}
	}

	if (!is_dir($PFN_paths['tmp'])) {
		if (@mkdir($PFN_paths['tmp'])) {
			copy($PFN_paths['data'].'index.html', $PFN_paths['tmp'].'index.html');
		}
	}

	@chmod($PFN_paths['tmp'], 0700);

	if (!is_dir($PFN_paths['logs'])) {
		if (@mkdir($PFN_paths['logs'])) {
			copy($PFN_paths['data'].'index.html', $PFN_paths['logs'].'index.html');
		}
	}

	@chmod($PFN_paths['logs'], 0700);

	if (!is_dir($PFN_paths['info'])) {
		if (@mkdir($PFN_paths['info'])) {
			copy($PFN_paths['data'].'index.html', $PFN_paths['info'].'index.html');
		}
	}

	@chmod($PFN_paths['info'], 0700);

	if (!is_dir($PFN_paths['extra'])) {
		if (@mkdir($PFN_paths['extra'])) {
			copy($PFN_paths['data'].'index.html', $PFN_paths['extra'].'index.html');
		}
	}

	@chmod($PFN_paths['extra'], 0700);

	if (!is_dir($PFN_paths['info'].'raiz1')) {
		if (@mkdir($PFN_paths['info'].'raiz1')) {
			copy($PFN_paths['data'].'index.html', $PFN_paths['info'].'raiz1/index.html');
		}
	}

	if (!is_dir($PFN_paths['info'].'usuario1')) {
		if (@mkdir($PFN_paths['info'].'usuario1')) {
			copy($PFN_paths['data'].'index.html', $PFN_paths['info'].'usuario1/index.html');
		}
	}

	$PFN_conf->inicial('default');

	if (count($erros) == 0) {
		include_once ($PFN_paths['include'].'class_arquivos.php');
		include ($PFN_paths['instalar'].'include/basicas.inc.php');

		$basicas = basicas(array(
			'version' => $PFN_version,
			'idioma' => $form['idioma'],
			'estilo' => 'estilos/pfn/',
			'email' => $form['ad_correo'],
			'gd2' => $form['gd2'],
			'zlib' => $form['zlib'],
			'charset' => $form['charset'],
			'envio_alertas' => false,
			'db:host' => $form['db_servidor'],
			'db:base_datos' => $form['db_nome'],
			'db:usuario' => $form['db_usuario'],
			'db:contrasinal' => $form['db_contrasinal'],
			'db:prefixo' => $form['db_prefixo']
		));

		if (is_file($PFN_paths['conf'].'licencia.lic')) {
			rename($PFN_paths['conf'].'licencia.lic', $PFN_paths['conf'].$basicas['clave'].'.lic');
		}

		if (is_file($PFN_paths['conf'].'conf.ini')) {
			rename($PFN_paths['conf'].'conf.ini', $PFN_paths['conf'].$basicas['clave'].'.ini');
		}

		if (is_file($PFN_paths['conf'].'control.conv')) {
			rename($PFN_paths['conf'].'control.conv', $PFN_paths['conf'].$basicas['clave'].'.conv');
		}
	}
}

if ($con) {
	@mysql_close($con);
}
?>
