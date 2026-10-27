<?php
session_start();
require __DIR__. "/../includes/connexion.php";
if(!isset($_SESSION['admin'])){ header("Location: login.php"); exit; }

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM produits WHERE id_produits = :id LIMIT 1");
$stmt->execute(['id' => $id]);
$p = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$p){ die("Produit non trouvé"); }

if(isset($_POST['modifier'])){
  $nom = $_POST['nom'];
  $prix = $_POST['prix'];
  $desc = $_POST['description'];
  $cat = $_POST['categorie'];
  $photoName = $p['photo'];

  if(!empty($_FILES['photo']['name'])){
    $photoName = time() . "_" . basename($_FILES['photo']['name']);
    $target = __DIR__. "/../images/" . $photoName;
    if(!is_dir(__DIR__. "/../images")){ mkdir(_DIR_ . "/../images", 0777, true); }
    move_uploaded_file($_FILES['photo']['tmp_name'], $target);
  }

  $stmt = $conn->prepare("UPDATE produits SET nom=:nom, prix=:prix, photo=:photo, description=:desc, categorie=:cat WHERE id=:id OR id_produit=:id OR id_product=:id");
  $stmt->execute([
    'nom'=>$nom, 'prix'=>$prix, 'photo'=>$photoName, 'desc'=>$desc, 'cat'=>$cat, 'id'=>$id
  ]);
  header("Location: dashboard.php");
  exit;
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Modifier</title>
<style>body{background:#fff0f5; font-family:Arial; padding:20px} .box{background:white; max-width:500px; margin:auto; padding:25px; border-radius:12px}
input,textarea,select{width:100%; padding:10px; margin:8px 0; border-radius:8px; border:1px solid #ddd; box-sizing:border-box}
button{background:#2196F3; color:white; padding:12px; border:none; width:100%; border-radius:8px; font-weight:bold}
</style></head><body>
<div class="box">
<h2 style="color:#e91e8c">Modifier produit</h2>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="nom" value="<?= htmlspecialchars($p['nom']) ?>" required>
<input type="number" step="0.01" name="prix" value="<?= $p['prix'] ?>" required>
<select name="categorie">
<option value="<?= $p['categorie'] ?>"><?= $p['categorie'] ?></option>
<option value="bijoux">bijoux</option>
<option value="maquillage">maquillage</option>
<option value="parfum">parfum</option>
<option value="lingerie">lingerie</option>
<option value="nuisettes">nuisettes</option>
<option value="essuie">essuie-main / bain</option>
</select>
<textarea name="description"><?= htmlspecialchars($p['description']) ?></textarea>
<p>Photo actuelle: <?php if($p['photo']) echo "<img src='../images/".$p['photo']."' width='80'>"; ?></p>
<input type="file" name="photo">
<button type="submit" name="modifier">Enregistrer</button>
</form>
</div></body></html>