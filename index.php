<?php
require_once("system/sys.php");
$sys = new sys();

if( $_GET['exit'] ){
	$sys->logout();	
}

if( $_GET['sql'] ){
	$sys->to_sql();
}

if( $sys->is_auth() ){
	$sys->view("system/views/home.php");
} else if( $_POST['login'] && $_POST['pass'] && $_POST['pass2'] ){
	$sys->register_user();
	$sys->view("system/views/auth.php", $sys->message);
} else {
	$sys->auth_user();
	$sys->view("system/views/auth.php", $sys->message);
}
?>
