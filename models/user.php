<?php

/**
*____________________________________________
*____________ SECCION DE USUARIOS ___________
*____________________________________________
*/

//ultima vez actualizado el 23-11-2017 a las 9:45 a.m

/** 
* -- Funcion encargada de crear una cesión de usuario si 
* su cotraseña y usuario son correctas -- 
*/
function create_session($_TOKEN)
{
	mysql_select_db(BD,connect_db());
	$query = mysql_query("select * from user_pdvsa where token= '$_TOKEN' ",connect_db()) or error_connect(mysql_error());
	if($u = mysql_fetch_array($query)){
		$_SESSION['user_id_pdvsa'] = $_TOKEN;
		mysql_query("update user_pdvsa set date_session='".date("Y-m-d")."' where token='$_TOKEN'");
		mysql_query("update user_pdvsa set time_session='".date("H-i-s")."' where token='$_TOKEN'");
	}
	else
	{
		error_connect("Usuario o contrase&ntilde;a son incorrectos");
		return 0;
	}
}

/** 
* -- Funcion encargada de verificar que existe una varible de cesion -- 
*/
function auth_session()
{
	if(!isset($_SESSION['user_id_pdvsa']))
		return 0;
	else
		return 1;
}

/**
* -- Esta funcion se encargara de crear un nuevo usuario para un carro dato de acuerdo
* A que verificara cuantos usuarios pueden registrar el carro sin superar el numero 2 --
* @param string $placa
* @param int $id 
* @param char $type_id
* @param string $type_user
*
* @return function
*/

function add_user_car($placa_car, $id, $type_id,$name, $type_user)
{
	$msg = auth_user_car($placa_car, $id, $type_id, $name, $type_user);
	if($msg == "")
	{
		mysql_select_db(BD, connect_db());
		mysql_query("insert into user_car (name_user, ci_user, type_ci_user, placa_car, type_user)  values ('$name','$id','$type_id','$placa_car','$type_user')",connect_db()) or error_connect(mysql_error());
		print_ok("El usuario $name de la Cedula de identidad $type_id-$id ha sido creado con exito");
	}
	else
		error_connect($msg);
}

/**
* -- Funcion que verificara si usuario el usuario a crear existe
* o si el carro tiene menos de 2 usuarios --
* @param string $placa
* @param int $id 
* @param char $type_id
* @param string $type_user
*
* @return function
*/
function auth_user_car($placa_car, $id, $type_id,$name, $type_user){
	$msg = "";
	$i = 0;

	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from user_car where placa_car='$placa_car'", connect_db());
	
	while($q = mysql_fetch_array($query))
		$i++;
	
	if ($i >= 2){
		$msg  = "Este vehiculo es un auto y ya tiene 2 usuarios registrados<br>";
	}
	else{

		$query = mysql_query("select * from car where placa_car='$placa_car'");
		if($q = mysql_fetch_array($query))
			$type = $q['type_car'];
		if($i == 1 && $q['type_car'] == "MOTO")
			$msg = "Esta vehiculo es una moto y ya tiene 1 usuario registrado<br>";
	}

	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from user_car where ci_user='$id'") or error_connect(mysql_error());
	if($q = mysql_fetch_array($query))
		$msg = "Este usuario esta registrado<br>";
	if(strlen($placa_car) < 6 && strlen($placa_car) > 7)
		$msg = "El numero de la placa es invalida...<br>";	
	if($id  < 1000000)
		$msg = $msg."El numero de cedula es invalido<br>";
	if($type_id != 'E' && $type_id != 'V')
		$msg =$msg."Error en la identificacion del usuario<br>";
	if(strlen($name) < 10)
		$msg =$msg."El nombre ingresado no es valido...<br>";
	if($type_user != 'Transporte'  && $type_user != 'Particular')
		$msg = $msg."El tipo de usuario ingresado no es valido<br>";

	return $msg;
}


/**
* -- Funcion encargada de imrpimir los usuarios registrados --
*/
function  show_user($order,$columns){

	$i = 0;
	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from user_car order by $columns $order",connect_db()) or error_connect(mysql_error());
	while($q = mysql_fetch_array($query)){
		$name_user = html_char_special($q['name_user']);
		$ci_user = $q['type_ci_user']."-".$q['ci_user'];
		$placa_car = html_char_special($q['placa_car']);
		$type_car = get_car($q['placa_car']);
		$type_user = $q['type_user'];

		print("<tr>
			<td style='border:0px;'><img src='img/user_car (".rand(1,12).").png' width='20px' style='border-radius:20px;margin-bottom:-5px;'> --> (".($i+1).")</td>
			<td>$name_user</td>
			<td>$ci_user</td>
			<td>$type_car[type_car]</td>
			<td>$type_car[models_car]</td>
			<td>$type_user</td>
			</tr>");
		unset($type_car);
		$i++;
	}
}

/**
* -- Funcion que se encarga de obtener todos los usuarios de un vehiculo --
*/

function get_users($placa)
{
	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from user_car where placa_car='$placa'")or error_connect(mysql_error());
	while ($q = mysql_fetch_array($query)){
		print("<option value='$q[ci_user]'>$q[name_user]</option>");
	}
}

function check_exist_user($id){

	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from user_car where ci_user='$id'",connect_db()) or error_connect(mysql_error());
	if($q = mysql_fetch_array($query))
		return $q;
	else
		return null;
}

function show_user_dma(){
	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from  user_pdvsa",connect_db());
	print("<table><tr><td style='border:0px;'></td><td></td><td></td><td></td></tr>");
	while($q = mysql_fetch_array($query)){

		 $data_password_user = base64_decode($q['token']);
		 $password = substr(strstr($data_password_user, "@"), 1);
		 $user = str_replace($password, null, $data_password_user);
		 $user = str_replace('@', null, $user);
		 $lenght = strlen($password);
		 $password = null;
		 for($i=0; $i < $lenght; $i++)
		 	$password = $password."*";

		print("<tr>
			<td style='border:0px;'><img src='$q[img]' width='40px' height='40px'></td>
			<td style='border:0px;'>$q[name_user_pdvsa]</td>
			<td style='border:0px;'>$q[ci_user_pdvsa]</td>
			<td style='border:0px;'>$user</td>
			<td style='border:0px;'>$password</td>
			</tr>");
	}
	print("</table>");
}

function create_user_dma($img, $name, $user, $password, $id, $_type){

	$msg = check_user_dma($name, $user, $password, $id);
	
	if($msg == null){
		
		$date = date("Y-m-d");
		$time = date("H:i:s");
		$token = base64_encode($user."@".$password);

		mysql_select_db(BD, connect_db());
		mysql_query("insert into user_pdvsa 
			(user, password, type_user,name_user_pdvsa, ci_user_pdvsa, img, token, date_create, time_create) values
			('$user', PASSWORD('$password'), '$_type' ,'$name', '$id', '$img', '$token', '$date', '$time')")or error_connect(mysql_error());
		
		print_ok("El usuario $user fue creado con exito");

	}
	else
		error_connect($msg);
}

function check_user_dma($name, $user, $password, $id){
	$msg = null;

	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from user_pdvsa where user='$user'",connect_db());

	if($q = mysql_fetch_array($query))
		$msg = "Este usuario ya esta registrado<br>";
	if(strlen($name) < 10)
		$msg = $msg."El nombre ingresado no es valido<br>";
	if(strlen($password) < 8)
		$msg = $msg." La contrase&ntilde;a ingresada no es valida<br>";
	if($id  < 1000000)
		$msg = $msg."La Cedula de identidad $id  ingresada no es valida<br>";
	if(search_arr($password))
		$msg = $msg."La contrase&ntilde;a tiene un caracter no valido<br>";
	if(search_arr($user))
		$msg = $msg."Hay un caracter invalido ingresado en el usuario<br>";

	return $msg;
}

function search_arr($string){
	for($i=0; $i < strlen($string); $i++){
		if( '@' == $string[$i] )
			return 1;
	}

	return 0;
}
?>