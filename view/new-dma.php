<form action="javascript:send_data('USER_CREATE');" name="formi" style="margin-top: 40px;">
	<div><label>Nombre Completo: </label> <input type="text" id="name_user"></div>
	<div><label>Cedula de identidad: </label><input type="text" id="id_user"></div>
	<div><label>Usuario: </label><input type="text" id="user_dma"></div>
	<div><label>Contrase&ntilde;a: </label><input type="password" id="password_user"></div>
	<div>
		<label>Tipo de usuario: </label>
		<select id="type_user">
			<option value="state">Estandar</option>
			<option value="root">Administrador</option>
		</select>
	</div>
	<div><input type="submit" value="Crear Usuario"><input type="button" value="cerrar" onclick="clear_alert();" id="close"></div>
</form>