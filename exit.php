<?php
	session_start();
	if ($_SESSION["user_authed"]==1)
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_login']);
		unset($_SESSION['user_pass']);
		unset($_SESSION['user_authed']);
		session_destroy();
		header ('Location: ../');
	};
	if ($_SESSION["admin_authed"]==1)
	{
		unset($_SESSION['admin_login']);
		unset($_SESSION['admin_pass']);
		unset($_SESSION['admin_authed']);
		session_destroy();
		header ('Location: ../');
	}
?>