<?php
session_start();
require __DIR__. "/../includes/connexion.php";


if (isset($_SESSION['admin']) && isset($_SESSION['admin_id'])) {
    try {
    
    } catch (Exception $e) {

    }
}

// 1. On vide la session
$_SESSION = [];
$_SESSION['admin'] = null;
unset($_SESSION['admin']);
unset($_SESSION['admin_id']);

// 2. On détruit la session côté serveur
session_unset();
session_destroy();

// 3. On supprime le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Redirection vers login
header("Location: login.php");
exit;