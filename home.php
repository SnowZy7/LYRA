<?php
/**
 * Template Name: Home Template
 */
?>
<?php
get_header();
$theme_uri = get_template_directory_uri();
?>

<main class="home-wrapper">
    <div class="home-post-stack">
        <section class="home-post-card">
            <div class="home-post-inner">
                <div class="home-post-top">
                    <div class="home-post-user">
                        <img src="<?php echo $theme_uri; ?>/assets/img/chevre.jpg" alt="Avatar" class="home-post-avatar">
                        <div class="home-post-headings">
                            <div class="home-post-username-line">
                                <span class="home-post-username">LEAFY_GREEN_8</span>
                                <span class="home-post-badge">Badge</span>
                                <span class="home-post-badge">Badge</span>
                            </div>
                            <div class="home-post-tags">
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                            </div>
                        </div>
                    </div>
                    <button class="home-post-menu" aria-label="Options">
                        <span class="home-post-dot"></span>
                        <span class="home-post-dot"></span>
                        <span class="home-post-dot"></span>
                    </button>
                </div>

                <p class="home-post-text">
                    Pourquoi n’y a-t-il que le micro chevalet ? On vient de m’offrir une Stratocaster et, même si je n’ai pas encore l’ampli, j’ai vu qu’il n’y avait pas de micro manche. Est-ce que ça change beaucoup le son, et peut-on y remédier.     
                </p>

                <div class="home-post-media">
                    <img src="<?php echo $theme_uri; ?>/assets/img/image-post-1.png" alt="Photo du post">
                </div>

                <div class="home-post-footer">
                    <div class="home-post-actions">
                        <button class="home-post-action" aria-label="Commentaires">
                            <img src="<?php echo $theme_uri; ?>/assets/svg/Commentaires.svg" alt="Commentaires" class="home-post-action-icon">
                        </button>
                        <button class="home-post-action" aria-label="Enregistrer">
                            <img src="<?php echo $theme_uri; ?>/assets/svg/Enregistrer.svg" alt="Enregistrer" class="home-post-action-icon">
                        </button>
                    </div>
                    <span class="home-post-date">Publié il y a 2 jours</span>
                </div>
            </div>  
        </section>

        <section class="home-post-card">
            <div class="home-post-inner">
                <div class="home-post-top">
                    <div class="home-post-user">
                        <img src="<?php echo $theme_uri; ?>/assets/img/pikachu.jpg" alt="Avatar" class="home-post-avatar">
                        <div class="home-post-headings">
                            <div class="home-post-username-line">
                                <span class="home-post-username">Its-Hushy-YA</span>
                                <span class="home-post-badge">Badge</span>
                                <span class="home-post-badge">Badge</span>
                            </div>
                            <div class="home-post-tags">
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                            </div>
                        </div>
                    </div>
                    <button class="home-post-menu" aria-label="Options">
                        <span class="home-post-dot"></span>
                        <span class="home-post-dot"></span>
                        <span class="home-post-dot"></span>
                    </button>
                </div>

                <p class="home-post-text">
                Vidéo de démo : réglages rapides et son clean. Que pensez-vous du rendu ?
                </p>

                <div class="home-post-media home-post-media-video">
                    <video class="home-post-video" src="<?php echo $theme_uri; ?>/assets/videos/post-vidéo.mp4" controls></video>
                </div>

                <div class="home-post-footer">
                    <div class="home-post-actions">
                        <button class="home-post-action" aria-label="Commentaires">
                            <img src="<?php echo $theme_uri; ?>/assets/svg/Commentaires.svg" alt="Commentaires" class="home-post-action-icon">
                        </button>
                    <button class="home-post-action" aria-label="Enregistrer">
                            <img src="<?php echo $theme_uri; ?>/assets/svg/Enregistrer.svg" alt="Enregistrer" class="home-post-action-icon">
                        </button>
                    </div>
                    <span class="home-post-date">Publié il y a 2 jours</span>
                </div>
            </div>  
        </section>

        <section class="home-post-card">
            <div class="home-post-inner">
                <div class="home-post-top">
                    <div class="home-post-user">
                        <img src="<?php echo $theme_uri; ?>/assets/img/pikachu.jpg" alt="Avatar" class="home-post-avatar">
                        <div class="home-post-headings">
                            <div class="home-post-username-line">
                                <span class="home-post-username">Tortex_MTAZ</span>
                                <span class="home-post-badge">Badge</span>
                                <span class="home-post-badge">Badge</span>
                            </div>
                            <div class="home-post-tags">
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                                <span class="home-post-tag">Tag</span>
                            </div>
                        </div>
                    </div>
                    <button class="home-post-menu" aria-label="Options">
                        <span class="home-post-dot"></span>
                        <span class="home-post-dot"></span>
                        <span class="home-post-dot"></span>
                    </button>
                </div>

                <p class="home-post-text">
                    Démo audio : backing track et réglages rapides. Vos avis sur le mix ?
                </p>

                <div class="home-post-media home-post-media-audio">
                    <audio class="home-post-audio" controls>
                        <source src="<?php echo $theme_uri; ?>/assets/audio/audio-post.mp3" type="audio/mpeg">
                        Votre navigateur ne supporte pas l’élément audio.
                    </audio>
                </div>

                <div class="home-post-footer">
                    <div class="home-post-actions">
                        <button class="home-post-action" aria-label="Commentaires">
                            <img src="<?php echo $theme_uri; ?>/assets/svg/Commentaires.svg" alt="Commentaires" class="home-post-action-icon">
                        </button>
                        <button class="home-post-action" aria-label="Enregistrer">
                            <img src="<?php echo $theme_uri; ?>/assets/svg/Enregistrer.svg" alt="Enregistrer" class="home-post-action-icon">
                        </button>
                    </div>
                    <span class="home-post-date">Publié il y a 2 jours</span>
                </div>
            </div>  
        </section>
    </div>
</main>

