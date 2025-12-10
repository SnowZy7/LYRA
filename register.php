<?php
/**
 * Template Name: Register Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Lyra</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class('page-template-template-register'); ?>>
<?php $theme_uri = get_template_directory_uri(); ?>
<div class="register-page">
    <div class="register-progress">
        <button type="button" class="register-back" aria-label="Revenir à l'étape précédente">
        <img src="<?php echo esc_url( $theme_uri . '/assets/svg/Bouton%20Retour.svg' ); ?>" alt="Retour" class="register-back-icon">
        </button>
        <div class="progress-track">
            <div class="progress-fill" data-total="5" data-current="1"></div>
        </div>
        <?php
            $home_page = get_page_by_path('home');
            $home_link = $home_page ? get_permalink($home_page) : home_url('/');
        ?>
        <button type="button" class="register-close" data-target="<?php echo esc_url($home_link); ?>" aria-label="Fermer l'inscription">
            <img src="<?php echo esc_url( $theme_uri . '/assets/svg/croix.svg' ); ?>" alt="Fermer">
        </button>
    </div>

    <div class="register-container">
        <div class="register-form-wrapper">
            <div class="register-step step-1 step--active">
                <h1>Quel est votre e-mail ?</h1>
                <form class="register-form" novalidate>
                    <div class="form-group">
                        <label class="sr-only" for="reg-email">Email</label>
                        <input type="email" id="reg-email" name="user_email" placeholder="Entrez votre e-mail" autocomplete="email">
                        <div class="form-error" id="reg-error"></div>
                    </div>
                    <button type="button" class="submit-btn" id="reg-next-email">Continuer →</button>
                </form>
            </div>

            <div class="register-step step-2">
                <h1>Quel est votre mot de passe ?</h1>
                <form class="register-form" novalidate>
                    <div class="form-group">
                        <label class="sr-only" for="reg-pass">Mot de passe</label>
                        <input type="password" id="reg-pass" name="user_pass" placeholder="Entrez votre mot de passe" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="reg-pass-confirm">Confirmez votre mot de passe</label>
                        <input type="password" id="reg-pass-confirm" name="user_pass_confirm" placeholder="Confirmez votre mot de passe" autocomplete="new-password">
                        <div class="form-error" id="reg-pass-error"></div>
                    </div>
                    <button type="button" class="submit-btn" id="reg-next-pass">Continuer →</button>
                </form>
            </div>

            <div class="register-step step-3">
                <h1>Quel est votre nom ?</h1>
                <form class="register-form" novalidate>
                    <div class="form-group">
                        <label class="sr-only" for="reg-first">Prénom</label>
                        <input type="text" id="reg-first" name="user_first" placeholder="Entrez votre prénom" autocomplete="given-name">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="reg-last">Nom</label>
                        <input type="text" id="reg-last" name="user_last" placeholder="Entrez votre nom" autocomplete="family-name">
                        <div class="form-error" id="reg-name-error"></div>
                    </div>
                    <button type="button" class="submit-btn" id="reg-next-name">Continuer →</button>
                </form>
            </div>

            <div class="register-step step-4">
                <h1>Quel est votre nom d'utilisateur ?</h1>
                <form class="register-form" novalidate>
                    <div class="form-group">
                        <label class="sr-only" for="reg-username">Nom d'utilisateur</label>
                        <input type="text" id="reg-username" name="user_login" placeholder="Entrez votre nom d'utilisateur" autocomplete="username">
                        <div class="form-error" id="reg-username-error"></div>
                    </div>
                    <button type="button" class="submit-btn" id="reg-next-username">Continuer →</button>
                </form>
            </div>

            <p class="login-link">Déjà un compte ? <a href="<?php echo esc_url(home_url('/login')); ?>">Se connecter</a></p>
        </div>
    </div>

    <div class="register-footer">
        <a href="#" class="footer-link">Conditions générales</a>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="footer-brand">LYRA</a>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>

