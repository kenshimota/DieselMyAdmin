<?php
include("../models/index.php");

if(isset($_GET['placa']))
{
	if(check_exist_car($_GET['placa']))
	{
		$car = get_car($_GET['placa']);
		print("<form action=javascript:send_data('DIESEL') name='formi'>
			<div><label>Usuario: </label><select id='user'>");
		get_users($_GET['placa']);
		print("</select></div></div></div>
			<div><label>Km: </label><input type='text' id='km' value='$car[Km]'</div>
			<div><label>Lt.s: </label><input type='text' id='diesel'></div>
			<div><input type='submit' value='Crear Reposito'></div>
			<input type='hidden' value='$_GET[placa]' id='placa'></form>");

	}
	else
		error_connect("El vehiculo ingresado no esta registrado...");
}
?>