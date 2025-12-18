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
    const categoryCheckboxes = document.querySelectorAll('.category-option input[type="checkbox"]');
    const categoryOptionsWrap = document.querySelector('.category-options');
    const categoryToggleBtn = document.querySelector('.category-toggle');
    const tagsArea = document.querySelector('.tags-area');
    const ajaxUrl = newPostForm?.dataset.ajaxUrl || '';
    const newPostNonce = newPostForm?.dataset.nonce || '';
    let mediaFiles = [];
    const maxCategories = 3;

    const openNewPost = () => {
        if (!newPostOverlay) return;
        resetNewPostForm();
        newPostOverlay.classList.add('show');
        newPostOverlay.setAttribute('aria-hidden', 'false');
        document.body.classList.add('no-scroll');
    };

    const closeNewPost = () => {
        if (!newPostOverlay) return;
        newPostOverlay.classList.remove('show');
        newPostOverlay.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('no-scroll');
        resetNewPostForm();
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
        const hasCategories = categoryCheckboxes ? Array.from(categoryCheckboxes).some(cb => cb.checked) : false;
        const hasDescription = descriptionInput && descriptionInput.value.trim().length > 0;
        if (newPostSubmit) {
            newPostSubmit.disabled = !(hasCategories && hasDescription);
        }
        if (newPostStatus) {
            if (!hasCategories && !hasDescription) {
                newPostStatus.textContent = 'Choisis au moins une catégorie et une description.';
            } else if (!hasCategories) {
                newPostStatus.textContent = 'Choisis au moins une catégorie.';
            } else if (!hasDescription) {
                newPostStatus.textContent = 'Ajoute une description.';
            } else {
                newPostStatus.textContent = '';
            }
        }
    };

    if (descriptionInput) {
        descriptionInput.addEventListener('input', validateNewPost);
    }

    if (categoryCheckboxes.length) {
        categoryCheckboxes.forEach((cb) => {
            cb.addEventListener('change', () => {
                const selected = Array.from(categoryCheckboxes).filter(c => c.checked);
                if (selected.length > maxCategories) {
                    cb.checked = false;
                    if (newPostStatus) newPostStatus.textContent = `Maximum ${maxCategories} catégories.`;
                    return;
                }
                validateNewPost();
                if (tagsArea) {
                    const count = selected.length;
                    tagsArea.textContent = count > 0 ? `${count}/${maxCategories} catégorie(s) sélectionnée(s)` : `0/${maxCategories} catégorie(s) sélectionnée(s)`;
                }
            });
        });
    }

    if (categoryToggleBtn && categoryOptionsWrap) {
        categoryToggleBtn.addEventListener('click', () => {
            const expanded = categoryOptionsWrap.classList.toggle('expanded');
            categoryToggleBtn.textContent = expanded ? 'Voir moins...' : 'Voir plus...';
            categoryToggleBtn.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        });
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

    const resetNewPostForm = () => {
        if (descriptionInput) descriptionInput.value = '';
        if (categoryCheckboxes.length) {
            categoryCheckboxes.forEach((cb) => { cb.checked = false; });
        }
        if (tagsArea) {
            tagsArea.textContent = `0/${maxCategories} catégorie(s) sélectionnée(s)`;
        }
        mediaFiles = [];
        renderMedia();
        if (newPostStatus) newPostStatus.textContent = '';
        if (categoryOptionsWrap && categoryOptionsWrap.classList.contains('expanded')) {
            categoryOptionsWrap.classList.remove('expanded');
            if (categoryToggleBtn) {
                categoryToggleBtn.textContent = 'Voir plus...';
                categoryToggleBtn.setAttribute('aria-expanded', 'false');
            }
        }
        validateNewPost();
    };

    // Auto-ouverture si ?open_new_post=1 dans l'URL
    const params = new URLSearchParams(window.location.search);
    if (params.get('open_new_post') === '1') {
        openNewPost();
    }

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
            event.preventDefault();
            if (newPostSubmit && newPostSubmit.disabled) return;
            if (!ajaxUrl || !newPostNonce) {
                if (newPostStatus) newPostStatus.textContent = 'Service indisponible.';
                return;
            }

            const formData = new FormData();
            formData.append('action', 'lyra_create_post');
            formData.append('nonce', newPostNonce);
            formData.append('description', descriptionInput?.value.trim() || '');

            if (categoryCheckboxes.length) {
                Array.from(categoryCheckboxes)
                    .filter((cb) => cb.checked)
                    .forEach((cb) => formData.append('categories[]', cb.value));
            }

            if (mediaFiles.length > 0) {
                formData.append('media', mediaFiles[0], mediaFiles[0].name);
            }

            newPostSubmit.disabled = true;
            newPostSubmit.textContent = 'Publication...';
            if (newPostStatus) newPostStatus.textContent = '';

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
            })
                .then((res) => res.json())
                .then((data) => {
                    if (!data || !data.success) {
                        const msg = data?.data?.message || 'Erreur inconnue.';
                        if (newPostStatus) newPostStatus.textContent = msg;
                        newPostSubmit.disabled = false;
                        newPostSubmit.textContent = 'Nouveau post';
                        return;
                    }
                    if (newPostStatus) newPostStatus.textContent = 'Post créé !';
                    resetNewPostForm();
                    setTimeout(() => {
                        newPostSubmit.disabled = false;
                        newPostSubmit.textContent = 'Nouveau post';
                        if (newPostStatus) newPostStatus.textContent = '';
                        if (newPostOverlay) newPostOverlay.classList.remove('show');
                        document.body.classList.remove('no-scroll');
                    }, 600);
                })
                .catch(() => {
                    if (newPostStatus) newPostStatus.textContent = 'Erreur réseau, réessaie.';
                    newPostSubmit.disabled = false;
                    newPostSubmit.textContent = 'Nouveau post';
                });
        });
    }

    // État initial
    resetNewPostForm();
});

