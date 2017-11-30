<?php
include("../models/index.php");

if(isset($_GET['placa']))
{
	if(check_exist_car($_GET['placa']))
	{
		print('
		<form action=javascript:send_data("PEOPLE") name="formi">
			<div><label>Nombre Completo: </label><input type="text" id="name"></div>
			<div>
				<label>Cedula de Identidad: </label>
				<input type="text" id="id_user" style="width:280px;">
				<select id="type_id" style="width:40px;">
					<option>V</option>
					<option>E</option>
				</select>
			</div>
			<div>
				<label>Tipo de cuenta: </label>
				<select id="type_user">
					<option>Particular</option>
					<option>Transporte</option>
				</select>
			</div>
			<div><input type="submit" value="Crear Usuario"></div>
		</form>');
	}
	else
		error_connect("El vehiculo ingresado no esta registrado...");
}
?>