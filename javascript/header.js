// Gestion de l'ouverture/fermeture du menu
document.addEventListener('DOMContentLoaded', function() {
    const profileBtn = document.getElementById('profileBtn');
    const menuDropdown = document.getElementById('menuDropdown');
    
    // État du menu
    let isMenuOpen = false;
    
    // Fonction pour ouvrir le menu
    function openMenu() {
        // Calculer la position top du menu en fonction de la position du bouton profil
        const profileBtnRect = profileBtn.getBoundingClientRect();
        const menuTop = profileBtnRect.bottom + 10; // 10px d'espace sous le profil
        
        // Positionner le menu avec position fixed, collé au bord droit
        menuDropdown.style.top = `${menuTop}px`;
        menuDropdown.style.right = '0';
        
        menuDropdown.classList.add('active');
        isMenuOpen = true;
    }
    
    // Fonction pour fermer le menu
    function closeMenu() {
        menuDropdown.classList.remove('active');
        isMenuOpen = false;
    }
    
    // Toggle du menu au clic sur le bouton profil
    if (profileBtn) {
        profileBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            if (isMenuOpen) {
                closeMenu();
            } else {
                openMenu();
            }
        });
    }
    
    // Fermer le menu en cliquant en dehors
    document.addEventListener('click', function(e) {
        if (isMenuOpen && !menuDropdown.contains(e.target) && !profileBtn.contains(e.target)) {
            closeMenu();
        }
    });
    
    // Fermer le menu avec la touche Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            closeMenu();
        }
    });
    
    // Gestion du scroll pour le header fixe
    let lastScroll = 0;
    const header = document.querySelector('.header-fixed');
    
    if (header) {
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
            
            lastScroll = currentScroll;
        });
    }
});

