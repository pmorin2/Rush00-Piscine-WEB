<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
$res2 = mysqli_query($link, "DELETE FROM commandes_desc WHERE id ='".mysqli_real_escape_string($link, $_GET["id"])."';");
if ($res2 === true)
{
	mysqli_close($link);
	header('Location: commandes.php');
}
else
	echo "ERROR\n";
mysqli_close($link);
?>
<html><body>
<br />
<a href="main_admin.php">Retour</a><br />
<a href="logout_admin.php">Se déconnecter</a><br />
</body></html>