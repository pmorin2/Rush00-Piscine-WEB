<?php
session_start();
include "auth.php";
if (!empty($_POST["login"]) && !empty($_POST["passwd"]))
{
	if (auth($_POST["login"], $_POST["passwd"]))
	{
		$_SESSION["loggued_on_user"] = $_POST["login"];
		if ($_SESSION["loggued_on_user"] == "admin")
			header('Location: admin/main_admin.php');
		else
			header('Location: website/main.php');
	}
	else
	{
		$_SESSION["loggued_on_user"] = "";
		echo "ERROR\n";
		header('Location: index.html');
	}
}
else
	header('Location: website/main.php');
?>