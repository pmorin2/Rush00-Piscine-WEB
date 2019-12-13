<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());

if (!empty($_POST["name"])
	&& !empty($_POST["description"])
	&& !empty($_POST["pic"])
	&& !empty($_POST["price"])
	&& !empty($_POST["stock"]))
{

	$res = mysqli_query($link, "INSERT INTO products (name, description, pic, price, stock) VALUES (
		'".mysqli_real_escape_string($link, $_POST["name"]).
		"', '".mysqli_real_escape_string($link, $_POST["description"]).
		"', '".mysqli_real_escape_string($link, $_POST["pic"]).
		"', '".mysqli_real_escape_string($link, $_POST["price"]).
		"', '".mysqli_real_escape_string($link, $_POST["stock"]).
		"');");
	if ($res === true)
	{
		mysqli_close($link);
		header('Location: main_admin.php');
	}
	else
		echo "Erreur dans l'ajout du produit<br>";
}
else
	echo "Erreur dans l'ajout du produit<br>";
mysqli_close($link);
?>
<html><body>
<a href="main_admin.php">Retour</a><br />
<a href="logout_admin.php">Se déconnecter</a><br />
</body></html>