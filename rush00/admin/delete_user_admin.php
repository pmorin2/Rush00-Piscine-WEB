<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$error = true;
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
if (!empty($_POST["login"]))
{
	$res = mysqli_query($link, "SELECT login FROM passwd WHERE login = '".mysqli_real_escape_string($link, $_POST["login"])."';");
	$result = mysqli_fetch_array($res);
	if (!empty($result))
		$error = false;
}
if ($_POST["submit"] == "OK" && $error === false)
{
	$res = mysqli_query($link, "DELETE FROM passwd WHERE login ='".mysqli_real_escape_string($link, $_POST["login"])."';");
	if ($res === true)
		{
			mysqli_close($link);
			header('Location: main_admin.php');
		}
		else
			echo "ERROR\n";
}
else
	echo "Cet utilisateur n'existe pas<br />";
mysqli_close($link);
?>
<html><body>
<br />
<a href="main_admin.php">Retour</a><br />
<a href="logout_admin.php">Se déconnecter</a><br />
</body></html>