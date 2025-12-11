<?php
/**
 * Chargement des assets du thème.
 */
function lyra_enqueue_assets() {
    $version = wp_get_theme()->get('Version');

    // Google Fonts global
    wp_enqueue_style(
        'lyra-google-fonts',
        'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap',
        [],
        null
    );

    // CSS global (header + base)
    wp_enqueue_style(
        'lyra-header-style',
        get_template_directory_uri() . '/assets/css/header.css',
        [],
        $version ?: null
    );

    wp_enqueue_style(
        'lyra-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        $version ?: null
    );

    // CSS par page / template
    if (is_front_page() || is_home() || is_page_template('home.php')) {
        wp_enqueue_style('lyra-home', get_template_directory_uri() . '/assets/css/home.css', ['lyra-main'], $version ?: null);
    }

    if (is_page('categories') || is_page_template('categories.php') || is_page_template('categories-template.php')) {
        wp_enqueue_style('lyra-categories', get_template_directory_uri() . '/assets/css/categories.css', ['lyra-main'], $version ?: null);
    }

    if (is_page('decouvrir') || is_page_template('decouvrir.php') || is_page_template('decouvrir-template.php')) {
        wp_enqueue_style('lyra-decouvrir', get_template_directory_uri() . '/assets/css/decouvrir.css', ['lyra-main'], $version ?: null);
    }

    if (is_page('profil') || is_page_template('profil.php') || is_page_template('profil-template.php')) {
        wp_enqueue_style('lyra-profil', get_template_directory_uri() . '/assets/css/profil.css', ['lyra-main'], $version ?: null);
    }

    if (is_page('parametres') || is_page_template('parametres.php') || is_page_template('parametres-template.php')) {
        wp_enqueue_style('lyra-parametres', get_template_directory_uri() . '/assets/css/parametres.css', ['lyra-main'], $version ?: null);
    }

    if (is_page('login') || is_page_template('login.php') || is_page_template('login-template.php')) {
        wp_enqueue_style('lyra-login', get_template_directory_uri() . '/assets/css/login.css', ['lyra-main'], $version ?: null);
    }

    if (is_page('register') || is_page_template('register.php') || is_page_template('register-template.php')) {
        wp_enqueue_style('lyra-register', get_template_directory_uri() . '/assets/css/register.css', ['lyra-main'], $version ?: null);
    }

    if (is_page('register') || is_page_template('register.php') || is_page_template('register-template.php')) {
        wp_enqueue_script('lyra-register', get_template_directory_uri() . '/assets/js/register.js', [], $version ?: null, true);
    }

    wp_enqueue_script(
        'lyra-header-script',
        get_template_directory_uri() . '/assets/js/header.js',
        [],
        $version ?: null,
        true
    );
}

add_action('wp_enqueue_scripts', 'lyra_enqueue_assets');

/**
 * AJAX inscription front.
 */
function lyra_ajax_register_user() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'lyra_register')) {
        wp_send_json_error(['message' => 'Nonce invalide'], 400);
    }

    $email    = isset($_POST['user_email']) ? sanitize_email(wp_unslash($_POST['user_email'])) : '';
    $password = isset($_POST['user_pass']) ? (string) $_POST['user_pass'] : '';
    $first    = isset($_POST['user_first']) ? sanitize_text_field(wp_unslash($_POST['user_first'])) : '';
    $last     = isset($_POST['user_last']) ? sanitize_text_field(wp_unslash($_POST['user_last'])) : '';
    $username = isset($_POST['user_login']) ? sanitize_user(wp_unslash($_POST['user_login']), true) : '';
    $interests = isset($_POST['interests']) ? array_map('intval', (array) $_POST['interests']) : [];

    if (!$email || !$password || !$first || !$last || !$username) {
        wp_send_json_error(['message' => 'Champs requis manquants.'], 400);
    }
    if (!is_email($email)) {
        wp_send_json_error(['message' => 'Email invalide.'], 400);
    }
    if (username_exists($username)) {
        wp_send_json_error(['message' => 'Nom d’utilisateur déjà pris.'], 400);
    }
    if (email_exists($email)) {
        wp_send_json_error(['message' => 'Email déjà utilisé.'], 400);
    }
    if (strlen($password) < 8) {
        wp_send_json_error(['message' => 'Mot de passe trop court (8+).'], 400);
    }

    $user_id = wp_insert_user([
        'user_login' => $username,
        'user_pass'  => $password,
        'user_email' => $email,
        'first_name' => $first,
        'last_name'  => $last,
        'display_name' => trim($first . ' ' . $last),
        'role'       => 'subscriber',
    ]);

    if (is_wp_error($user_id)) {
        wp_send_json_error(['message' => 'Erreur création utilisateur.'], 400);
    }

    if (!empty($interests)) {
        update_user_meta($user_id, 'lyra_interests', $interests);
    }

    wp_send_json_success(['message' => 'Inscription réussie', 'user_id' => $user_id]);
}
add_action('wp_ajax_nopriv_lyra_register_user', 'lyra_ajax_register_user');
add_action('wp_ajax_lyra_register_user', 'lyra_ajax_register_user');

// Masquer la barre admin pour tous les utilisateurs
add_filter('show_admin_bar', '__return_false');

// Ajouter les intérêts dans le tableau des utilisateurs
add_filter('manage_users_columns', function($c){ $c['lyra_interests']='Intérêts'; return $c; });
add_filter('manage_users_custom_column', function($val,$col,$user_id){
  if ($col==='lyra_interests'){
    $ids = (array) get_user_meta($user_id,'lyra_interests',true);
    if (!$ids) return '—';
    $names = array_map(function($id){ $t=get_term($id); return $t && !is_wp_error($t) ? $t->name : null; }, $ids);
    $names = array_filter($names);
    return $names ? implode(', ', $names) : '—';
  }
  return $val;
},10,3);

function handle_user_registration()
{
    if (isset($_POST['register_submit']) && isset($_POST['register_nonce']) && wp_verify_nonce($_POST['register_nonce'], 'register_action')) {
        $username = sanitize_user($_POST['user_login']);
        $email = sanitize_email($_POST['user_email']);
        $password = $_POST['user_pass'];
        $password_confirm = $_POST['user_pass_confirm'];

        if ($password !== $password_confirm) {
            wp_redirect(home_url('/register?registration=error'));
            exit;
        }

        $user_id = wp_create_user($username, $password, $email);

        if (!is_wp_error($user_id)) {
            wp_redirect(home_url('/register?registration=success'));
            exit;
        } else {
            wp_redirect(home_url('/register?registration=error'));
            exit;
        }
    }
}
add_action('template_redirect', 'handle_user_registration');

// Handle user login
function handle_user_login()
{
    if (isset($_POST['login_submit']) && isset($_POST['login_nonce']) && wp_verify_nonce($_POST['login_nonce'], 'login_action')) {
        $username = sanitize_user($_POST['log']);
        $password = $_POST['pwd'];
        $remember = isset($_POST['rememberme']) ? true : false;

        // Page de login pour renvoyer les messages d'erreur
        $login_page = home_url('/login');

        if (empty($username) || empty($password)) {
            wp_safe_redirect(add_query_arg('login', 'empty', $login_page));
            exit;
        }

        $creds = array(
            'user_login'    => $username,
            'user_password' => $password,
            'remember'      => $remember
        );

        $user = wp_signon($creds, false);

        if (!is_wp_error($user)) {
            wp_redirect(home_url());
            exit;
        } else {
            wp_safe_redirect(add_query_arg('login', 'failed', $login_page));
            exit;
        }
    }
}
add_action('template_redirect', 'handle_user_login');

// Redirect after login
function redirect_after_login($redirect_to, $request, $user)
{
    if (!is_wp_error($user)) {
        return home_url();
    }
    return $redirect_to;
}
add_filter('login_redirect', 'redirect_after_login', 10, 3);
