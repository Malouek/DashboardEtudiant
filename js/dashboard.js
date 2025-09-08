
        // Navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');
            const contentSections = {
                'dashboard': document.getElementById('dashboard-content'),
                'courses': document.getElementById('courses-content'),
                'notes': document.getElementById('notes-content'),
                'software': document.getElementById('software-content'),
                'modules': document.getElementById('modules-content')
            };

            // Handle navigation clicks
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all nav links
                    navLinks.forEach(navLink => navLink.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Hide all content sections
                    Object.values(contentSections).forEach(section => {
                        if (section) section.classList.add('hidden');
                    });
                    
                    // Show selected content section
                    const sectionName = this.getAttribute('data-section');
                    const targetSection = contentSections[sectionName];
                    if (targetSection) {
                        targetSection.classList.remove('hidden');
                    }
                });
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            let searchTimeout;
            
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    const searchTerm = this.value.toLowerCase();
                    console.log('Recherche:', searchTerm);
                    // Ici vous pouvez implémenter la logique de recherche
                }, 300);
            });

            // Module card interactions
            const moduleCards = document.querySelectorAll('.module-card');
            moduleCards.forEach(card => {
                card.addEventListener('click', function() {
                    console.log('Module cliqué:', this.querySelector('.module-title').textContent);
                    // Ici vous pouvez ajouter la logique d'ouverture du module
                });
            });

            // Activity actions
            const actionBtns = document.querySelectorAll('.action-btn');
            actionBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    console.log('Action cliquée');
                    // Logique pour les actions (voir, télécharger, etc.)
                });
            });

            // Add content buttons
            const addBtns = document.querySelectorAll('.add-btn, .primary-btn');
            addBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log('Ajouter nouveau contenu');
                    // Logique pour ajouter du contenu
                });
            });

            // Smooth animations for hover effects
            const cards = document.querySelectorAll('.stat-card, .module-card, .activity-item');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });

        // Utility functions
        function showNotification(message, type = 'info') {
            // Simple notification system
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: ${type === 'success' ? '#16a34a' : type === 'error' ? '#dc2626' : '#2563eb'};
                color: white;
                padding: 12px 24px;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                z-index: 1000;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }

        // Example usage for future features
        function simulateDataLoad() {
            showNotification('Données chargées avec succès', 'success');
        }

        function simulateError() {
            showNotification('Erreur lors du chargement', 'error');
        }
 