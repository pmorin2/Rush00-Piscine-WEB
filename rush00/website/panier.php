<?php
session_start();
?>
<html><head>
	<title>Aminzon</title>
	<style>
body {white-space: nowrap; background-color: gray; padding-top: 68px;}
div.header {height: 68px; width: 100%; top: 0; left: 0; position: fixed; background-color: orange;}
div.bordure {border-bottom: 2px solid black; margin-top: -35px;}
div.bordure_b {border-bottom: 2px solid black;}

.example_c {
color: black !important;
text-decoration: none;
background: darkgray;
padding: 5px;
display: inline-block;
transition: all 0.4s ease 0s;
margin-top: -5px;
}
.add {border: 2px solid black !important;}
.example_c:hover {
color: #ffffff !important;
background: black;
border-color: black !important;
transition: all 0.4s ease 0s;
}
div.panier {text-align: right; margin-right: -3px; float: right;}
a.panier {padding: 5px 15px; font-size: 20px; font-weight: bold; border: 3px solid black; width: 170px; text-align: center;}
div.val_panier {text-align: right; margin-right: -3px; float: right;}
a.val_panier {padding: 5px 15px; font-size: 20px; font-weight: bold; border: 3px solid black; width: 170px; text-align: center;}
div.retour {text-align: left; margin-left: -3px;}
a.retour {padding: 5px 15px; font-size: 20px; font-weight: bold; border: 3px solid black; width: 95px; text-align: center;}

div.deco {text-align: left; margin-left: -3px;}
a.deco {padding: 5px 15px; font-size: 20px; font-weight: bold; border: 3px solid black; width: 95px; text-align: center;}

p.recapt_panier {font-size: 30px; font-weight: bold;}
p.recap_panier {font-size: 30px; font-weight: bold; margin-top: -10px; margin-bottom: 0px;}
}
	</style>
</head>
<body>
	<div class="header">
		<div class="button_cont panier" align="center"><a class="example_c panier" href="delete_panier.php" rel="nofollow noopener">supprimer le panier</a></div>
		<div class="button_cont retour" align="center"><a class="example_c retour" href="main.php" rel="nofollow noopener">accueil</a></div>
<?php
if ($_SESSION["loggued_on_user"] == "")
{
?>
<div class="button_cont deco" align="center"><a class="example_c deco" href="../index.html" rel="nofollow noopener">conexion</a></div>
<?php
}
else
{
?>
<div class="button_cont val_panier" align="center"><a class="example_c val_panier" href="check_panier.php" rel="nofollow noopener">valider le panier</a></div>
<div class="button_cont deco" align="center"><a class="example_c deco" href="logout.php" rel="nofollow noopener">déconexion</a></div>
<?php
}
?>
	</div>
	<p class ='recapt_panier'>recapitulatif du panier :</p><br />
	<div class="bordure"></div><br />
</body></html>
<?php
$val_tot = 0;
if (!empty($_SESSION["panier"]))
{
	foreach ($_SESSION["panier"] as $value) 
	{
		$val_tot += ($value["price"] * $value["nbr"]);
		echo "<p class ='recap_panier'>".$value["name"]." | nombre: ".$value["nbr"]." | prix à l'unité: ".$value["price"]."€</p><br />";
	}
}
else
	echo "<p class ='recap_panier'>empty</p><br />";
echo "<div class='bordure_b'></div><br />";
echo "<p class='recap_panier'>prix total: ".$val_tot."€</p><br />";
?>