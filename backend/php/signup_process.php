<?php
// signup_process.php
session_start();
require_once "dbconnect.php"; // fichier de connexion MySQL

// Récupérer la connexion PDO
$db = new DBConnect();
$pdo = $db->getConnexion();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupérer et nettoyer les données du formulaire
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    // Vérifications côté serveur
    if (empty($username) || strlen($username) < 3) {
        header("Location: /study/DashboardEtudiant/signup.php?error=Nom d'utilisateur invalide (3 caractères min)");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: /study/DashboardEtudiant/signup.php?error=Email invalide");
        exit();
    }

    if (strlen($password) < 6) {
        header("Location: /study/DashboardEtudiant/signup.php?error=Mot de passe trop court (6 caractères min)");
        exit();
    }

    if ($password !== $confirmPassword) {
        header("Location: /study/DashboardEtudiant/signup.php?error=Les mots de passe ne correspondent pas");
        exit();
    }

    // Vérifier si le pseudo existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        header("Location: /study/DashboardEtudiant/signup.php?error=Ce nom d'utilisateur est déjà pris");
        exit();
    }

    // Vérifier si l'email existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        header("Location: /study/DashboardEtudiant/signup.php?error=Cet email est déjà utilisé");
        exit();
    }

    // Hasher le mot de passe
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insérer l'utilisateur
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
    $success = $stmt->execute([$username, $email, $hashedPassword, "USER"]);

    if ($success) {
        header("Location: /study/DashboardEtudiant/signup.php?success=Inscription réussie ! Vous pouvez vous connecter");
        exit();
    } else {
        header("Location: /study/DashboardEtudiant/signup.php?error=Erreur lors de l'inscription");
        exit();
    }
}
?>
