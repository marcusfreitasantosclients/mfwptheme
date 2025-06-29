<?php function mf_products_gallery($component_data){ 
    $products_list = $component_data['product_list'];
    $site_url = site_url();   
    $currency_symbol = get_woocommerce_currency_symbol();
    $total_products = count($products_list);
    ?>

    <section>
        <div>
            <?php
            $i = 0;
            while ($i < $total_products) {
                // Odd row: 2 columns, Even row: 3 columns
                $is_odd = (floor($i / 2) % 2 == 0);
                $row_size = $is_odd ? 2 : 3;
                $row_class = $is_odd ? 'odd' : 'even';
                echo '<div class="mf-products-gallery-row ' . $row_class . '">';
                for ($j = 0; $j < $row_size && ($i + $j) < $total_products; $j++) {
                    $product_id = $products_list[$i + $j];
                    $product = wc_get_product($product_id);
                    $product_image = get_the_post_thumbnail($product_id, 'full');
                    $product_terms = wp_get_post_terms($product_id, 'product_cat');
                    $product_cats = implode(', ', wp_list_pluck($product_terms, 'name')); 
                    $product_name = $product->get_name();
                    $product_price = $currency_symbol . $product->get_price();
                    ?>
                    <a class="mf-product-card" href="<?= $product->get_permalink(); ?>">
                        <?php echo $product_image; ?>

                        <div class="mf-product-card-info-wrapper">
                            <div class="mf-product-cat"><?php echo esc_html($product_cats); ?></div>

                            <div class="mf-product-card-info">
                                <div class="mf-product-name"><?php echo esc_html($product_name); ?></div>
                                <div class="mf-product-price"><?php echo esc_html($product_price); ?></div>
                            </div>
                        </div>
                    </a>
                    <?php
                }
                echo '</div>';
                $i += $row_size;
            }
            ?>
        </div>
    </section>
<?php }