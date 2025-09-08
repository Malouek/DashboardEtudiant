<?php
// login.php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA Dashboard - Connexion</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <!-- Background Animation -->
    <div class="bg-animation"></div>
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>

    <!-- Login Container -->
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <div class="logo">DATA Dashboard</div>
            <p class="subtitle">Connectez-vous pour accéder à votre espace</p>
        </div>

        <!-- Error/Success Messages -->
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message">
                <span><?= htmlspecialchars($_GET['error']) ?></span>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <div class="success-message">
                <span><?= htmlspecialchars($_GET['success']) ?></span>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form class="login-form" id="loginForm" action="login_process.php" method="POST">
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email"
                    class="form-input" 
                    placeholder="votre@email.com"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Mot de passe</label>
                <div class="password-container">
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        class="form-input" 
                        placeholder="••••••••"
                        required
                    >
                </div>
            </div>

            <div class="form-options">
                <label class="checkbox-container">
                    <div class="checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="checkmark"></span>
                    </div>
                    Se souvenir de moi
                </label>
                <a href="#" class="forgot-link">Mot de passe oublié ?</a>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                <span id="btnText">Se connecter</span>
            </button>
        </form>

        <!-- Footer -->
        <div class="login-footer">
            <p class="signup-link">
                Pas encore de compte ? <a href="signup.php">S'inscrire</a>
            </p>
        </div>
    </div>
</body>
</html>
