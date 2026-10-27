<?php
session_start();
require __DIR__. "/../includes/connexion.php";
if(!isset($_SESSION['admin'])){ header("Location: login.php"); exit; }

$produits = $conn->query("SELECT * FROM produits ORDER BY 1 DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Dashboard</title>
<style>
body{font-family:Arial; background:#fff0f5; padding:20px}
table{width:100%; background:white; border-collapse:collapse; border-radius:10px; overflow:hidden}
th,td{padding:12px; border-bottom:1px solid #eee; text-align:left}
th{background:#e91e8c; color:white}
.btn{padding:6px 12px; border-radius:6px; text-decoration:none; color:white; display:inline-block}
.edit{background:#2196F3} .del{background:#f44336} .add{background:#e91e8c; padding:10px 20px; margin-bottom:15px}
img{width:60px; height:60px; object-fit:cover; border-radius:8px}
.top{display:flex; justify-content:space-between; align-items:center}
</style></head><body>
<div class="top">
<h2 style="color:#e91e8c">On Line Glams - Dashboard</h2>
<div>Connectée: <b><?= $_SESSION['admin'] ?></b> | <a href="logout.php">Déconnexion</a></div>
</div>

<a href="ajouter.php" class="btn add">+ Ajouter un produit</a>

<?php if(count($produits) == 0): ?>
<p style="text-align:center; margin-top:40px; color:#888">Aucun produit ajouté pour le moment. Clique sur "Ajouter un produit".</p>
<?php else: ?>
<table>
<tr><th>Photo</th><th>Nom</th><th>Prix</th><th>Catégorie</th><th>Actions</th></tr>
<?php foreach($produits as $p): 
  $id = $p['id'] ?? $p['id_produit'] ?? $p['id_product'] ?? $p['ID'] ?? 0;
?>
<tr>
<td><?php if(!empty($p['photo'])) echo "<img src='../images/".htmlspecialchars($p['photo'])."'>"; ?></td>
<td><?= htmlspecialchars($p['nom'] ?? $p['name']) ?></td>
<td><?= htmlspecialchars($p['prix'] ?? $p['price']) ?> $</td>
<td><?= htmlspecialchars($p['categorie'] ?? $p['category'] ?? '-') ?></td>
<td>
<a href="modifier.php?id=<?= $id ?>" class="btn edit">Modifier</a>
<a href="suprimer.php?id=<?= $id ?>" class="btn del" onclick="return confirm('Supprimer ce produit?')">Supp</a>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
</body></html>