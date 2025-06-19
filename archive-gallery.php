<?php get_header(); ?>

<style>
.galleries_card_wrapper .mf_full_width_image_card:nth-child(even){
    flex-direction: row-reverse;
    text-align: left;
}

.galleries_card_wrapper .mf_full_width_image_card:nth-child(odd){
    text-align: right;
}
</style>

<section>    
    <div class="galleries_card_wrapper">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); 
                $current_post = get_post();
                import_component("full-width-image-card", [
                    "full-width-image-card" => [
                        "title"     => $current_post->post_title,
                        "permalink" => get_post_permalink(),
                        "content"   => $current_post->post_excerpt,
                        "image"     => get_the_post_thumbnail_url(get_the_ID()),
                    ]
                ])
                ?>

            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e('No galleries found.', 'textdomain'); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
