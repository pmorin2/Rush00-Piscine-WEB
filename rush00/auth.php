<?php
function auth($login, $passwd)
{
	$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
	if (!empty($login) && !empty($passwd))
	{
		$passwd = hash("whirlpool", $passwd);
		$res = mysqli_query($link, "SELECT login FROM passwd WHERE login = '".mysqli_real_escape_string($link, $_POST["login"])."' AND passwd = '".mysqli_real_escape_string($link, $passwd)."';");
		$result = mysqli_fetch_array($res);
		if (!empty($result))
		{
			mysqli_close($link);
			return true;
		}
	}
	mysqli_close($link);
	return false;
}
?>