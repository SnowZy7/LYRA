document.addEventListener('DOMContentLoaded', () => {
    const profileBtn = document.getElementById('profileBtn');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const leftMenu = document.querySelector('.left-menu');
    const header = document.querySelector('.header');

    // Dropdown profil
    if (profileBtn && dropdownMenu) {
        profileBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('active');
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.profile-menu')) {
                dropdownMenu.classList.remove('active');
            }
        });
    }

    // Réglages d'affichage des labels
    function setupLeftMenuHover() {
        if (!leftMenu) return;

        const items = leftMenu.querySelectorAll('.menu-item');

        items.forEach(item => {
            item.addEventListener('mouseenter', showLabels);
            item.addEventListener('focusin', showLabels);
            item.addEventListener('mouseleave', hideLabels);
        });

        leftMenu.addEventListener('mouseleave', hideLabels);
        leftMenu.addEventListener('focusout', (e) => {
            if (!leftMenu.contains(e.relatedTarget)) {
                hideLabels();
            }
        });
    }

    function showLabels() {
        leftMenu.classList.add('show-labels');
    }

    function hideLabels() {
        leftMenu.classList.remove('show-labels');
    }

    // Initialisation (plus de repositionnement dynamique pour éviter les sauts)
    window.addEventListener('load', () => {
        setupLeftMenuHover();
    });
});