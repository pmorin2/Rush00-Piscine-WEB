<?php
session_start();
header('Location: panier.php');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
if (!empty($_SESSION["panier"]))
{
	if ($_SESSION["loggued_on_user"] != "")
	{
		$res = mysqli_query($link, "INSERT INTO commandes (name) VALUE ('".mysqli_real_escape_string($link, $_SESSION["loggued_on_user"])."');");
		if ($res === false)
			echo "ERROR";
		$last_id = mysqli_insert_id($link);
		foreach ($_SESSION["panier"] as $value)
		{
			$res = mysqli_query($link, "INSERT INTO commandes_desc (id_commande, id_prod, nbr) VALUE ('".mysqli_real_escape_string($link, $last_id)."', '".mysqli_real_escape_string($link, $value["id"])."', '".mysqli_real_escape_string($link, $value["nbr"])."');");
			if ($res === false)
				echo "ERROR";
		}
	}
	else
		header('Location: ../index.html');
}
$_SESSION["panier"] = NULL;
mysqli_close($link);
?>