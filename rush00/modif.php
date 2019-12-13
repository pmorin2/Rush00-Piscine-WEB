<?php
include "auth.php";
$error = true;
$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
if ($_POST["submit"] == "OK")
	if (!empty($_POST["login"]) && !empty($_POST["oldpw"]) && !empty($_POST["newpw"]))
		if (auth($_POST["login"], $_POST["oldpw"]))
			$error = false;

if ($error == false)
{
	$newpw = hash("whirlpool", $_POST["newpw"]);
	$res = mysqli_query($link, "UPDATE passwd SET passwd = '".mysqli_real_escape_string($link, $newpw)."' WHERE login = '".mysqli_real_escape_string($link, $_POST["login"])."' ;");
	if ($res === true)
		{
			mysqli_close($link);
			header('Location: index.html');
		}
		else
			echo "ERROR\n";
}
else
	echo "ERROR\n";
mysqli_close($link);
?>
<html><body>
<br />
<a href="index.html">Retour</a><br />
</body></html>