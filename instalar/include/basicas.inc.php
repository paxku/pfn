<?php
/*******************************************************************************
* instalar/include/basicas.inc.php
*
* Crea el fichero de configuración basicas.inc.php
*******************************************************************************/

defined('OK') or die();

function basicas ($datos) {
	global $PFN_paths;

	$PFN_conf = (object) NULL;
	$PFN_arquivos = new PFN_Arquivos($PFN_conf);

	$licencia['script'] = 'data/conf/basicas.inc.php';
	$licencia['descricion'] = 'Fichero de configuraciónes básicas';

	$PFN_version = $datos['version'];

	$texto = '<?php'."\n";
	$texto .= include ($PFN_paths['include'].'licencia.php');
	$texto .= "\n\n".'defined(\'OK\') or die();'
		."\n\n".'// Este fichero se crea automaticamente, pero se pueden'
		."\n".'// variar los valores almacenados si es necesario'
		."\n".'// This file is created automatically, but you can change'
		."\n".'// the values if it\'s necessary'
		."\n".'return array('
		."\n\t".'\'clave\' => \''.md5(microtime()).'\', // Clave de encriptación / Encription key'
		."\n\t".'\'version\' => \''.$datos['version'].'\','
		."\n\t".'\'estilo\' => \''.$datos['estilo'].'\','
		."\n\t".'\'idioma\' => \''.$datos['idioma'].'\', // Language'
		."\n\t".'\'email\' => \''.$datos['email'].'\','
		."\n\t".'\'gd2\' => '.($datos['gd2']?'true':'false').', // GD2 instalado / GD2 installed'
		."\n\t".'\'zlib\' => '.($datos['zlib']?'true':'false').', // ZLIB instalado / ZLIB installed'
		."\n\t".'\'charset\' => \''.$datos['charset'].'\', // Juego de caracteres / Charset'
		."\n\t".'\'envio_alertas\' => '.($datos['envio_alertas']?'true':'false').', // Envio de correo alertando de intento de intrusion / Send mail notify an intrusion try access'
		."\n\t".'\'db\' => array( // Base de datos / Data base'
		."\n\t\t".'\'host\' => \''.$datos['db:host'].'\','
		."\n\t\t".'\'base_datos\' => \''.$datos['db:base_datos'].'\', // Nombre de la base de datos / Data base name'
		."\n\t\t".'\'usuario\' => \''.$datos['db:usuario'].'\', // Usuario / User'
		."\n\t\t".'\'contrasinal\' => \''.$datos['db:contrasinal'].'\', // Contraseña / Password'
		."\n\t\t".'\'prefixo\' => \''.$datos['db:prefixo'].'\' // Prefijo para las tablas / Table prefix'
		."\n\t".'),'
		."\n\t".'\'smtp\' => array('
		."\n\t\t".'\'host\' => \''.$datos['smtp:host'].'\', // Servidor de correo / Mail Server'
		."\n\t\t".'\'user\' => \''.$datos['smtp:user'].'\', // La cuenta de usuario con la que se enviara el correo / User account to send mails'
		."\n\t\t".'\'password\' => \''.$datos['smtp:password'].'\', // Contraseña de esa cuenta de usuario / Password to user account'
		."\n\t\t".'\'port\' => '.intval($datos['smtp:port']).', // Puerto de SMTP / SMTP port'
		."\n\t\t".'\'secure\' => \''.$datos['smtp:secure'].'\', // Usar \'\', \'ssl\' o \'tls\' / Use \'\', \'ssl\' or \'tls\''
		."\n\t\t".'\'auth\' => '.($datos['smtp:auth']?'true':'false').', // Autenticacion SMTP (true|false) // SMTP authentication (true|false)'
		."\n\t\t".'\'timeout\' => '.intval($datos['smtp:timeout']).', // Tiempo de espera de respuesta del servidor / Server reply time out'
		."\n\t\t".'\'debug\' => '.($datos['smtp:debug']?'true':'false').' // Imprimir resultado de envios / Print send results'
		."\n\t".')'
		."\n);\n?>";

	$PFN_arquivos->abre_escribe($PFN_paths['conf'].'basicas.inc.php', $texto);

	return include ($PFN_paths['conf'].'basicas.inc.php');
}
?>
