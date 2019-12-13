<?php
session_start();
if ($_SESSION["loggued_on_user"] != "admin")
	header('Location: ../index.html');
?>
<html><body>
<a href="add_product_admin.html">Ajouter un nouveau produit</a><br />
<a href="modif_product_admin.php">Modifier un produit</a><br />
<br />
<a href="add_categorie_admin.html">Ajouter une nouvelle catégorie</a><br />
<a href="delete_categorie_admin.html">Supprimer une catégorie</a><br />
<br />
<a href="modif_user_admin.html">Modifier un utilisateur</a><br />
<a href="delete_user_admin.html">Supprimer un utilisateur</a><br />
<br />
<a href="commandes.php">Gérer les commandes</a><br />
<br />
<a href="logout_admin.php">Se déconnecter</a><br />
</body></html>