<?php
function mf_footer() {
    $theme_location = 'footer';
    $menu_items = [];
    $whatsapp_msg = get_option('site_whatsapp_msg');
    $product_categories = get_product_categories();
    
    if (($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
    }

    $services = query_cpt_based_on_type('service');
    $social_links = [
        'whatsapp' => get_option('site_whatsapp') 
            ? 'http://wa.me/' . preg_replace('/\D+/', '', get_option('site_whatsapp')) 
            : null,        
        'facebook' => get_option('site_facebook'),
        'instagram' => get_option('site_instagram'),
        'twitter' => get_option('site_twitter'),
        'linkedin' => get_option('site_linkedin'),
        'youtube' => get_option('site_youtube'),
        'tiktok' => get_option('site_tiktok'),
    ]
    ?>
    <footer class="mf_footer">
        <div class="container pt-5">
            <div class="row">
                <div class="col-md-3 mt-3">
                    <?php if(get_option('site_logo_footer')){?>
                        <img src="<?= get_option('site_logo_footer') ?>" alt="Logo" class="img-fluid mb-3" style="width: 100px; height: auto;">
                    <?php } else{ ?>
                        <h5>LOGO</h5>
                    <?php } ?>
                    <p><?= get_option('site_footer_text'); ?></p>
                </div>

                <div class="col-md-3 mt-3">
                    <h5>Mapa do site</h5>

                    <?php foreach($menu_items as $menu_item){ ?>
                        <div class="mb-2  w-100">
                            <a href="<?= $menu_item->url; ?>" class=" text-decoration-none">
                                <?= $menu_item->title; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-3 mt-3">
                    <h5>Categorias de produto</h5>

                    <?php foreach($product_categories as $category){ ?>
                        <div class="mb-2 w-100">
                            <a  class="text-decoration-none" href="<?= get_term_link($category->slug, 'product_cat'); ?>">
                                <?= $category->name; ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-md-3 social__links mt-3">
                    <h5>Entre em contato</h5>

                    <?php if(get_option('site_phone')){ ?>
                        <a href="tel:<?= get_option('site_phone') ?>" class="d-flex align-items-center text-decoration-none mb-2" target="_blank">
                            <i class="bxr bx-phone"></i> 
                            <span><?= get_option('site_phone') ?></span>
                        </a>
                    <?php } ?>

                    <?php if(get_option('site_email')){ ?>
                        <a href="mailto:<?= get_option('site_email') ?>" class="d-flex align-items-center text-decoration-none mb-2" target="_blank">
                            <i class="bxr bx-envelope"></i> 
                            <span><?= get_option('site_email') ?></span>
                        </a>
                    <?php } ?>

                    <?php if(get_option('site_address')){ ?>
                        <a href="https://www.google.com/maps/place/<?= urlencode(get_option('site_address')) ?>" target="_blank" class="d-flex align-items-center text-decoration-none mb-2">
                            <i class="bxr bx-map"></i> 
                            <span><?= get_option('site_address') ?></span>
                        </a>
                    <?php } ?>

                    <ul class="list-unstyled d-flex flex-row align-items-center gap-2 mt-3">
                        <?php foreach($social_links as $key => $link) { ?>
                            <?php if(isset($link) && $link !== "") { ?>
                                <li>
                                    <a href="<?= $link ?>" target="_blank">
                                        <i class="bxl  bx-<?= $key ?>"  ></i> 
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>     
                    </ul>
                </div>
            </div>
        </div>


        <div class="py-3">
            <div class="container text-center">
                <hr />
                <span class="" style="margin: 0;">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os direitos reservados.</span>
            </div>
        </div>
    </footer>

    <?php 
    if(isset($whatsapp_msg) && $whatsapp_msg !== "") {
        import_component("whatsapp-modal", []);
    }
    ?>
    <?php wp_footer(); ?>
    <?php
}