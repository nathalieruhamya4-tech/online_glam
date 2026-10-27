<?php>
require __DIR__. "/../includes/connexion.php";
$conn->exec("DELETE FROM admins WHERE username='admin'");
$hash = password_hash("glams2024", PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (:u, :p)");
$stmt->execute(['u' => 'admin', 'p' => $hash]);

echo "Admin créé !<br>";
echo "Login: admin<br>";
echo "Mot de passe: glams2024<br>";
echo "Hash: $hash<br><br>";
echo "<a href='login.php'>Aller au login</a>";
?>