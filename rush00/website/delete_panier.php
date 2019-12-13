<?php
session_start();
header('Location: panier.php');
$_SESSION["panier"] = NULL;
?>