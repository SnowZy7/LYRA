<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LYRA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body>
    <?php $theme_uri = get_template_directory_uri(); ?>
    <header class="header">
        <div class="header-container">
            <?php 
                $home_page = get_page_by_path('home');
                $home_link = $home_page ? get_permalink($home_page) : home_url('/');
            ?>
            <a href="<?php echo esc_url($home_link); ?>">
                <img src="<?php echo $theme_uri; ?>/assets/svg/Logo.svg" alt="LYRA Logo" class="logo">
            </a>
            <div class="search-container">
                <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label class="sr-only" for="header-search">Rechercher</label>
                    <input type="search" id="header-search" class="search-bar form-control" placeholder="Rechercher..." value="<?php echo get_search_query(); ?>" name="s">
                    <button type="submit" class="search-button" aria-label="Rechercher">
                        <img src="<?php echo $theme_uri; ?>/assets/svg/Search loupe.svg" alt="Rechercher" class="search-icon">
                    </button>
                </form>
            </div>
            <div class="profile-menu">
                <img src="<?php echo $theme_uri; ?>/assets/img/pikachu.jpg" alt="Profil" class="profile-pic" id="profileBtn">
                <div class="dropdown-menu" id="dropdownMenu">
                    <?php
                        $login_page = get_permalink(get_page_by_path('login'));
                        $login_url  = $login_page ?: home_url('/login');
                    ?>
                    <a href="<?php echo esc_url($login_url); ?>">
                        <img src="<?php echo $theme_uri; ?>/assets/svg/changer-de-compte.svg" alt="Changer" class="dropdown-icon">
                        <span>Changer de compte</span>
                    </a>
                    <a href="#">
                        <img src="<?php echo $theme_uri; ?>/assets/svg/déco.svg" alt="Déconnexion" class="dropdown-icon">
                        <span>Déconnexion</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- Ajout : menu vertical à gauche -->
        <?php
            $page_categories = get_permalink(get_page_by_path('categories'));
            $page_decouvrir  = get_permalink(get_page_by_path('decouvrir'));
            $page_profil     = get_permalink(get_page_by_path('profil'));
            $page_parametres = get_permalink(get_page_by_path('parametres'));
        ?>
        <nav class="left-menu" aria-label="Menu vertical">
            <a class="menu-item" href="<?php echo esc_url($page_categories ?: '#'); ?>">
                <span class="icon" aria-hidden="true">
                    <img src="<?php echo $theme_uri; ?>/assets/svg/Catégories.svg" alt="Catégories" width="24" height="24">
                </span>
                <span class="label" aria-hidden="true">Catégories</span>
            </a>
            <a class="menu-item" href="<?php echo esc_url($page_decouvrir ?: '#'); ?>">
                <span class="icon" aria-hidden="true">
                    <img src="<?php echo $theme_uri; ?>/assets/svg/Découvrir.svg" alt="Découvrir" width="24" height="24">
                </span>
                <span class="label" aria-hidden="true">Découvrir</span>
            </a>
            <a class="menu-item" href="<?php echo esc_url($page_profil ?: '#'); ?>">
                <span class="icon" aria-hidden="true">
                    <img src="<?php echo $theme_uri; ?>/assets/svg/Profil.svg" alt="Profil" width="24" height="24">
                </span>
                <span class="label" aria-hidden="true">Profil</span>
            </a>
            <a class="menu-item" href="<?php echo esc_url($page_parametres ?: '#'); ?>">
                <span class="icon" aria-hidden="true">
                    <img src="<?php echo $theme_uri; ?>/assets/svg/Paramètres.svg" alt="Paramètres" width="24" height="24">
                </span>
                <span class="label" aria-hidden="true">Paramètres</span>
            </a>
        </nav>
    </header>
    <main>
    </main>

    <?php wp_footer(); ?>
    </body>
    </html>