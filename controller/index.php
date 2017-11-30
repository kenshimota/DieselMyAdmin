<?php

session_start();

include("./models/index.php");

if(isset($_POST['user_pdvsa'],$_POST['password_pdvsa']))
	create_session(base64_encode("$_POST[user_pdvsa]@$_POST[password_pdvsa]"));

if(isset($_GET['page'],$_GET['token'])){
	if(auth_session())
		include("./view/$_GET[page].php");
	else
		include("./view/login.php");
}
else if(auth_session())
	include("./view/home.php");
else
	include("./view/login.php");
?>