<?php

/**
* -- Funcion encargada de crear los reportes --
* @param string $user
* @param string $msg_report
* @param string $title
* 
* @return 1 || 0
*/
function create_report($user, $title, $msg_report){
	if( ($msg = auth_report($user, $title, $msg_report)) ){
		mysql_select_db(BD, connect_db());
		$query = mysql_query("insert into alert_error (id_user, title, msg_alert, date)
			values('$user','$title','$msg_alert','".date("Y-m-d")."')",connect_db()) or error_connect(mysql_error());
		if(!$query)
			return 0;
		return 1;
	}
	else
	{
		error_connect($msg);
		return 0;
	}
}


?>