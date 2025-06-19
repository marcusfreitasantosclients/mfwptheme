<?php get_header(); ?>
<?php
global $post;
$post_slug = $post->post_name;
$gallery_items = get_field('images');

?>

<?php if(get_the_content()){ ?>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <?php import_component('simple-text', [
                            'simple-text' => [
                                'title' => get_the_title(),
                                'text' => get_the_content()
                            ]
                    ]) ?>
                </div>
    
                <div class="col-md-8">
                    <div class="mf_gallery_featured_img_wrapper">
                        <img class="" src="<?= get_the_post_thumbnail_url(get_the_ID()) ?>" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>


<?php if(is_array($gallery_items)){ ?>
    <section class="py-5">
        <div class="container">
    
            <div class="mf_gallery_container d-grid gap-1">
                <?php foreach($gallery_items as $image){ ?>
                    <div class="mf_gallery_container_img_wrapper">
                        <a href="<?= $image['url'] ?>" data-lightbox="<?= $post_slug ?>" class="mf_gallery_img_wrapper">
                            <img class="img-fluid" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" />
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>  
    </section>
<?php } ?>


<?php get_footer(); ?>