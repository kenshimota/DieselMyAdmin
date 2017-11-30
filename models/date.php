<?php
/**
* -- Funcion encargada de devolver la cantidad de dias que el carro va ha hechar 
* gasolina...---
*
* @param string $_date 
*
* @return array
*/
function date_day($_date){
	
	$_year = null;
	$_mook = null;
	$_day = null;

	for($i=0; $i < 10; $i++){
		if($i < 4){
			$_year = $_year.$_date[$i];
		}
		if($i > 4 && $i < 7){
		  $_mook = $_mook.$_date[$i];
		}
		if($i > 7){
			$_day = $_day.$_date[$i];
		}
	}
	return array($_day,$_mook,$_year,$_date);
}

function check_long_date($_dt_1,$_dt_2){

	$_dt_1 = date_day($_dt_1);
	$_dt_2 = date_day($_dt_2);

	if($_dt_1 == $_dt_2)
		return 0;
	else
	{
		if($_dt_1[2] == $_dt_2[2])
		{
			$_365_dt[0] = $_dt_1[0]+($_dt_1[1] * 30);
			$_365_dt[1] = $_dt_2[0]+($_dt_2[1] * 30);
		}
		else
		{
			$_365_dt[0] = $_dt_1[2] * 365;
			$_365_dt[1] = $_dt_2[2] * 365;

		}
	}

	return ($_365_dt[0] - $_365_dt[1]);
}

?>