<?php

define('BD','pdvsa');
define('SERVER_URI',"http://".$_SERVER['HTTP_HOST']."/pdvsa/?page=login&token=".session_id());

/**
* -- Funcion encargada de conectar a la base de datos --
* @return mysql_connect;
*/
function connect_db()
{
	$user_db = "root";
	$password_db = "";
	return mysql_connect($_SERVER['SERVER_NAME'], $user_db, $password_db);
}

function html_char_special($string){

	$chars = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES | ENT_HTML5);
	foreach ($chars as $key => $value) {
		$string = str_replace($key, $value, $string);
	}
	return $string;
}

/* Esta en la funcion encargada de dar a conocer que ha ocurrido un error */
function error_connect($string)
{
	print("<div id='content-alert'><div id='title-alert'>Ha ocurrido un error</div><div id='msg-alert'><br>$string</div><br><input type='button' onclick='clear_alert();' value='Cerrar'></div></center>");
}


function print_ok($string){
	print("<div id='content-ok'><div id='title-alert'>Exito</div><div id='msg-alert'><br>$string</div><br><input type='button' onclick='clear_alert();' value='OK'></div></center>");
}

/* cada inclusion tendra dentro de si 
las ordenes dadas para cada parte del servidor */
include('user.php');

include('diesel.php');

include('car_models.php');

include('cilimdros.php');

include("date.php");

include("report.php");
?>