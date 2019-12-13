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
	$res = mysqli_query($link, "UPDATE products SET 
		name = '".mysqli_real_escape_string($link, $_POST["name"])."', 
		description = '".mysqli_real_escape_string($link, $_POST["description"])."', 
		pic = '".mysqli_real_escape_string($link, $_POST["pic"])."', 
		price = '".mysqli_real_escape_string($link, $_POST["price"])."', 
		stock = '".mysqli_real_escape_string($link, $_POST["stock"])."';");
	if ($res === true)
	{
		mysqli_close($link);
		header('Location: modif_product_admin.php');
	}
	else
		echo "Erreur dans la modification du produit<br>";
}
else if (!empty($_GET["id"]) && empty($_GET["check"]))
{
	$res = mysqli_query($link, "SELECT * FROM products WHERE id ='".mysqli_real_escape_string($link, $_GET["id"])."';");
	if ($res == false)
		echo "Erreur de lecture<br>";
	else
	{
		$result = mysqli_fetch_array($res);
		header('Location: modif_elem_admin.php?name='.$result["name"].'&description='.$result["description"].'&pic='.$result["pic"].'&price='.$result["price"].'&stock='.$result["stock"].'&check=OK');
		mysqli_close($link);
	}
}
else
{
?>
<html><body>
<form action="modif_elem_admin.php?id=<?php echo $_GET['id']; ?>" method="post">
	Nom du produit: <input type="text" name="name" value="<?php if (!empty($_GET['name'])) echo $_GET['name']; ?>"/>
	<br />
	Description: <input type="text" name="description" value="<?php if (!empty($_GET['description'])) echo $_GET['description']; ?>"/>
	<br />
	Adresse image: <input type="text" name="pic" value="<?php if (!empty($_GET['pic'])) echo $_GET['pic']; ?>"/>
	<br />
	Prix: <input type="number" name="price" value="<?php if (!empty($_GET['price'])) echo $_GET['price']; ?>"/>
	<br />
	Stock: <input type="number" name="stock" value="<?php if (!empty($_GET['stock'])) echo $_GET['stock']; ?>"/>
	<input type="submit" name="submit" value="OK"/>
</form>
<br />
</body></html>
<?php
}
?>
<html><body>
<a href="modif_product_admin.php">Retour</a><br />
<a href="logout_admin.php">Se déconnecter</a><br />
</body></html>