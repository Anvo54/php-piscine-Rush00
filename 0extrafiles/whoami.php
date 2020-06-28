<?php
	session_start();
	if($_SESSION["login_user"])
		echo $_SESSION["login_user"],"\n";
	else
		echo "ERROR\n";
?>
