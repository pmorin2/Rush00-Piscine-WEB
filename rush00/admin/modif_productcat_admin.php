<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
if (!empty($_GET["id_prod"]))
{
	$res = mysqli_query($link, "SELECT name FROM categories;");
	if ($res == false)
		echo "Erreur de lecture<br>";
	while ($result = mysqli_fetch_array($res))
	{
?>
<html><body>
	<?php echo $result["name"].": " ?>
	<button onclick="window.location.href='add_productcat_admin.php?name_cat=<?php echo mysqli_real_escape_string($link, $result["name"]);?>&id_prod=<?php echo mysqli_real_escape_string($link, $_GET["id_prod"]);?>';">Ajouter</button>
<br />
</body></html>
<?php
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