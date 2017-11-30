<?php
	include("../models/index.php");
	if(isset($_GET['order']))
	{
		if($_GET['order'] == "desc")
			$q = "asc";
		else
			$q = "desc";
	}
	else
		$q = "asc"; 
?>

<table id="title-table">
	<tr>
			<td onclick="load_main('show_user_car','#view-config','?order=<?php echo $q; ?>&columns=id_user');" style="border:0px;"> N </td>
			<td onclick="load_main('show_user_car','#view-config','?order=<?php echo $q; ?>&columns=name_user');">Nombre y Apellido</td>
			<td onclick="load_main('show_user_car','#view-config','?order=<?php echo $q; ?>&columns=type_ci_user,ci_user');">Cedula de Identidad</td>
			<td onclick="load_main('show_user_car','#view-config','?order=<?php echo $q; ?>&columns=placa_car');">Tipo de Vehiculo</td>
			<td onclick="load_main('show_user_car','#view-config','?order=<?php echo $q; ?>&columns=placa_car');">Modelo</td>
			<td onclick="load_main('show_user_car','#view-config','?order=<?php echo $q; ?>&columns=type_user');">Tipo de usuario</td>
		</div>
	</tr>
</table>
<table>
	<?php
		if(isset($_GET['order']))
			show_user($_GET['order'],$_GET['columns']);
		else
			show_user("asc","name_user");
	?>
</table>