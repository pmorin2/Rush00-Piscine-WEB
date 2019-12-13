<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());

	$res = mysqli_query($link, "SELECT * FROM commandes_desc;");
	if ($res == false)
		echo "Erreur de lecture<br>";
	while ($result = mysqli_fetch_array($res))
	{
?>
<html><body>
	<?php $nom = mysqli_fetch_array(mysqli_query($link, "SELECT name FROM products WHERE id ='".mysqli_real_escape_string($link, $result["id_prod"])."';"));
	echo ($nom["name"]);?>
	<button onclick="window.location.href='delete_commandes_prod.php?id=<?php echo mysqli_real_escape_string($link, $result["id"]);?>';">Supprimer cette élément</button>
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