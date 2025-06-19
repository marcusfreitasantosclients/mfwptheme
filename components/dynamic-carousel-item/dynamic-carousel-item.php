<?php
function mf_dynamic_carousel_item($component_data){
    $current_post = get_post($component_data);
    $post_image = get_the_post_thumbnail($component_data, 'full');
    $post_content = $current_post->post_excerpt;
    $post_title = $current_post->post_title;
    $post_permalink = get_post_permalink($component_data);

    ?>

    <div class="mf_dynamic_carousel_item text-center w-100 pb-5">
        <div class="w-50 m-auto">
            <div class="mf_dynamic_carousel_item_img_wrapper mb-3">
                <?= $post_image; ?>
            </div>

            <h3><?= $post_title ?></h3>
            <p><?= $post_content ?></p>

            <?php
            import_component('button', [
                'button' => [
                    'text'     => 'Explore products',
                    'url'      => $post_permalink,
                    'target'   => '_blank',
                    'type'     => 'primary',
                    'color'    => 'dark'
                ]
            ]);
            ?>
        </div>
    </div>


<?php }