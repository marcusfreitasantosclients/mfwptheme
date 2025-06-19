<?php

function mf_header($component_data){ 
    global $post;
    $theme_location = 'header';
    $menu_items = [];
    $post_slug = isset($post) ? $post->post_name : "";
    
    if (($locations = get_nav_menu_locations()) && isset($locations[$theme_location]) ) {
        $menu = get_term( $locations[$theme_location], 'nav_menu' );
        $menu_items = wp_get_nav_menu_items($menu->term_id);
    }

    ?>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <!-- Logo / Brand -->

                <a class="navbar-brand" href="<?= home_url() ?>">
                    <?php if(get_option('site_logo_header')){ ?>
                        <img src="<?= get_option('site_logo_header') ?>" alt="Logo" class="img-fluid" style="width: 120px; height: auto;">
                    <?php } else{ ?>
                        LOGO
                    <?php } ?>
                </a>
                
                <!-- Toggle Button for Mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navigation Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto gap-2">
                        <?php
                        // Group menu items by parent ID
                        $menu_tree = [];
                        foreach ($menu_items as $item) {
                            $menu_tree[$item->menu_item_parent][] = $item;
                        }

                        // Recursive function to render menu items
                        function render_menu_items($parent_id, $menu_tree) {
                            foreach ($menu_tree[$parent_id] ?? [] as $item) {
                                $is_active = get_page_link() == $item->url ? " active " : "";
                                $has_children = !empty($menu_tree[$item->ID]);
                                $classes = implode(' ', $item->classes ?? []);
                                if ($has_children) {
                                    echo '<li class="nav-item dropdown ' . esc_attr($classes) . $is_active . '">';
                                    echo '<a class="nav-link dropdown-toggle" href="' . esc_url($item->url) . '" id="menu-item-' . $item->ID . '" role="button" data-bs-toggle="dropdown" aria-expanded="false" target="' . esc_attr($item->target) . '">' . esc_html($item->title) . '</a>';
                                    echo '<ul class="dropdown-menu" aria-labelledby="menu-item-' . $item->ID . '">';
                                    render_menu_items($item->ID, $menu_tree);
                                    echo '</ul>';
                                    echo '</li>';
                                } else {
                                    echo '<li class="nav-item ' . esc_attr($classes) . $is_active . '">';
                                    echo '<a class="nav-link" href="' . esc_url($item->title == "Logout" ? wp_logout_url(home_url()) : $item->url) . '" target="' . esc_attr($item->target) . '">' . esc_html($item->title) . '</a>';
                                    echo '</li>';
                                }
                            }
                        }

                        render_menu_items(0, $menu_tree);
                        ?>

                        <li class="nav-item">
                            <a class="nav-link d-flex justify-content-start justify-content-md-center align-items-center" href="<?= wc_get_page_permalink( 'myaccount' ); ?>">
                                <span class="d-block d-md-none">My account</span>
                                <i class="bx bx-user d-none d-md-block" ></i>
                            </a>
                        </li>

                        <li class="nav-item position-relative">
                            <a class="nav-link d-flex justify-content-start justify-content-md-center align-items-center" href="<?= wc_get_page_permalink('cart') ?>">
                                <i class="bx bx-cart" ></i>
                            </a>

                            <?php if(WC()->cart->get_cart_contents_count() > 0){ ?>
                                <span class="cart_count badge rounded-pill bg-danger">
                                    <?= WC()->cart->get_cart_contents_count() ?>
                                </span>
                            <?php } ?>
                        </li>


                        <?php if(!wp_is_mobile()){ ?>
                            <li class="nav-item">
                                <?php import_component('searchform', ['searchform' => []]); ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

<?php }