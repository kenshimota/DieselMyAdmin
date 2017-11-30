<?php


/**
* -- Funcion que se encarga de imprimir los cilimdros creados de acuerdo al estudio realizado --
* @param void
*/
function print_cilimdros()
{
	$i=0;
	mysql_select_db(BD, connect_db()) or error_connect(mysql_error());
	$query = mysql_query("select * from student_max_diesel order by cilimdros asc", connect_db()) or error_connect(mysql_error());
	while($q = mysql_fetch_array($query))
	{
		$i++;
		print("<option>".$q['cilimdros']."</option>");
	}
	if($i == 0)
		print("<option>$i</option>");
}

/**
*
*/

function study_cilimdros()
{
	$i = 0;
	$j = 0;
	$array_data = array();
	mysql_select_db(BD, connect_db()) or error_connect(mysql_error());
	$query = mysql_query("select * from student_max_diesel  order by cilimdros asc", connect_db()) or error_connect(mysql_error());

	print("<table id='title-table'>");
	print("<tr><td style='border:0px;'>Cilimdros</td><td>Kilometros</td ><td>Litros</td><td>Acci&oacute;n</td></tr>");
	print("</table>");
	print("<table><tr><td style='border:0px;'></td><td></td><td></td><td></td></tr>");
	while($q = mysql_fetch_array($query))
	{
		print("<tr><td style='border:0px;'> $q[cilimdros] </td> <td> $q[km] Km </td> <td> $q[lt_diesel] Lt.s</td> <td><a href=javascript:send_data('DELETE','$q[id_student]');>Eliminar</a></ td></tr>");
	}
	print("</table>");
}

function add_data_cil($c,$k,$l)
{
	$msg = auth_cil($c, $k, $l);
	if($msg == null)
	{
		mysql_select_db(BD, connect_db());
		mysql_query("insert into student_max_diesel (cilimdros,km,lt_diesel) values('$c','$k','$l')",connect_db());
		print_ok("Los datos fueron creados con exito...");
	}
	else
		error_connect($msg);
}


function auth_cil($c, $k, $l){
	$msg = null;
	if(is_int($c) || is_int($k) || is_int($l))
		$msg = "Los datos ingresados no fueron numericos<br>";
	if($c < 1)
		$msg = $msg."Los cilimdros no pueden ser menos de 4<br>";
	if($k <= 0)
		$msg = $msg."La distancia ingresada no es valida<br>";
	if($l <= 0)
		$msg = $msg."Los litros de gasolina ingresado no son validos";
	if($msg != null)
		$msg = $msg."...";
	return $msg;
}

function delete_student_diesel($_id){
	mysql_select_db(BD, connect_db());
	mysql_query("delete from student_max_diesel where id_student='$_id'")or error_connect("El dato no pudo ser elimindado intente mas tarde...");
	print_ok("El dato del estudio realizado del calculo de cilimdros por km/lt de gasolina fue eliminado...");
}
?>