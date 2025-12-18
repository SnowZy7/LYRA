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
<?php
$theme_uri = get_template_directory_uri();

if (!function_exists('lyra_get_terms_by_parent_slug')) {
    function lyra_get_terms_by_parent_slug($slug, $taxonomy = 'category')
    {
        $parent = get_term_by('slug', $slug, $taxonomy);
        if (!$parent) {
            return [];
        }
        return get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
            'parent'     => $parent->term_id,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ]);
    }
}

// Récupération des termes pour l'étape 5 (intérêts)
$register_instruments = taxonomy_exists('instrument')
    ? get_terms(['taxonomy' => 'instrument', 'hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC'])
    : lyra_get_terms_by_parent_slug('instruments');

$register_genres = lyra_get_terms_by_parent_slug('genres');
$register_logiciels = lyra_get_terms_by_parent_slug('logiciels');
?>
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

            <div class="register-step step-5">
                <h1>Quels sont vos centres d’intérêts ?</h1>
                <form class="register-form interests-form" novalidate>
                    <div class="interests-groups">
                        <?php
                        $groups = [
                            'instruments' => $register_instruments,
                            'genres'      => $register_genres,
                            'logiciels'   => $register_logiciels,
                        ];
                        foreach ($groups as $group_key => $terms) :
                            $label = ucfirst($group_key);
                            $is_instruments = ($group_key === 'instruments');
                            if ($is_instruments && taxonomy_exists('instrument')) {
                                $label = 'Instruments';
                            } elseif ($group_key === 'genres') {
                                $label = 'Genres';
                            } elseif ($group_key === 'logiciels') {
                                $label = 'Logiciels';
                            }
                            ?>
                            <div class="interests-group">
                                <div class="interests-header">
                                    <h2><?php echo esc_html($label); ?></h2>
                                    <?php if (!empty($terms) && count($terms) > 3) : ?>
                                        <button type="button" class="toggle-group" data-toggle-group="<?php echo esc_attr($group_key); ?>">Voir plus...</button>
                                    <?php endif; ?>
                                </div>
                                <div class="interests-list" data-group="<?php echo esc_attr($group_key); ?>">
                                    <?php
                                    if (!empty($terms)) :
                                        $count = 0;
                                        foreach ($terms as $term) :
                                            $is_extra = $count >= 3;
                                            ?>
                                            <label class="interest-chip <?php echo $is_extra ? 'is-extra' : ''; ?>">
                                                <input type="checkbox" name="interests[]" value="<?php echo esc_attr($term->term_id); ?>" <?php echo $is_extra ? 'data-extra="true"' : ''; ?>>
                                                <span><?php echo esc_html($term->name); ?></span>
                                            </label>
                                            <?php
                                            $count++;
                                        endforeach;
                                    else :
                                        ?>
                                        <p class="interests-empty">Aucune catégorie trouvée pour ce groupe.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-error" id="reg-interests-error"></div>
                    <?php
                        $lyra_register_nonce = wp_create_nonce('lyra_register');
                        $home_redirect = home_url('/');
                    ?>
                    <button
                        type="button"
                        class="submit-btn"
                        id="reg-submit-interests"
                        data-ajax-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
                        data-nonce="<?php echo esc_attr($lyra_register_nonce); ?>"
                        data-redirect="<?php echo esc_url($home_redirect); ?>"
                    >Continuer →</button>
                </form>
            </div>

            <p class="login-link">Déjà un compte ? <a href="<?php echo esc_url(home_url('/login')); ?>">Se connecter</a></p>
        </div>
    </div>

</body>
</html>

