<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lyra - Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/landing_page.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/footer.css">
</head>
<body>
    <!-- Background flou lumineux -->
    <div class="blur">
        <div class="blur-1"></div>
        <div class="blur-2"></div>
        <div class="blur-3"></div>
        <div class="blur-4"></div>
        <div class="blur-5"></div>
        <div class="blur-6"></div>
        <div class="blur-7"></div>
        <div class="blur-8"></div>
        <div class="blur-9"></div>
        <div class="blur-10"></div>
        <div class="blur-11"></div>
        <div class="blur-12"></div>
    </div>

    <!-- Contenu de la page -->
    <div class="container">
        <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/svg/Logo_Lyra.svg" alt="logo">

        <div>
            <p class="slogan">Ici, tu ne crées jamais seul : partage tes questions, découvre des solutions et fais évoluer ta musique avec l'aide d'une communauté passionnée.</p>
            <div class="buttons">
                <a href="#"><button class="inscription">Inscription</button></a>
                <a href="#"><button class="connexion">Connexion</button></a>
            </div>
        </div>
        
        <section class="section-intro">
            <h3><em>LYRA</em> est une plateforme d'entraide dédiée aux musiciens.</h3>
            <br>
            <br>
            <p class="description">Chaque utilisateur peut poser une question, demander un avis, partager une difficulté ou montrer son travail… et recevoir des réponses de personnes qui partagent la même passion.</p>
        </section>

        <section class="section-cards">
            <h3>Une communauté qui se répond</h3>
            <div class="card">
                <ul>
                    <li> Pose ta question en quelques secondes</li>
                    <li> Ajoute des tags pour qu'elle touche les bonnes personnes</li>
                    <li> Reçois des retours constructifs de musiciens débutants à confirmés</li>
                    <li> Identifie la réponse qui t'a aidé avec le tag « Solution »</li>
                    <li> Ton post devient alors « Résolu » et aide les autres à leur tour</li>
                </ul>
            </div>
            <p class="description">Sur LYRA, chacun apporte sa pierre à l'édifice</p>
        </section>

        <section class="section-cards">
            <h3>Nous valorisons l'entraide</h3>
            <div class="card">
                <ul>
                    <h4 class="card-title">Système de badges & progression</h4>
                    <br>
                    <li> Donnes des réponses utiles</li>
                    <li> Fais monter ton niveau de contribution</li>
                    <li> Débloque des badges</li>
                    <li> Gagne en visibilité sur la plateforme</li>
                </ul>
            </div>
            <p class="description">Sur LYRA, chacun apporte sa pierre à l'édifice</p>
        </section>

        <section class="section-cards">
            <h3>Publie ce que tu veux, comme tu veux</h3>
            <div class="section-mini-cards">
                <div class="mini-card">
                    <ul>
                        <h4 class="card-title">Chaque post peut contenir</h4>
                        <br>
                        <li>du texte</li>
                        <li>des images</li>
                        <li>des extraits audio</li>
                        <li>des vidéos</li>
                    </ul>
                </div>
                <div class="mini-card">
                    <ul>
                        <h4 class="card-title">Mais tu peux aussi</h4>
                        <br>
                        <li>sauvegarder des posts pour les regarder plus tard</li>
                        <li>mettre en avant les réponses les plus pertinentes</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section-cards">
            <h3>Un fil d'actualité personnalisé</h3>
            <div class="card">
                <ul>
                    <h4 class="card-title">Grâçe aux tags ajoutés lors de l'inscription</h4>
                    <br>
                    <li> Ton feed s'adapte à ce que TOI, tu veux apprendre</li>
                    <li> Tes publications sont montrées aux personnes les plus susceptibles d'y répondre</li>
                    <li> Tu restes dans un environnement visuel clair et cohérant</li>
                </ul>
            </div>
            <p class="description">Un espace pensé pour la créativité, sans bruit inutile</p>
        </section>
        
        <section class="section-cards last">
            <h3>Pourquoi rejoindre <em>LYRA</em> ?</h3>
            <div class="last-card">
                <ul>
                    <li>Parce que progresser seul, c'est difficile</li>
                    <li>Parce qu'un regard extérieur peut tout changer</li>
                    <li>Parce que tu mérites un espace où l'on t'écoute, t'aide et te conseille</li>
                </ul>
            </div>
        </section>

        <div >
            <p class="final-slogan">
                Sur <em>LYRA</em> ta musique évolue grâçe aux autres <br>
                Et la leur évolue grâçe à toi
            </p>
            <h3 class="last-h3">Alors qu'attends-tu ?</h3>
            <a href="#"><button class="inscription">Inscription</button></a>
        </div>
    </div>

    <!-- Footer avec fonction WordPress -->
    <?php get_footer(); ?>

