<?php
function mf_product_card($component_data){
    $product = wc_get_product($component_data);
    $site_url = site_url();
    $product_image = get_the_post_thumbnail($product->get_id(), 'full');
    $product_terms = wp_get_post_terms($product->get_id(), 'product_cat');
    $product_cats = implode(', ', wp_list_pluck($product_terms, 'name'));    
    $currency_symbol = get_woocommerce_currency_symbol();

    // Get the price - special handling for variable products
    if ($product->is_type('variable')) {
        $min_price = $product->get_variation_price('min', true); // true = including tax
        $price_display = $currency_symbol . str_replace(".00", "", $min_price);
    } else {
        $price_display = $currency_symbol . str_replace(".00", "", $product->get_price());
    }
    ?>
        <a class="mf_product_card" href="<?= $product->get_permalink(); ?>">
            <div class="mf_product_card_cat d-flex gap-2 justify-content-center align-items-center py-3 text-center">
                <?= $product_cats ?>
            </div>

            <div class="mf_product_card_img">
                <?= $product_image; ?>
            </div>

            <div class="mf_product_card_info d-flex flex-row justify-content-between align-items-end">
                <h3>
                    <?= mb_strimwidth($product->get_name(), 0, 15, '...', 'UTF-8'); ?>
                </h3>

                <div class="d-flex flex-column align-items-end">
                    <span class="mf_product_card_price_text">
                        Starting at 
                    </span>
                    <span class="mf_product_card_price">
                        <?= $price_display ?>
                    </span>
                </div>
            </div>
        </a> 
    <?php
}
?>
