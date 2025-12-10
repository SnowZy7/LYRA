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
        if (isset($_GET['login']) && $_GET['login'] == 'failed') {
            echo '<div class="error-message">Email ou mot de passe incorrect.</div>';
        }
        if (isset($_GET['login']) && $_GET['login'] == 'empty') {
            echo '<div class="error-message">Remplissez tous les champs svp.</div>';
        }
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

<?php wp_footer(); ?>
</body>
</html>