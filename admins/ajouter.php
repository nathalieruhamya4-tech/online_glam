<?php
session_start();
require __DIR__. "/../includes/connexion.php";
if(!isset($_SESSION['admin'])){ header("Location: login.php"); exit; }

if(isset($_POST['ajouter'])){
  $nom = $_POST['nom'];
  $prix = $_POST['prix'];
  $desc = $_POST['description'] ?? '';
  $cat = $_POST['categorie'] ?? 'bijoux';
  $photoName = "";

  if(!empty($_FILES['photo']['name'])){
    $photoName = time() . "_" . basename($_FILES['photo']['name']);
    $dir = __DIR__. "/../images/";
    if(!is_dir($dir)){ mkdir($dir, 0777, true); }
    move_uploaded_file($_FILES['photo']['tmp_name'], $dir . $photoName);
  }

  $stmt = $conn->prepare("INSERT INTO produits (nom, prix, photo, description, categorie) VALUES (:nom, :prix, :photo, :des, :cat)");
  $stmt->execute([
    'nom' => $nom,
    'prix' => $prix,
    'photo' => $photoName,
    'des' => $desc,
    'cat' => $cat
  ]);
  header("Location: dashboard.php");
  exit;
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Ajouter</title>
<style>body{background:#fff0f5; font-family:Arial; padding:20px} .box{background:white; max-width:500px; margin:auto; padding:25px; border-radius:12px}
input,textarea,select{width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ddd; box-sizing:border-box}
button{background:#e91e8c; color:white; padding:12px; border:none; width:100%; border-radius:8px; font-weight:bold}
</style></head><body>
<div class="box">
<h2 style="color:#e91e8c">Ajouter un produit</h2>
<a href="dashboard.php">← Retour</a><br><br>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="nom" placeholder="Nom" required>
<input type="number" step="0.01" name="prix" placeholder="Prix $" required>
<select name="categorie" required>
<option value="bijoux">Bijoux</option>
<option value="maquillage">Maquillage</option>
<option value="parfum">Parfum</option>
<option value="lingerie">Lingerie</option>
<option value="nuisettes">Nuisettes</option>
<option value="essuie">Essuie-main / bain</option>
</select>
<textarea name="description" placeholder="Description"></textarea>
<input type="file" name="photo" accept="image/*">
<button type="submit" name="ajouter">Ajouter</button>
</form>
</div></body></html>