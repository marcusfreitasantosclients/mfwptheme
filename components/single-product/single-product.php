<?php
function mf_single_product($component_data){ 
    global $product;
    $product = wc_get_product($component_data['product_id']);
    $product_data = $product->get_data();
    $attachment_ids = $product->get_gallery_image_ids();
    $product_image = get_the_post_thumbnail($product->id, 'full');
    $purchage_url = add_query_arg('add-to-cart', $product->id, wc_get_cart_url());
    $product_category_terms = wp_get_post_terms($product->get_id(), 'product_cat');
    $product_brand_terms = wp_get_post_terms($product->get_id(), 'product_brand');
    $product_cats = implode(', ', wp_list_pluck($product_category_terms, 'name'));    
    $product_brands = implode(', ', wp_list_pluck($product_brand_terms, 'name')); 
    $attachment_ids = $product->get_gallery_image_ids();

    // Get 10 most recent product IDs in date descending order.
    $other_products_query = new WC_Product_Query(array(
        'limit' => 10,
        'orderby' => 'date',
        'order' => 'DESC',
        'return' => 'ids',
    ));
    $other_products = $other_products_query->get_products();
    ?>

    <section class="py-5 mf_single_product_section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <?php if(!empty($attachment_ids)){ ?>
                        <div class="splide w-100 position-relative mf_single_product_carousel">
                            <div class="splide__track">   
                                <div class="splide__list">
                                    <?php foreach($attachment_ids as $attachment){
                                        $product_gallery_img = wp_get_attachment_url( $attachment );
                                        ?>
                                            <div class="splide__slide rounded">
                                                <a href="<?php echo $product_gallery_img; ?>" data-lightbox="product__img_carousel">                                        
                                                    <img class="img-fluid w-100" src="<?php echo $product_gallery_img; ?>"  />
                                                </a>

                                            </div>
                                    <?php } ?>    
                                </div> 
                            </div>
                        </div>
                    <?php }else{ ?>
                        <?php echo $product_image; ?>
                    <?php } ?>
                </div>

                <div class="col-md-6">
                    <p class="mf_single_product_cat"><strong>Categories:</strong> <?php echo $product_cats; ?></p>

                    <h1 class="mf_single_product_title"><?= the_title(); ?></h1>

                    <hr />
                    <div class="mf_single_product_content">
                        <?= the_content() ?>
                    </div>

                    <?php 
                    if ($product->is_type('variable')){
                        import_component('button', [
                            'button' => [
                                'text'     => "Finish Samples",
                                'url'      => esc_url(home_url('/finishes?product_id=' . $product->id)),
                                'target'   => '_self',
                                'type'     => 'secondary',
                                'color'    => 'light'
                            ]
                        ]);
                    }
                    ?>
                    
                    <hr />

                    <p class="mf_single_product_price my-3"><?php echo str_replace(",00", "",$product->get_price_html()); ?></p>

                    <div class="mf_single_product_cart">
                        <?php
                            // Variable product dropdown
                            if ($product->is_type('variable')) {                        
                                $available_variations = $product->get_available_variations();
                                $attributes = $product->get_variation_attributes();
                                $selected_attributes = $product->get_default_attributes();
                                                            
                                wc_get_template(
                                    'single-product/add-to-cart/variable.php',
                                    array(
                                        'available_variations' => $available_variations,
                                        'attributes' => $attributes,
                                    )
                                );
                                wp_reset_postdata();
                            } else {
                                wc_get_template('single-product/add-to-cart/simple.php');
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 px-2 my-5">

        <div class="container">

            <?php import_component("simple-text", [
                "simple-text" => [
                    "title" => "You may like"
                ]
            ]) ?>
            <div class="splide w-100 position-relative mf_single_product_carousel other_products my-3">
                <div class="splide__track">   
                    <div class="splide__list">
                        <?php foreach($other_products as $other_product){
                            ?>
                                <div class="splide__slide">
                                    <?php
                                        import_component('product-card', [
                                            'product-card' => $other_product,
                                        ]);
                                    ?>  
                                </div>
                        <?php } ?>    
                    </div> 
                </div>
            </div>
        </div>
    </section>
<?php }