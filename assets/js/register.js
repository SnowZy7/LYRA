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

    const totalSteps = 5;
    let currentStep = 1;

    const showStep = (n) => {
        currentStep = Math.min(Math.max(1, n), totalSteps);
        steps.forEach((el, idx) => {
            el.classList.toggle('step--active', idx === currentStep - 1);
        });
        updateProgress();
        updateBackVisibility();
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
            // Placeholder pour l'étape 5
            alert('Étape 5 à implémenter (flow multi-étapes).');
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

