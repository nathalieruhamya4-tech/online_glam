<?php
session_start();
require __DIR__."/../includes/connexion.php";

if(isset($_SESSION['admin'])){
  header("Location: dashboard.php");
  exit;
}

if(isset($_POST['login'])){
  $user = $_POST['username'];
  $pass = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username");
  $stmt->execute(['username' => $user]);
  $admin = $stmt->fetch(PDO::FETCH_ASSOC);

  if($admin && password_verify($pass, $admin['password'])){
    $_SESSION['admin'] = $admin['username'];
    header("Location: dashboard.php");
    exit;
  } else {
    $erreur = "Login ou mot de passe incorrect";
  }
}
?>
<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Admin Login</title>
<style>body{background:#ffeef2; font-family:Arial; display:flex; justify-content:center; align-items:center; height:100vh}
.box{background:white; padding:30px; border-radius:15px; width:320px; box-shadow:0 5px 20px rgba(0,0,0,0.1)}
input{width:100%; padding:11px; margin:10px 0; border-radius:8px; border:1px solid #ddd; box-sizing:border-box}
button{width:100%; padding:12px; background:#e91e8c; color:white; border:none; border-radius:8px; font-weight:bold; cursor:pointer}
</style></head><body>
<div class="box">
  <h2 style="text-align:center; color:#e91e8c">On Line Glams - Admin</h2>
  <?php if(isset($erreur)) echo "<p style='color:red; text-align:center'>$erreur</p>"; ?>
  <form method="POST">
    <input type="text" name="username" placeholder="admin" required>
    <input type="password" name="password" placeholder="glams2024" required>
    <button type="submit" name="login">Se connecter</button>
  </form>
</div>
</body></html>
