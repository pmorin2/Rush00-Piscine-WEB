<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
if (!empty($_GET["id"]))
{
	$res = mysqli_query($link, "DELETE FROM prodincat WHERE id = '".mysqli_real_escape_string($link, $_GET["id"])."';");
	if ($res === true)
	{
		mysqli_close($link);
		header('Location: modif_product_admin.php');
	}
	else
		echo "ERROR<br />";
}
else
	header('Location: modif_product_admin.php');
mysqli_close($link);
?>
<html><body>
<br />
<a href="modif_product_admin.php">Retour</a><br />
<a href="logout_admin.php">Se déconnecter</a><br />
</body></html>