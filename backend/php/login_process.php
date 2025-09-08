<?php
// login_process.php
session_start();
require_once "dbconnect.php"; // fichier de connexion MySQL

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?error=Email invalide");
        exit();
    }

    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT id, email, password, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        // Connexion réussie → on crée une session
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["email"]   = $user["email"];
        $_SESSION["role"]    = $user["role"];

        // Redirection en fonction du rôle
        if ($user["role"] === "AdminDash") {
            header("Location: admin_dashboard.php?success=Bienvenue Admin");
        } else {
            header("Location: dashboard.php?success=Connexion réussie");
        }
        exit();
    } else {
        header("Location: login.php?error=Email ou mot de passe incorrect");
        exit();
    }
}
