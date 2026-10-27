<?php
session_start();
require __DIR__. "/../includes/connexion.php";
if(!isset($_SESSION['admin'])){ header("Location: login.php"); exit; }

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("DELETE FROM produits WHERE id_produits = :id LIMIT 1");
$stmt->execute(['id' => $id]);

header("Location: dashboard.php");
exit;
?>