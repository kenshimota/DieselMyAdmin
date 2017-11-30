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
		<td onclick="load_main('show_car','#view-config','?order=<?php echo $q; ?>&columns=type_car');" style="border:0px;">Tipo de Vehiculo</td>
		<td onclick="load_main('show_car','#view-config','?order=<?php echo $q; ?>&columns=placa_car');">Placa</td>
		<td onclick="load_main('show_car','#view-config','?order=<?php echo $q; ?>&columns=cilimdros');">Cilimdros</td>
		<td onclick="load_main('show_car','#view-config','?order=<?php echo $q; ?>&columns=tank_car');">Capacidad del tanque</td>
		<td onclick="load_main('show_car','#view-config','?order=<?php echo $q; ?>&columns=models_car');">Modelo</td>
		<td onclick="load_main('show_car','#view-config','?order=<?php echo $q; ?>&columns=color_car');">Color</td>
	</tr>
</table>
<table>
	<?php
		if(isset($_GET['order']))
			show_car($_GET['order'],$_GET['columns']);
		else
			show_car("asc","type_car");
	?>
</table>