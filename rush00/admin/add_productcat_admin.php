<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
if (!empty($_GET["id_prod"]) && !empty($_GET["name_cat"]))
{
	$res = mysqli_query($link, "SELECT id_prod, name_cat FROM prodincat WHERE id_prod = '".mysqli_real_escape_string($link, $_GET["id_prod"])."' AND name_cat = '".mysqli_real_escape_string($link, $_GET["name_cat"])."';");
	$result = mysqli_fetch_array($res);
	if (!empty($result))
		header('Location: modif_product_admin.php');
	else
	{
		$res = mysqli_query($link, "INSERT INTO prodincat (id_prod, name_cat) VALUES ('".mysqli_real_escape_string($link, $_GET["id_prod"])."', '".mysqli_real_escape_string($link, $_GET["name_cat"])."');");
		if ($res === true)
				header('Location: modif_product_admin.php');
			else
				echo "ERROR<br />";
	}
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