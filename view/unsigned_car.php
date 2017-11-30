<?php  include("../models/index.php"); ?>
<form name="formi" action="javascript:send_data('AUTO');">
	<div>
		<label>Tipo de Vehiculo: </label>
		<select id="type_car">
			<option>MOTO</option>
			<option>CARRO</option>
		</select>
	</div>
	<div><label>Modelo: </label><input type="text" name="models_car" id="models"></div>
	<div><label>Placa: </label><input type="text" name="id_car" id='placa' onkeyup="check_placa(this);" onchange="check_placa(this);"></div>
	<div><label>Km: </label><input type="text" name="kilometros" id='km'></div>
	<div><label>Cilimdros: </label><select id="cilimdros"><?php print_cilimdros(); ?></select></div>
	<div><label>Capacidad del tanque: </label><input type="text" id="tank_car"></div>
	<div><label>Colores: </label><input type="text" name="color" id='color'></div>
	<div><input type="submit" value="Registrar Auto"></div>
</form>