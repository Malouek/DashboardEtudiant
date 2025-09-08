<?php
// signup.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA Dashboard - Inscription</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <!-- Background Animation -->
    <div class="bg-animation"></div>
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>

    <!-- Signup Container -->
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <div class="logo">Study Dashboard</div>
            <p class="subtitle">Inscrivez-vous pour accéder à votre espace</p>
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

        <!-- Signup Form -->
        <form class="login-form" id="signupForm" action="backend/php/signup_process.php" method="POST">
            
         <div class="form-group">
                <label class="form-label" for="username">Nom d'utilisateur</label>
                <input 
                    type="text" 
                    id="username" 
                    name="username"
                    class="form-input" 
                    placeholder="votre nom d'utilisateur"
                    required
                >
            </div>
        
        
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

            <div class="form-group">
                <label class="form-label" for="confirmPassword">Confirmer le mot de passe</label>
                <div class="password-container">
                    <input 
                        type="password" 
                        id="confirmPassword" 
                        name="confirmPassword"
                        class="form-input" 
                        placeholder="••••••••"
                        required
                    >
                </div>
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">
                <span id="btnText">S'inscrire</span>
            </button>
        </form>

        <!-- Footer -->
        <div class="login-footer">
            <p class="signup-link">
                Déjà un compte ? <a href="login.php">Se connecter</a>
            </p>
        </div>
    </div>
</body>
</html>
