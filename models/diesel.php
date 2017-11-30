<?php

function print_alert($user)
{
	$data_user = check_exist_user($user);
	print("<form action=javascript:send_data('REPORT_DIESEL'); name='formi' style='margin-top:20px;'>
		<div><h5>EL usuario $data_user[name_user] no ha recorrido los km requeridos para el consumo de la gasolina obtenida</h5></div>
		<div><label>Asunto:</label> <input type='text'></div>
		<div><label>Reporte: </label><textarea id='msg-report'></textarea></div>
		<div><input type='button' id='close' value='Cerrar' onclick=clear_alert();><input type='submit' Value='Enviar Reporte'></div>
		<input type='hidden' value='$user' id='user'></form>");
}

function add_diesel($placa, $km, $user, $diesel){

	$verify = auth_add_diesel($placa, $km, $user, $diesel);

	if($verify == "")
	{
		$date = date("Y-m-d");
		$time = date("H:i:s");
		mysql_select_db(BD, connect_db());
		mysql_query("insert into add_diesel_car (id_car, Km_car_today, id_user, Lt_diesel_add, date, time) values('$placa','$km','$user','$diesel','$date','$time')")or error_connect(mysql_error());
		mysql_query("update car set Km='$km' where placa_car='$placa'",connect_db());
		print_ok("Este vehiculo puede cargar gasolina...");
	}
	elseif($verify != "R")
		error_connect($verify);
}

function auth_add_diesel($placa, $km, $user, $lt){

	$msg = "";

	$user_check = check_exist_user($user);

	if($user_check == null){
		$msg = "El usuario ingresado no esta registrado<br>";
	}
	if (check_exist_car($placa) == 0) {
		$msg = $msg."El auto ingresado no esta registrado<br>";
	}

	$car = get_car($placa);

	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from add_diesel_car where id_car='$placa' order by id_llenado desc") or error_connect(mysql_error());
	if($q = mysql_fetch_array($query)){

		$km_last = $q['Km_car_today'];
		$diesel_last = $q['Lt_diesel_add'];
		$date = $q['date'];
	}
	else
	{
		$km_last = $car['Km'];
		$diesel_last = 0;
		$date = null;
	}

	if($car['tank_car'] <  $lt)
		$msg = $msg."Este tanque no tiene capacidad para esa cantidad de gasolina<br>";

	if(date("Y-m-d") == $date){

		$msg = $msg."Este Vehiculo lleno el tanque hoy<br>";
	}

	if(check_km_for_lt($car['cilimdros'], $km, $km_last, $diesel_last) == 0 && $msg == ""){
			print_alert($user);
			return 'R';
		}
	return $msg;
}

function check_km_for_lt($cilimdros, $km, $km_l ,$lt){

	mysql_select_db(BD, connect_db());
	$query = mysql_query("select * from student_max_diesel where cilimdros='$cilimdros'",connect_db())or error_connect(mysql_error());
	if($q = mysql_fetch_array($query))
		$km_lt = ($q['km']/$q['lt_diesel']);
	else
		$km_lt = null;
	if($lt > 0)
	{

		$km_verify = (($km_lt) * $lt) + $km_l;

		if($km < ($km_verify - 5))
			return 0;
		else
			return 1;
	}
	else
		return 1;
}
?>