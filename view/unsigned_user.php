<center>
	<form action="javascript:load_main('load_user_car','#user-content','?placa='+document.getElementById('placa').value);">
	<div id="search-car">
		<label>Placa del vehiculo: </label>
		<input type="text" id="placa" onkeyup="check_placa(this)">
		<input type="submit" value="">
	</div>
</center>
<br>
<div id="user-content"></div>
