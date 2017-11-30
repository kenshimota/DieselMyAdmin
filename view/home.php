<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" value="Erik Mota">
	<meta name="Coperingh">
	<link rel="stylesheet" type="text/css" href="style/login.css">
	<script type="text/javascript" src="script/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="script/ajax.js"></script>
	<link rel="icon" href="img/favicon.png" type="image/png" >
	<title>Diesel My Admin</title>
</head>
<body>
	<div>
		<div>
			<ul id="main-home">
				<li><a href="#" style="float: left;"><img src="img/icon_welcome.png" width="40px" style="margin: -17px 5px -13px auto;">D-M-A</a></li>
				<li><a href="javascript:load_main('car','#content-page');load_main('show_car','#view-config');"><img src="img/favicon.png" width="15px">Vehiculos</a></li>
				<li><a href="javascript:load_main('user_car','#content-page');load_main('show_user_car','#view-config');"><img src="img/user-car.png" width="15px">Usuarios de Vehiculos</a></li>
				<li><a href="javascript:load_main('add_diesel','#content-page');"><img src="img/diesel.png" width="15px">Reposito de llenado</a></li>
				<li><a href="javascript:load_main('configuration','#content-page');"><img src="img/config.png" width="15px">Configuraci&oacute;n</a></li>
			</ul>
		</div>
		<br>
		<br>
		<div id="alert"></div>
		<div id="content-page">
			<div id="welcome">
				<div><h3>Bienvenidos a Diesel My Admin 1.1</h3></div>
				<div>
					<center><img src="img/icon_welcome.png" width="80px"></center>
					<span>
						La web que te permitira administrar los datos de la distribucion
						de la gasolina con el mayor control...<br>
						Evaluara y Estudiara todos los datos obtenidos de cada carga de la gasolina.
					</span>
				</div>
			</div>
		</div>
	</div>
</body>
</html>