<?php get_header(); ?>
<?php
    if(isset($_GET["s"])){
        $searchTerm = sanitize_text_field($_GET["s"]);
    }
?>

<section class="py-5">
    <div class="container">
        <h1 class="text-center p-5">Search results for: <strong><?php echo esc_html($searchTerm); ?></strong></h1>
        <div class="row gx-5">
				<?php if ( have_posts() ) : ?>
						<?php
						while ( have_posts() ) :
							the_post();
                            global $post;
                            $post_type = get_post_type($post);
							?>

                            <div class="col-md-3 mb-5">
                                <?php if($post_type === "product"){ ?>
                                    <?php $product = wc_get_product($post->ID);?>
                                        <?php import_component("product-card", [
                                            "product-card" => $product
                                        ]); ?>
                                    <?php }else{ ?>
                                        <?php echo $post->post_title; ?>
                                <?php } ?>
                            </div>

						<?php endwhile; ?>

				<?php else : ?>
                    <div  class="col-12 text-center p-5">
                        <span>Nothing found.</span>
                    </div>
				<?php endif; ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>