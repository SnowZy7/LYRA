document.addEventListener('DOMContentLoaded', () => {
    const steps = Array.from(document.querySelectorAll('.register-step'));
    const progressFill = document.querySelector('.progress-fill');
    const backBtn = document.querySelector('.register-back');
    const closeBtn = document.querySelector('.register-close');

    // Step 1
    const emailInput = document.getElementById('reg-email');
    const emailError = document.getElementById('reg-error');
    const nextEmailBtn = document.getElementById('reg-next-email');

    // Step 2
    const passInput = document.getElementById('reg-pass');
    const passConfirmInput = document.getElementById('reg-pass-confirm');
    const passError = document.getElementById('reg-pass-error');
    const nextPassBtn = document.getElementById('reg-next-pass');

    // Step 3
    const firstInput = document.getElementById('reg-first');
    const lastInput = document.getElementById('reg-last');
    const nameError = document.getElementById('reg-name-error');
    const nextNameBtn = document.getElementById('reg-next-name');

    // Step 4
    const usernameInput = document.getElementById('reg-username');
    const usernameError = document.getElementById('reg-username-error');
    const nextUsernameBtn = document.getElementById('reg-next-username');

    // Step 5
    const interestsForm = document.querySelector('.interests-form');
    const interestsError = document.getElementById('reg-interests-error');
    const submitInterestsBtn = document.getElementById('reg-submit-interests');
    const toggleButtons = document.querySelectorAll('[data-toggle-group]');
    const ajaxUrl = submitInterestsBtn?.dataset.ajaxUrl || '';
    const registerNonce = submitInterestsBtn?.dataset.nonce || '';
    const redirectUrl = submitInterestsBtn?.dataset.redirect || '/';

    const totalSteps = 5;
    let currentStep = 1;
    const bodyEl = document.body;

    const showStep = (n) => {
        currentStep = Math.min(Math.max(1, n), totalSteps);
        steps.forEach((el, idx) => {
            el.classList.toggle('step--active', idx === currentStep - 1);
        });
        updateProgress();
        updateBackVisibility();
        if (bodyEl) {
            if (currentStep === 5) {
                bodyEl.classList.add('allow-scroll');
            } else {
                bodyEl.classList.remove('allow-scroll');
            }
        }
    };

    const updateProgress = () => {
        if (!progressFill) return;
        const percent = Math.min(100, (currentStep / totalSteps) * 100);
        progressFill.style.width = `${percent}%`;
        progressFill.dataset.current = currentStep;
    };

    const updateBackVisibility = () => {
        if (!backBtn) return;
        backBtn.style.display = currentStep > 1 ? 'inline-flex' : 'none';
    };

    const showError = (el, msg) => {
        if (el) el.textContent = msg;
    };

    const clearError = (el) => {
        if (el) el.textContent = '';
    };

    const isValidEmail = (value) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);

    if (nextEmailBtn) {
        nextEmailBtn.addEventListener('click', () => {
            const email = (emailInput?.value || '').trim();
            if (!email) {
                showError(emailError, 'Merci de saisir votre e-mail.');
                emailInput?.focus();
                return;
            }
            if (!isValidEmail(email)) {
                showError(emailError, 'Format d’e-mail invalide.');
                emailInput?.focus();
                return;
            }
            clearError(emailError);
            showStep(2);
        });
    }

    if (nextPassBtn) {
        nextPassBtn.addEventListener('click', () => {
            const pwd = (passInput?.value || '').trim();
            const pwd2 = (passConfirmInput?.value || '').trim();
            if (!pwd || !pwd2) {
                showError(passError, 'Merci de saisir et confirmer votre mot de passe.');
                passInput?.focus();
                return;
            }
            if (pwd.length < 8) {
                showError(passError, 'Le mot de passe doit faire au moins 8 caractères.');
                passInput?.focus();
                return;
            }
            if (pwd !== pwd2) {
                showError(passError, 'Les mots de passe ne correspondent pas.');
                passConfirmInput?.focus();
                return;
            }
            clearError(passError);
            showStep(3);
        });
    }

    if (nextNameBtn) {
        nextNameBtn.addEventListener('click', () => {
            const first = (firstInput?.value || '').trim();
            const last = (lastInput?.value || '').trim();
            if (!first || !last) {
                showError(nameError, 'Merci de saisir prénom et nom.');
                if (!first) firstInput?.focus(); else lastInput?.focus();
                return;
            }
            clearError(nameError);
            showStep(4);
        });
    }

    if (nextUsernameBtn) {
        nextUsernameBtn.addEventListener('click', () => {
            const uname = (usernameInput?.value || '').trim();
            if (!uname) {
                showError(usernameError, "Merci de saisir un nom d'utilisateur.");
                usernameInput?.focus();
                return;
            }
            clearError(usernameError);
            showStep(5);
        });
    }

    // Step 5 - affichage des groupes supplémentaires
    if (toggleButtons.length) {
        toggleButtons.forEach((btn) => {
            btn.addEventListener('click', () => {
                const group = btn.dataset.toggleGroup;
                const list = document.querySelector(`.interests-list[data-group="${group}"]`);
                if (!list) return;
                const expanded = list.classList.toggle('expanded');
                btn.textContent = expanded ? 'Voir moins...' : 'Voir plus...';
            });
        });
    }

    // Step 5 - sélection des intérêts
    if (interestsForm) {
        interestsForm.addEventListener('change', (e) => {
            const target = e.target;
            if (target && target.matches('input[type="checkbox"]')) {
                const chip = target.closest('.interest-chip');
                if (chip) {
                    chip.classList.toggle('selected', target.checked);
                }
            }
        });
    }

    if (submitInterestsBtn) {
        submitInterestsBtn.addEventListener('click', () => {
            const email = (emailInput?.value || '').trim();
            const pwd = (passInput?.value || '').trim();
            const pwd2 = (passConfirmInput?.value || '').trim();
            const first = (firstInput?.value || '').trim();
            const last = (lastInput?.value || '').trim();
            const uname = (usernameInput?.value || '').trim();

            const checkedBoxes = interestsForm ? interestsForm.querySelectorAll('input[type="checkbox"]:checked') : [];
            const checked = checkedBoxes.length;
            if (!checked) {
                showError(interestsError, 'Merci de choisir au moins un centre d’intérêt.');
                return;
            }
            if (!email || !pwd || !pwd2 || !first || !last || !uname) {
                showError(interestsError, 'Veuillez compléter toutes les étapes.');
                return;
            }
            if (pwd !== pwd2) {
                showError(interestsError, 'Les mots de passe ne correspondent pas.');
                return;
            }
            if (!ajaxUrl || !registerNonce) {
                showError(interestsError, 'Service indisponible, réessayez.');
                return;
            }

            clearError(interestsError);
            const interests = Array.from(checkedBoxes).map((box) => box.value);
            const payload = new URLSearchParams();
            payload.append('action', 'lyra_register_user');
            payload.append('nonce', registerNonce);
            payload.append('user_email', email);
            payload.append('user_pass', pwd);
            payload.append('user_first', first);
            payload.append('user_last', last);
            payload.append('user_login', uname);
            interests.forEach((id) => payload.append('interests[]', id));

            submitInterestsBtn.disabled = true;
            submitInterestsBtn.textContent = 'Inscription...';

            fetch(ajaxUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                },
                body: payload.toString(),
            })
                .then((res) => res.json())
                .then((data) => {
                    if (!data || !data.success) {
                        const msg = data?.data?.message || 'Erreur inconnue.';
                        showError(interestsError, msg);
                        submitInterestsBtn.disabled = false;
                        submitInterestsBtn.textContent = 'Continuer →';
                        return;
                    }
                    window.location.href = redirectUrl;
                })
                .catch(() => {
                    showError(interestsError, 'Erreur réseau, réessayez.');
                    submitInterestsBtn.disabled = false;
                    submitInterestsBtn.textContent = 'Continuer →';
                });
        });
    }

    if (backBtn) {
        backBtn.addEventListener('click', () => {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', () => {
            const target = closeBtn.dataset.target || '/';
            window.location.href = target;
        });
    }

    // Initial state
    showStep(1);
});

