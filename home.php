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
        <?php
        $current_user_id = get_current_user_id();
        $user_interests  = $current_user_id ? (array) get_user_meta($current_user_id, 'lyra_interests', true) : [];
        $user_interests  = array_filter(array_map('intval', $user_interests));

        $query_args = [
            'post_type'      => 'post',
            'posts_per_page' => 10,
            'post_status'    => 'publish',
        ];

        if (!empty($user_interests)) {
            $query_args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $user_interests,
                    'operator' => 'IN',
                ],
            ];
        }

        $skip_query = $current_user_id && empty($user_interests);
        $feed_query = $skip_query ? null : new WP_Query($query_args);

        if (!$skip_query && $feed_query && $feed_query->have_posts()) :
            while ($feed_query->have_posts()) :
                $feed_query->the_post();

                $author_id    = get_the_author_meta('ID');
                $avatar_url   = get_avatar_url($author_id, ['size' => 96]);
                $avatar_url   = $avatar_url ?: $theme_uri . '/assets/img/chevre.jpg';
                $display_name = get_the_author();

                $categories  = get_the_category();
                $tags = !empty($categories) ? $categories : [];

                $video_url = get_post_meta(get_the_ID(), 'lyra_video_url', true);
                $audio_url = get_post_meta(get_the_ID(), 'lyra_audio_url', true);
                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');

                $post_text = get_the_excerpt();
                if (!$post_text) {
                    $post_text = wp_trim_words(wp_strip_all_tags(get_the_content()), 40);
                }

                $published = sprintf(
                    'Publié il y a %s',
                    human_time_diff(get_the_time('U'), current_time('timestamp'))
                );
                ?>
                <section class="home-post-card">
                    <div class="home-post-inner">
                        <div class="home-post-top">
                            <div class="home-post-user">
                                <img src="<?php echo esc_url($avatar_url); ?>" alt="Avatar" class="home-post-avatar">
                                <div class="home-post-headings">
                                    <div class="home-post-username-line">
                                        <span class="home-post-username"><?php echo esc_html($display_name); ?></span>
                                        <span class="home-post-badge">Badge</span>
                                        <span class="home-post-badge">Badge</span>
                                    </div>
                                    <?php if (!empty($tags)) : ?>
                                        <div class="home-post-tags">
                                            <?php foreach ($tags as $tag) : ?>
                                                <span class="home-post-tag"><?php echo esc_html($tag->name); ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <button class="home-post-menu" aria-label="Options">
                                <span class="home-post-dot"></span>
                                <span class="home-post-dot"></span>
                                <span class="home-post-dot"></span>
                            </button>
                        </div>

                        <p class="home-post-text"><?php echo esc_html($post_text); ?></p>

                        <?php if ($video_url) : ?>
                            <div class="home-post-media home-post-media-video">
                                <video class="home-post-video" src="<?php echo esc_url($video_url); ?>" controls></video>
                            </div>
                        <?php elseif ($audio_url) : ?>
                            <div class="home-post-media home-post-media-audio">
                                <audio class="home-post-audio" controls>
                                    <source src="<?php echo esc_url($audio_url); ?>" type="audio/mpeg">
                                    Votre navigateur ne supporte pas l’élément audio.
                                </audio>
                            </div>
                        <?php elseif ($thumb_url) : ?>
                            <div class="home-post-media">
                                <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                        <?php endif; ?>

                        <div class="home-post-footer">
                            <div class="home-post-actions">
                                <button class="home-post-action" aria-label="Commentaires">
                                    <img src="<?php echo $theme_uri; ?>/assets/svg/Commentaires.svg" alt="Commentaires" class="home-post-action-icon">
                                </button>
                                <button class="home-post-action" aria-label="Enregistrer">
                                    <img src="<?php echo $theme_uri; ?>/assets/svg/Enregistrer.svg" alt="Enregistrer" class="home-post-action-icon">
                                </button>
                            </div>
                            <span class="home-post-date"><?php echo esc_html($published); ?></span>
                        </div>
                    </div>
                </section>
            <?php endwhile; wp_reset_postdata(); ?>
        <?php else : ?>
            <p style="color: #ffffff;">Aucun post pour le moment.</p>
        <?php endif; ?>
    </div>
</main>

