<?php
//header("Location: index.html");
$error = true;
$link = mysqli_connect("localhost", "root", "root02", "rush00") or die('Error : '.mysql_error());
if ($_POST["submit"] == "OK")
{
	if (!empty($_POST["login"]) && !empty($_POST["passwd"]))
	{
		$res = mysqli_query($link, "SELECT login FROM passwd WHERE login = '".mysqli_real_escape_string($link, $_POST["login"])."';");
		$result = mysqli_fetch_array($res);

		if (empty($result))
			$error = false;
	}
	if ($error == false)
	{
		$res = mysqli_query($link, "INSERT INTO passwd (login, passwd) VALUE ('".mysqli_real_escape_string($link, $_POST["login"])."', '".hash("whirlpool", mysqli_real_escape_string($link, $_POST["passwd"]))."');");
		if ($res === true)
		{
			mysqli_close($link);
			header('Location: index.html');
		}
		else
			$error = true;
	}
}
else
	$error = true;
if ($error == true)
	echo "ERROR\n";
mysqli_close($link);
?>
<html><body>
<a href="index.html">Retour</a><br />
</body></html>