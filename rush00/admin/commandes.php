<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());

	$res = mysqli_query($link, "SELECT * FROM commandes;");
	if ($res == false)
		echo "Erreur de lecture<br>";
	while ($result = mysqli_fetch_array($res))
	{
?>
<html><body>
	<?php echo "commande numero ".$result["id"]." de ".$result["name"];?>
	<button onclick="window.location.href='modif_commandes.php?id=<?php echo mysqli_real_escape_string($link, $result["id"]);?>';">Modifier cette commande</button>
	<button onclick="window.location.href='delete_commandes.php?id=<?php echo mysqli_real_escape_string($link, $result["id"]);?>';">Supprimer cette commande</button>
<br />
</body></html>
<?php
	}
mysqli_close($link);
?>
<html><body>
<br />
<a href="main_admin.php">Retour</a><br />
<a href="logout_admin.php">Se déconnecter</a><br />
</body></html>