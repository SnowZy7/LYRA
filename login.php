<?php
/**
 * Template Name: Login Template
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('page-template-template-login'); ?>>

<div class="login-container">
    <div class="login-form-wrapper">
        <h1>Connexion</h1>

        <?php
        $login_error_failed = isset($_GET['login']) && $_GET['login'] === 'failed';
        $login_error_empty  = isset($_GET['login']) && $_GET['login'] === 'empty';
        ?>

            <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" class="login-form" novalidate>
                <?php wp_nonce_field('login_action', 'login_nonce'); ?>

                <div class="form-group">
                    <label class="sr-only" for="user_login">Email</label>
                    <input type="text" name="log" id="user_login" placeholder="Entrez votre e-mail">
                </div>

                <div class="form-group">
                    <label class="sr-only" for="user_pass">Mot de passe</label>
                    <input type="password" name="pwd" id="user_pass" placeholder="Entrez votre mot de passe">
                    <?php if ($login_error_empty): ?>
                        <div class="error-message">Remplissez tous les champs svp.</div>
                    <?php endif; ?>
                    <?php if ($login_error_failed): ?>
                        <div class="error-message">Email ou mot de passe incorrect.</div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label>
                        <input type="checkbox" name="rememberme" value="forever"> Remember me
                    </label>
                </div>

                <button type="submit" name="login_submit" class="submit-btn">Login</button>
            </form>

            <p class="register-link">Pas de compte ? <a href="<?php echo esc_url(home_url('/signup')); ?>">S’inscrire</a></p>
    </div>
</div>


</body>
</html>