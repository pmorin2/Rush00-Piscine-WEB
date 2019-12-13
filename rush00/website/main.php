<?php
session_start();
?>
<html><head>
	<title>Aminzon</title>
	<style>
	body {white-space: nowrap; background-color: gray;}
		.divp {float: left; height: 500px; width: 300px; margin-left: 100px; margin-top: 68px;}
		img {width: 300px; height: 300px;}
		H1 {font-size: 25px; text-align: center; line-height: 50px; border: 5px solid black; background-color: lightgray;}
		p {font-size: 15px; text-align: center;line-height: 25px; border: 2px solid black; background-color: lightgray; white-space: pre-line}
		.prix {width: 100px; margin-left: auto; margin-right: auto; margin-top: -8px; background-color: lightgray;}

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
div.bordure {border-bottom: 2px solid black; margin-top: 25px;}
div.header {height: 68px; width: 100%; top: 0; left: 0; position: fixed; background-color: orange;}
div.panier {text-align: right; margin-right: -3px; float: right;}
a.panier {padding: 5px 15px; font-size: 20px; font-weight: bold; border: 3px solid black; width: 170px; text-align: center;}
div.retour {text-align: left; margin-left: -3px;}
a.retour {padding: 5px 15px; font-size: 20px; font-weight: bold; border: 3px solid black; width: 95px; text-align: center;}
div.deco {text-align: left; margin-left: -3px;}
a.deco {padding: 5px 15px; font-size: 20px; font-weight: bold; border: 3px solid black; width: 95px; text-align: center;}
ul
{
	background-color: darkgray;
	display: inline-block;
	left: 230px;
	top: -1px;
	padding: 0px;
	float: none;
}

ul ul
{
	visibility: hidden;
	opacity: 0;
	position: absolute;
	transition: all 1s;
}

li
{
	list-style-type: none;
	position: relative;
	width: 225px;
	padding: 2px;
	margin: 0px;
}

#menu1 {text-align: right; margin-left: 67px; position: fixed; margin-top: 32px;}
#menu2 {width: 200px; border: 3px solid black; padding: 5px 0px 0px 3px; margin-left: -27px; margin-top: -2px;}
#choose1 {padding: 4px 15px; font-size: 20px; font-weight: bold; border: 3px solid black; width: 170px; text-align: center;}
div.menu {text-align: left; margin-left: -3px;}
a.menu {padding: 5px 15px; font-size: 20px; font-weight: bold; width: 173px; text-align: center;}
li:hover
{
	background-color: black;
	color: white;
}

li:hover #menu2
{
	visibility: visible;
	opacity: 1;
}
	</style>
</head>
<body>
	<div class="header">
		<div class="button_cont panier" align="center"><a class="example_c panier" href="panier.php" rel="nofollow noopener">afficher le panier</a></div>
		<?php
		$link = mysqli_connect("localhost", "root", 'root02', "rush00") or die('Error : '.mysql_error());
		$res = mysqli_query($link, "SELECT * FROM categories;");
		?>
		<UL id="menu1">
			<LI id="choose1">
				trier par catégorie:
				<UL id="menu2">
					<?php
					while ($result = mysqli_fetch_array($res))
						{
					?>
						<div class="button_cont menu" align="center"><a class="example_c menu" href="main.php?sort=<?php echo $result['name']; ?>" rel="nofollow noopener"><?php echo $result['name']; ?></a></div>
					<?php
					}
					?>
				</UL>
			</LI>
		</UL>
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
<div class="button_cont deco" align="center"><a class="example_c deco" href="logout.php" rel="nofollow noopener">déconexion</a></div>
<?php
}
?>
	</div>
</body></html>

<?php
if (empty($_GET["sort"]))
{
	$res = mysqli_query($link, "SELECT * FROM products;");
	while ($result = mysqli_fetch_array($res))
{
?>
<html><body>
	<div class ="divp">
		<H1><?php echo $result["name"];?></H1>
		<img src="<?php echo $result["pic"];?>">
		<p><?php echo $result["description"];?></p>
		<p class ="prix"><?php 
		if ($result["stock"] > 0)
			echo "prix : ".$result["price"]."€";
		else
			echo "Plus en stock";
		?></p>
		<?php 
		if ($result["stock"] != 0)
		{
?>
<html><body>
	<div class="button_cont" align="center"><a class="example_c add" href="add_panier.php?id=<?php echo mysqli_real_escape_string($link, $result["id"]); ?>" rel="nofollow noopener">Ajouter au panier</a></div>
</body></html>
<?php
		}
?>
	<div class="bordure"></div>
	</div>
</body></html>
<?php
}
}
else
{
	$all = mysqli_query($link, "SELECT id_prod FROM prodincat WHERE name_cat = '".mysqli_real_escape_string($link, $_GET["sort"])."';");
	while ($allid = mysqli_fetch_array($all))
	{
		$res = mysqli_query($link, "SELECT * FROM products WHERE id = '".mysqli_real_escape_string($link, $allid['id_prod'])."';");
		while ($result = mysqli_fetch_array($res))
{
?>
<html><body>
	<div class ="divp">
		<H1><?php echo $result["name"];?></H1>
		<img src="<?php echo $result["pic"];?>">
		<p><?php echo $result["description"];?></p>
		<p class ="prix"><?php 
		if ($result["stock"] != 0)
			echo "prix : ".$result["price"]."€";
		else
			echo "Plus en stock";
		?></p>
		<?php 
		if ($result["stock"] != 0)
		{
?>
<html><body>
	<div class="button_cont" align="center"><a class="example_c add" href="add_panier.php?id=<?php echo mysqli_real_escape_string($link, $result["id"]); ?>" rel="nofollow noopener">Ajouter au panier</a></div>
</body></html>
<?php
		}
?>
	<div class="bordure"></div>
	</div>
</body></html>
<?php
}
	}
}

mysqli_close($link);
?>