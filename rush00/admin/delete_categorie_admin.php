<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$error = true;
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
if (!empty($_POST["name"]))
{
	$res = mysqli_query($link, "SELECT name FROM categories WHERE name = '".mysqli_real_escape_string($link, $_POST["name"])."';");
	$result = mysqli_fetch_array($res);
	if (!empty($result))
		$error = false;
}
if ($_POST["submit"] == "OK" && $error === false)
{
	$res = mysqli_query($link, "DELETE FROM categories WHERE name ='".mysqli_real_escape_string($link, $_POST["name"])."';");
	$res2 = mysqli_query($link, "DELETE FROM prodincat WHERE name_categorie ='".mysqli_real_escape_string($link, $_POST["name"])."';");
	if ($res === true)
		{
			mysqli_close($link);
			header('Location: main_admin.php');
		}
		else
			echo "ERROR\n";
}
else
	echo "Cette catégorie n'existe pas<br />";
mysqli_close($link);
?>
<html><body>
<br />
<a href="main_admin.php">Retour</a><br />
<a href="logout_admin.php">Se déconnecter</a><br />
</body></html>