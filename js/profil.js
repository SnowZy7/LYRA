// Gestion des onglets de navigation
document.addEventListener('DOMContentLoaded', function() {
    const navTabs = document.querySelectorAll('.nav-tab');
    const tabContents = document.querySelectorAll('.tab-content');

    navTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');

            // Retirer la classe active de tous les onglets et contenus
            navTabs.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Ajouter la classe active à l'onglet cliqué et au contenu correspondant
            this.classList.add('active');
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });

    // Gestion du bouton "Voir plus" / "Voir moins"
    const seeMoreBtn = document.getElementById('seeMoreBtn');
    const hiddenBadges = document.querySelectorAll('.hidden-badges');

    if (seeMoreBtn && hiddenBadges.length > 0) {
        seeMoreBtn.addEventListener('click', function() {
            const isShowing = hiddenBadges[0].classList.contains('show');

            if (isShowing) {
                // Cacher les badges
                hiddenBadges.forEach(badge => {
                    badge.classList.remove('show');
                });
                seeMoreBtn.textContent = 'Voir plus';
            } else {
                // Afficher les badges
                hiddenBadges.forEach(badge => {
                    badge.classList.add('show');
                });
                seeMoreBtn.textContent = 'Voir moins';
            }
        });
    }
});

