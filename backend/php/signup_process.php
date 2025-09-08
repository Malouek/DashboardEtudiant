<?php
// signup_process.php
session_start();
require_once "db.php"; // fichier de connexion MySQL

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Vérifications
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=Email invalide");
        exit();
    }

    if (strlen($password) < 6) {
        header("Location: signup.php?error=Mot de passe trop court (6 caractères min)");
        exit();
    }

    if ($password !== $confirmPassword) {
        header("Location: signup.php?error=Les mots de passe ne correspondent pas");
        exit();
    }

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        header("Location: signup.php?error=Cet email est déjà utilisé");
        exit();
    }

    // Hasher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insérer l'utilisateur
    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
    $success = $stmt->execute([$email, $hashedPassword, "USER"]);

    if ($success) {
        header("Location: signup.php?success=Inscription réussie ! Vous pouvez vous connecter");
    } else {
        header("Location: signup.php?error=Erreur lors de l'inscription");
    }
}
