<?php function mf_archive_content(){ 
    $product_categories = get_product_categories();
    $product_brands = get_product_brands(); 
    $queried_object = get_queried_object();
    $queried_object_name = $queried_object->name;

    function render_category_checkboxes($categories, $parent = 0, $depth = 0, $queried_object_name = '') {
        foreach ($categories as $category) {
            if ($category->parent == $parent) {
                $indent = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $depth); // 4 non-breaking spaces per level
                ?>
                <div class="d-flex align-items-center justify-content-start gap-2">
                    <input type="checkbox"
                        id="<?= esc_attr($category->slug) ?>"
                        name="<?= esc_attr($category->slug) ?>"
                        value="<?= esc_attr($category->slug) ?>"
                        <?= $queried_object_name == $category->name ? 'checked' : '' ?>>
                    <label for="<?= esc_attr($category->slug) ?>" class="<?=  !$category->parent ? 'parent'  : ''; ?>">
                        <?= $indent . esc_html($category->name) ?>
                    </label>
                </div>
                <?php
                // Recursive call for children
                render_category_checkboxes($categories, $category->term_id, $depth + 1, $queried_object_name);
            }
        }
    }
    ?>

    <section class="py-5">
        <div class="container">
            <?php if(is_product_category() || isset($_GET['designer_id'])){ ?>
                    <?php import_component('simple-text', [
                        'simple-text' => [
                            'title' => $queried_object_name,
                        ]
                    ]) ?>

                    <hr class="my-3"/>
            <?php } ?>

            
            <div class="row">
                <div class="col-md-3">
                    <div class="filter_content_column" data-current-designer="<?= isset($_GET['designer_id']) ? 'designer' : ''?>">
                    
                        <h4>Filter your products</h4>
                        <?php import_component("searchform", [
                            "searchform" => []
                        ]) ?>

                        <hr/>

                        <div class="">
                            <h5>Categories</h5>

                            <div class="filter_content_categories d-flex flex-column">
                                <?php render_category_checkboxes($product_categories, 0, 0, $queried_object_name); ?>
                            </div>
                        </div>

                        <hr/>

                        <?php
                        import_component('button', [
                            'button' => [
                                'text'     => 'Filter',
                                'type'     => 'primary',
                                'color'    => 'dark'
                            ]
                        ]);
                        ?>
                    </div>
                </div>

                <div class="col-md-9 position-relative">
                    <?php import_component('loading-spinner', []); ?>

                    <?php if ( woocommerce_product_loop() ) : ?>
                        <div class="row g-2 filtered_content">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div class="col-md-4">
                                <?php
                                    import_component('product-card', [
                                        'product-card' => get_the_ID(),
                                    ]);
                                ?>                                
                            </div>
                        <?php endwhile; ?>
                        </div>
                    <?php else : ?>
                        <?php do_action( 'woocommerce_no_products_found' ); ?>
                    <?php endif; ?>

                    <?php import_component("post-pagination", [
                        "post-pagination" => []
                    ])?>
                </div>        
            </div>
        </div>
    </section>
<?php }