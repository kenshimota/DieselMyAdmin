<?php

/**
*____________________________________________
*____________ SECCION DE VEHICULOS__________
*____________________________________________
*/

//ultima vez editado el 22-11-2017 a las 6:30pm

/**
* -- Funcion encargada de crear los datos de un carro --
* @param string $placa
* @param int $km
* @param string models
* @param string color
*
*return void
*/
function add_car($placa, $km, $models, $color,$cilimdros,$_type,$tank){

	
	mysql_select_db(BD,connect_db());

	if( ($msg= auth_data_car($placa, $km, $models, $color,$cilimdros,$tank)) == 1)
	{
		mysql_query("insert into car (placa_car, Km, models_car, color_car,cilimdros, type_car,tank_car)
			values('$placa','$km','$models','$color','$cilimdros','$_type','$tank')",connect_db())or error_connect(mysql_error());
		print_ok("El vehiculo $placa ha sido creado con exito...");
	}
	else
		error_connect($msg);
}

/**
* -- Funcion encargada de verificar que los datos del carro son correctos --
* @param string $placa
* @param int $km
* @param string models
* @param string color
*
* @return 1 || 0
*/
function auth_data_car($placa, $km, $models, $color, $cilimdros, $tank)
{
	$msg = null;

	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from car where placa_car='$placa' ", connect_db());

	if($q = mysql_fetch_array($query))
		$msg = "Este Vehiculo ya esta registrado";
	if(strlen($placa) < 6 || strlen($placa) > 7)
		$msg = "El numero de placa $placa es invalido<br>";
	if($km < 0)
		$msg = $msg."El km es invalido<br>";
	if($cilimdros < 1)
		$msg = $msg."El numero de cilimdros $cilimdros no es valido<br>";
	if($tank > 100 || $tank <= 0)
		$msg = $msg."No existe un tanque con esa capacidad<br>"; 
	if(strlen($models) < 2)
		$msg = $msg."Ingrese un modelo existente por favor<br>";
	if(strlen($color) < 4)
		$msg = $msg."No existe un color menor de 4 letras...";
	/* -- Si no llega hallar algun error retorna que todo los datos son correctos --*/
	if($msg == null)
		$msg = 1;
	return $msg;
}

/**
* -- Funcion que se encarga de verificar que el vehiculo existe o esta registrado --
* @param string $id_car
*
* @return 1 || 0
*/
function check_exist_car($id_car)
{
	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from car where placa_car='$id_car'")or error_connect(mysql_error());
	if($q = mysql_fetch_array($query))
		return 1;
	else
		return 0;
}

/**
* -- Funcion encargada de imprimir en pantalla los vehiculos registrados --
* @param void
*
* @return void
*/
function get_car($placa){
	
	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from car where placa_car='$placa'", connect_db()) or error_connect(mysql_error());
	if($q = mysql_fetch_array($query)){
		return $q;
	}
}


function show_car($order,$columns){
	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from car order by $columns $order")or error_connect(mysql_error());
	while ($q = mysql_fetch_array($query)) {

		$q['placa_car'] = html_char_special($q['placa_car']);
		$q['models_car'] = html_char_special($q['models_car']);
		$q['color_car'] = html_char_special($q['color_car']);

		print("<tr><td style='border:0px;'>$q[type_car]</td><td>$q[placa_car]</td><td>$q[cilimdros]</td><td>$q[tank_car]</td><td>$q[models_car]</td><td>$q[color_car]</td></tr>");
	}
}
?>