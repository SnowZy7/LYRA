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

    // Gestion du bouton "Voir plus" des activités
    const activitiesSeeMoreBtn = document.getElementById('activitiesSeeMoreBtn');
    const hiddenActivities = document.querySelectorAll('.hidden-activity');

    if (activitiesSeeMoreBtn && hiddenActivities.length > 0) {
        activitiesSeeMoreBtn.addEventListener('click', function() {
            const isShowing = hiddenActivities[0].classList.contains('show');

            if (isShowing) {
                hiddenActivities.forEach(card => card.classList.remove('show'));
                activitiesSeeMoreBtn.textContent = 'Voir plus';
            } else {
                hiddenActivities.forEach(card => card.classList.add('show'));
                activitiesSeeMoreBtn.textContent = 'Voir moins';
            }
        });
    }

    // Overlay options (bouton "...")
    const profileMenuBtn = document.querySelector('.profile-menu-btn');
    const profileOverlay = document.getElementById('profileOverlay');
    const overlayCloseBtn = document.querySelector('.overlay-close');

    const openOverlay = () => {
        if (!profileOverlay) return;
        profileOverlay.classList.add('show');
        profileOverlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('no-scroll');
    };

    const closeOverlay = () => {
        if (!profileOverlay) return;
        profileOverlay.classList.remove('show');
        profileOverlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('no-scroll');
    };

    if (profileMenuBtn && profileOverlay) {
        profileMenuBtn.addEventListener('click', openOverlay);
    }

    if (overlayCloseBtn) {
        overlayCloseBtn.addEventListener('click', closeOverlay);
    }

    if (profileOverlay) {
        profileOverlay.addEventListener('click', (event) => {
            if (event.target === profileOverlay) {
                closeOverlay();
            }
        });
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && profileOverlay && profileOverlay.classList.contains('show')) {
            closeOverlay();
        }
    });

    // Overlay nouveau post
    const newPostBtn = document.getElementById('newPostBtn');
    const newPostOverlay = document.getElementById('newPostOverlay');
    const newPostClose = document.querySelector('.new-post-close');
    const newPostForm = document.querySelector('.new-post-form');
    const descriptionInput = document.querySelector('.form-textarea');
    const newPostSubmit = document.querySelector('.new-post-submit');
    const newPostStatus = document.getElementById('newPostStatus');
    const mediaDrop = document.getElementById('mediaDrop');
    const mediaInput = document.getElementById('mediaInput');
    const mediaList = document.getElementById('mediaList');
    const tagAddBtn = document.querySelector('.tag-add-btn');
    const tagInput = document.querySelector('.tag-input');
    const tagsArea = document.querySelector('.tags-area');
    const tags = [];
    let mediaFiles = [];

    const openNewPost = () => {
        if (!newPostOverlay) return;
        newPostOverlay.classList.add('show');
        newPostOverlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('no-scroll');
    };

    const closeNewPost = () => {
        if (!newPostOverlay) return;
        newPostOverlay.classList.remove('show');
        newPostOverlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('no-scroll');
    };

    if (newPostBtn && newPostOverlay) {
        newPostBtn.addEventListener('click', openNewPost);
    }

    if (newPostClose) {
        newPostClose.addEventListener('click', closeNewPost);
    }

    if (newPostOverlay) {
        newPostOverlay.addEventListener('click', (event) => {
            if (event.target === newPostOverlay) {
                closeNewPost();
            }
        });
    }

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && newPostOverlay && newPostOverlay.classList.contains('show')) {
            closeNewPost();
        }
    });

    const validateNewPost = () => {
        const hasTags = tags.length > 0;
        const hasDescription = descriptionInput && descriptionInput.value.trim().length > 0;
        if (newPostSubmit) {
            newPostSubmit.disabled = !(hasTags && hasDescription);
        }
        if (newPostStatus) {
            if (!hasTags && !hasDescription) {
                newPostStatus.textContent = 'Ajoute au moins un tag et une description pour publier.';
            } else if (!hasTags) {
                newPostStatus.textContent = 'Ajoute au moins un tag pour publier.';
            } else if (!hasDescription) {
                newPostStatus.textContent = 'Ajoute une description pour publier.';
            } else {
                newPostStatus.textContent = '';
            }
        }
    };

    const renderTags = () => {
        if (!tagsArea) return;
        tagsArea.innerHTML = '';
        if (tags.length === 0) {
            tagsArea.textContent = 'Ajoute un tag pour commencer';
            validateNewPost();
            return;
        }

        tags.forEach((tag, index) => {
            const chip = document.createElement('span');
            chip.className = 'tag-chip';
            chip.textContent = tag;

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'tag-remove';
            removeBtn.setAttribute('aria-label', `Supprimer le tag ${tag}`);
            removeBtn.textContent = '×';
            removeBtn.addEventListener('click', () => {
                tags.splice(index, 1);
                renderTags();
            });

            chip.appendChild(removeBtn);
            tagsArea.appendChild(chip);
        });
        validateNewPost();
    };

    const addTag = () => {
        if (!tagInput) return;
        const value = tagInput.value.trim();
        if (!value) return;
        const exists = tags.some(t => t.toLowerCase() === value.toLowerCase());
        if (exists) {
            tagInput.value = '';
            return;
        }
        tags.push(value);
        tagInput.value = '';
        renderTags();
    };

    if (tagAddBtn) {
        tagAddBtn.addEventListener('click', addTag);
    }

    if (tagInput) {
        tagInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                addTag();
            }
        });
    }

    if (descriptionInput) {
        descriptionInput.addEventListener('input', validateNewPost);
    }

    const formatSize = (bytes) => {
        if (bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return `${(bytes / Math.pow(k, i)).toFixed(1)} ${sizes[i]}`;
    };

    const renderMedia = () => {
        if (!mediaList) return;
        mediaList.innerHTML = '';
        if (mediaFiles.length === 0) return;

        mediaFiles.forEach((file, index) => {
            const li = document.createElement('li');
            li.className = 'media-item';

            const name = document.createElement('span');
            name.className = 'media-name';
            name.textContent = file.name;

            const size = document.createElement('span');
            size.className = 'media-size';
            size.textContent = formatSize(file.size);

            const remove = document.createElement('button');
            remove.type = 'button';
            remove.className = 'media-remove';
            remove.setAttribute('aria-label', `Retirer ${file.name}`);
            remove.textContent = '×';
            remove.addEventListener('click', () => {
                mediaFiles.splice(index, 1);
                renderMedia();
            });

            li.appendChild(name);
            li.appendChild(size);
            li.appendChild(remove);
            mediaList.appendChild(li);
        });
    };

    const handleFiles = (files) => {
        const accepted = Array.from(files).filter(file =>
            file.type.startsWith('image/') ||
            file.type.startsWith('video/') ||
            file.type.startsWith('audio/')
        );
        if (accepted.length === 0) return;
        mediaFiles = [accepted[0]]; // un seul média autorisé
        renderMedia();
    };

    if (mediaDrop && mediaInput) {
        mediaDrop.addEventListener('click', () => mediaInput.click());

        mediaDrop.addEventListener('dragover', (event) => {
            event.preventDefault();
            mediaDrop.classList.add('dragover');
        });

        mediaDrop.addEventListener('dragleave', () => {
            mediaDrop.classList.remove('dragover');
        });

        mediaDrop.addEventListener('drop', (event) => {
            event.preventDefault();
            mediaDrop.classList.remove('dragover');
            if (event.dataTransfer?.files) {
                handleFiles(event.dataTransfer.files);
            }
        });

        mediaInput.addEventListener('change', (event) => {
            const input = event.target;
            if (input.files) {
                handleFiles(input.files);
                input.value = '';
            }
        });
    }

    if (newPostForm) {
        newPostForm.addEventListener('submit', (event) => {
            if (newPostSubmit && newPostSubmit.disabled) {
                event.preventDefault();
                return;
            }
            // Pour l'instant, on empêche l'envoi réel.
            event.preventDefault();
        });
    }

    // État initial
    validateNewPost();
});

