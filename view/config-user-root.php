<table id='title-table'>
<tr><td style='border:0px;'>Perfil</td><td>Nombre y Apellido</td><td>Cedula de identidad</td><td>Usuario</td><td>Contrase&ntilde;a</td></tr>
</table>

<?php

session_start();

include("../models/index.php");

show_user_dma();

mysql_select_db(BD, connect_db());
$query = mysql_query("select * from user_pdvsa where token='$_SESSION[user_id_pdvsa]'")or error_connect(mysql_error());

if($q = mysql_fetch_array($query))
{
	if($q['type_user'] == 'root')
		print("<br><div><button onclick=load_main('new-dma','#alert');show_alert(); id='close' style=float:right;width:250px;margin-top:5px;background-image:url('img/drop-add.png');background-position:10px;background-size:25px;background-repeat:no-repeat;'>Crear Usuario DMA</button></div>");
}