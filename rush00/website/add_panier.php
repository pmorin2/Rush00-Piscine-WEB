<?php
session_start();
header('Location: main.php');
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
$found = false;
if (!empty($_SESSION["panier"]))
{
	foreach ($_SESSION["panier"] as $key => $value)
	{
		if ($value["id"] == $_GET["id"])
		{
			$found = true;
			$_SESSION["panier"][$key]["nbr"]++;
		}
	}
}
if ($found == false)
{
	$res = mysqli_query($link, "SELECT name, price FROM products WHERE id = ".mysqli_real_escape_string($link, $_GET["id"]).";");
	$result = mysqli_fetch_array($res);
	$new_ar = array("id" => $_GET["id"], "name" => $result["name"], "nbr" => 1, "price" => $result["price"]);
	$_SESSION["panier"][] = $new_ar;
}
mysqli_close($link);
?>