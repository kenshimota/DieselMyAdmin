<?php
include("models/index.php");
if(isset($_GET['type']))
{
	switch($_GET['type']){
		case "AUTO":
            add_car($_POST['placa'] ,$_POST['km'] ,$_POST['models'] ,$_POST['color'] ,$_POST['cilimdros'] ,$_POST['type_car'] ,$_POST['tank_car']);
		break;
		case "PEOPLE":
			add_user_car($_POST['placa'], $_POST['id'], $_POST['type_id'], $_POST['name'], $_POST['type_user']);
		break;
		case 'CILIMDROS':
			add_data_cil($_POST['c'],$_POST['km'],$_POST['lt']);
		break;
		case "DIESEL":
			add_diesel($_POST["p"],$_POST['km'], $_POST['u'], $_POST['l']);
		break;
		case "DELETE":
			delete_student_diesel($_POST['x']);
		break;
		case "USER_CREATE":
			create_user_dma( "./img/user_car (".rand(1,12).").png", $_POST['name'], $_POST['user'], $_POST['password'], $_POST['id'], $_POST['type_user']);
		break;
	}
}
?>