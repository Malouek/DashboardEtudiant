
        // DOM Elements
        const loginForm = document.getElementById('loginForm');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        const passwordToggle = document.getElementById('passwordToggle');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const errorMessage = document.getElementById('errorMessage');
        const successMessage = document.getElementById('successMessage');
        const rememberCheckbox = document.getElementById('remember');

        // Password toggle functionality
        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'password') {
                eyeIcon.style.display = 'block';
                eyeOffIcon.style.display = 'none';
            } else {
                eyeIcon.style.display = 'none';
                eyeOffIcon.style.display = 'block';
            }
        });

        // Input validation
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validatePassword(password) {
            return password.length >= 6;
        }

        function showValidation(input, isValid, errorElement) {
            if (isValid) {
                input.classList.remove('invalid');
                input.classList.add('valid');
                errorElement.classList.remove('show');
            } else {
                input.classList.remove('valid');
                input.classList.add('invalid');
                errorElement.classList.add('show');
            }
        }

        // Real-time validation
        emailInput.addEventListener('blur', function() {
            const isValid = validateEmail(this.value);
            showValidation(this, isValid, document.getElementById('emailError'));
        });

        passwordInput.addEventListener('blur', function() {
            const isValid = validatePassword(this.value);
            showValidation(this, isValid, document.getElementById('passwordError'));
        });

        // Clear validation on focus
        emailInput.addEventListener('focus', function() {
            this.classList.remove('valid', 'invalid');
            document.getElementById('emailError').classList.remove('show');
        });

        passwordInput.addEventListener('focus', function() {
            this.classList.remove('valid', 'invalid');
            document.getElementById('passwordError').classList.remove('show');
        });

        // Hide messages
        function hideMessages() {
            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';
        }

        function showError(message) {
            hideMessages();
            document.getElementById('errorText').textContent = message;
            errorMessage.style.display = 'block';
        }

        function showSuccess(message) {
            hideMessages();
            document.getElementById('successText').textContent = message;
            successMessage.style.display = 'block';
        }

        // Loading state
        function setLoading(isLoading) {
            if (isLoading) {
                submitBtn.disabled = true;
                btnText.innerHTML = '<div class="loading"></div>Connexion...';
            } else {
                submitBtn.disabled = false;
                btnText.textContent = 'Se connecter';
            }
        }

        // Form submission
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = emailInput.value.trim();
            const password = passwordInput.value;
            
            // Validate inputs
            const emailValid = validateEmail(email);
            const passwordValid = validatePassword(password);
            
            showValidation(emailInput, emailValid, document.getElementById('emailError'));
            showValidation(passwordInput, passwordValid, document.getElementById('passwordError'));
            
            if (!emailValid || !passwordValid) {
                showError('Veuillez corriger les erreurs ci-dessus');
                return;
            }

            // Simulate login process
            setLoading(true);
            hideMessages();

            // Demo: simulate different scenarios
            setTimeout(() => {
                if (email === 'demo@example.com' && password === 'demo123') {
                    // Success case
                    showSuccess('Connexion réussie ! Redirection...');
                    
                    // Save remember me preference
                    if (rememberCheckbox.checked) {
                        localStorage.setItem('rememberLogin', 'true');
                        localStorage.setItem('userEmail', email);
                    }
                    
                    // Redirect to dashboard after 2 seconds
                    setTimeout(() => {
                        // Here you would redirect to the dashboard
                        console.log('Redirection vers le dashboard...');
                        // window.location.href = 'dashboard.html';
                    }, 2000);
                    
                } else {
                    // Error case
                    showError('Email ou mot de passe incorrect');
                }
                
                setLoading(false);
            }, 2000);
        });

        // Social login handlers
        document.getElementById('googleLogin').addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Connexion avec Google...');
            showError('Connexion sociale non configurée');
        });

        document.getElementById('githubLogin').addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Connexion avec GitHub...');
            showError('Connexion sociale non configurée');
        });

        // Forgot password handler
        document.querySelector('.forgot-link').addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Mot de passe oublié...');
            showError('Fonctionnalité en cours de développement');
        });

        // Signup link handler
        document.getElementById('signupLink').addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Redirection vers inscription...');
            showError('Page d\'inscription en cours de développement');
        });

        // Load remembered email
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('rememberLogin') === 'true') {
                const savedEmail = localStorage.getItem('userEmail');
                if (savedEmail) {
                    emailInput.value = savedEmail;
                    rememberCheckbox.checked = true;
                }
            }
        });

        // Auto-hide messages after 5 seconds
        function autoHideMessage(element) {
            if (element.style.display === 'block') {
                setTimeout(() => {
                    element.style.display = 'none';
                }, 5000);
            }
        }

        // Observer for message display
        const messageObserver = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                    autoHideMessage(mutation.target);
                }
            });
        });

        messageObserver.observe(errorMessage, { attributes: true });
        messageObserver.observe(successMessage, { attributes: true });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Enter key to submit (when not focused on button)
            if (e.key === 'Enter' && document.activeElement !== submitBtn) {
                e.preventDefault();
                loginForm.dispatchEvent(new Event('submit'));
            }
            
            // Escape key to clear messages
            if (e.key === 'Escape') {
                hideMessages();
            }
        });
