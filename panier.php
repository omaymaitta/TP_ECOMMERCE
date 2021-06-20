<?php session_start(); 

$ref=$_GET['id'];
$qte=$_GET['qte'];
$_SESSION['panier'][$ref]=$qte;

?>