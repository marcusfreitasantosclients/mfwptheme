<?php
/*
Theme Name: MF WP Theme
Author: Marcus Freitas
Author URI: https://mafreitas.com.br
Description: A custom WordPress theme
Version: 1.0
License: GNU General Public License v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

define('THEME_DIR', get_template_directory());
define('THEME_URL', get_template_directory_uri());
require_once('inc/general-setup/general-setup.php');
require_once('inc/custom-post-types/cpt-gallery.php');
require_once('inc/custom-post-types/cpt-popups.php');
require_once('api-routes.php');
global $version;


function theme_enqueue_styles_and_scripts() {
    global $version;
    $version = "1.0";
    //CSS
    wp_enqueue_style('bootstrap-css', THEME_URL . '/assets/libs/bootstrap/css/bootstrap.min.css', [], $version);
    wp_enqueue_style('lightbox-css', THEME_URL . '/assets/libs/lightbox/css/lightbox.min.css', [], $version);
    wp_enqueue_style('splide-css', THEME_URL . '/assets/libs/splide/css/splide.min.css', [], $version);
    wp_enqueue_style('theme-style', get_stylesheet_uri(), [], $version);

    //JS
    wp_enqueue_script('bootstrap-js', THEME_URL . '/assets/libs/bootstrap/js/bootstrap.bundle.min.js', ['jquery'], $version);
    wp_enqueue_script('lightbox-js', THEME_URL . '/assets/libs/lightbox/js/lightbox.min.js', ['jquery'], $version);
    wp_enqueue_script('splide-js', THEME_URL . '/assets/libs/splide/js/splide.min.js', ['jquery'], $version);
    wp_enqueue_script('wc-add-to-cart-variation');
    wp_enqueue_script('main-js', THEME_URL . '/assets/js/main.js', ['jquery'], $version);
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles_and_scripts');


function send_data_to_main_js() {
  wp_localize_script( 'main-js', 'current_user_data', [
    'site_url' => site_url(),
  ] );
}
add_action( 'wp_enqueue_scripts', 'send_data_to_main_js' );


function menus_setup() {
    // Enable support for WordPress menus
    register_nav_menus( array(
        'header' => __( 'Header Menu', 'MF Home Design' ),
        'footer'  => __( 'Footer Menu', 'MF Home Design' ),
    ) );
}
add_action( 'after_setup_theme', 'menus_setup' );


//Import files components
function import_component($component_name, $component_data) {
    global $version;
    $component_path = THEME_DIR . '/components/' . $component_name;
    $component_render = 'mf_' . $component_name;

    if (is_dir($component_path)) {  
        // Enqueue CSS
        $component_css = THEME_DIR . '/components/'.$component_name.'/'.$component_name.'.css';
        if (file_exists($component_css)) {
            wp_enqueue_style('component-' . $component_css, THEME_URL .'/components/'.$component_name.'/'.$component_name.'.css', [], $version);
        }

        // Enqueue JS
        $component_js = THEME_DIR . '/components/'.$component_name.'/'.$component_name.'.js';
        if (file_exists($component_js)) {
            wp_enqueue_script('component-' . $component_js, THEME_URL .'/components/'.$component_name.'/'.$component_name.'.js', [], $version, true);
        }

        // Enqueue PHP
        $component_php = THEME_DIR . '/components/'.$component_name.'/'.$component_name.'.php';
        if (file_exists($component_php)) {            
            include_once($component_php);
            $component_render = str_replace('-', '_', $component_render);
            
            if(function_exists($component_render)) echo $component_render($component_data[$component_name]);
        }
    }
}


function query_cpt_based_on_type($type){
    $query = new WP_Query( [
        'post_type' => $type,
        'posts_per_page' => -1,
        'order_by' => 'title',
    ]);

    return $query->posts;
}


function get_product_categories($category_ids=[]){
    $category = get_term_by( 'slug', 'uncategorized', 'product_cat' );
    $uncategorized_id = $category->term_id;
    $categories_to_include = $category_ids ? $category_ids : "";
    $product_cat_args = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
        'exclude'     => [$uncategorized_id],
        'include'   =>  $categories_to_include,
        'hide_empty' => false
    );
    $product_categories = get_terms($product_cat_args);
    
    $filtered_categories = array_filter($product_categories, function($category) {
        return $category->parent == 0;
    });
    
    return $product_categories;
}


function get_product_brands($brand_ids=[]){
  $brands_to_include = $brand_ids ? $brand_ids : "";
  $product_brand_args = array(
      'taxonomy'   => 'product_brand',
      'orderby'    => 'menu_order',
      'order'      => 'ASC',
      'include'   =>  $brands_to_include,
      'hide_empty' => true
  );
  $product_brands = get_terms($product_brand_args);
  
  $filtered_brands = array_filter($product_brands, function($brand) {
      return $brand->parent == 0;
  });
  
  return $filtered_brands;
}


function send_form_data(WP_REST_Request $request){
    $form_data = json_decode($request->get_body(), true);
    $email_to = $form_data['targetEmails'] !== "" ? explode(',', $form_data['targetEmails']) : [get_option('site_email')];
    $headers[] = 'Content-Type: text/html; charset=UTF-8';
    $headers[] = 'From: ' . get_bloginfo('name') . '<' . get_option('site_email') . '>';

    $email_body = '
    <html lang="en">
      <body>
        <table style="width: 100%; font-family: Lato, sans-serif;">
          <thead style="background: #2b3a4d; text-align: left;">
            <tr>
              <th colspan="2" style="padding: 20px; color: white;">Contact</th>
            </tr>
          </thead>
          <tbody>
            <tr style="display: block; border-bottom: 1px solid #e5e5e5;">
              <td style="padding: 10px; color: #202020; width: 100px;"><b>Name:</b></td>
              <td style="padding: 10px; color: #202020;">' . esc_html($form_data['name']) . '</td>
            </tr>
            <tr style="display: block; border-bottom: 1px solid #e5e5e5;">
              <td style="padding: 10px; color: #202020; width: 100px;"><b>E-mail</b></td>
              <td style="padding: 10px; color: #202020;">' . esc_html($form_data['email']) . '</td>
            </tr>
            <tr style="display: block; border-bottom: 1px solid #e5e5e5;">
              <td style="padding: 10px; color: #202020; width: 100px;"><b>Subject</b></td>
              <td style="padding: 10px; color: #202020;">' . esc_html($form_data['subject']) . '</td>
            </tr>
            <tr style="display: block; border-bottom: 1px solid #e5e5e5;">
              <td style="padding: 10px; color: #202020; width: 100px;"><b>Message</b></td>
              <td style="padding: 10px; color: #202020;">' . nl2br(esc_html($form_data['message'])) . '</td>
            </tr>
          </tbody>
          <tfoot style="text-align: left;">
            <tr>
              <th colspan="2" style="font-size: 10px; color: #005c9b; font-weight: 100; margin-top: 30px; display: block;">
                Message sent from <a href="' . site_url() . '" target="_blank">' . get_bloginfo('name') . '</a>
              </th>
            </tr>
          </tfoot>
        </table>
      </body>
    </html>';

    $email_sent = wp_mail($email_to, $form_data['subject'], $email_body, $headers);

    if ( $email_sent ) {
      return new WP_REST_Response(
        array(
          'status' => 200,
          'body_response' => 'E-mail sent succesfully',
          'email_status' => 'sent'
        ),
        200
      );
    } else {
      return new WP_Error(
        'email_failed',
        'Failed to send email.',
        array(
          'status' => 500,
          'email_status' => 'not_sent'
        )
      );
    }   
}

function redirect_from_designer_single_page_to_store(){
  if(is_single() && get_post_type() == "designer"){
    global $post;
    $current_designer_id = $post->ID;
    wp_redirect(wc_get_page_permalink("shop") . "/?designer_id=$current_designer_id");
    exit;
  }
}
add_action("template_redirect", "redirect_from_designer_single_page_to_store");


function add_woocommerce_support() {
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_woocommerce_support');


function get_filtered_content($request) {
  $params = [
    'post_type'      => isset($request['post_type']) ? $request['post_type'] : 'product',
    'name'           => isset($request['name']) ? $request['name'] : '',
    'categories'     => isset($request['categories']) ? explode(",", $request['categories']) : [],
    'brands'         => isset($request['brands']) ? explode(",", $request['brands']) : [],
    'posts_per_page' => isset($request['posts_per_page']) ? $request['posts_per_page'] : 12,
    'paged'          => isset($request['page']) ? $request['page'] : 1,
  ];

  $tax_query = [];

  // Category filter (taxonomy: product_cat)
  if (!empty($params['categories'])) {
    $tax_query[] = [
      'taxonomy' => 'product_cat',
      'field'    => is_numeric($params['categories'][0]) ? 'term_id' : 'slug',
      'terms'    => $params['categories'],
    ];
  }

  // Brand filter (taxonomy: product_brand)
  if (!empty($params['brands'])) {
    $tax_query[] = [
      'taxonomy' => 'product_brand',
      'field'    => 'slug',
      'terms'    => $params['brands'],
    ];
  }

  $meta_query = [];
  
  $query_args = [
    'post_type'      => $params['post_type'],
    'posts_per_page' => $params['posts_per_page'],
    'paged'          => $params['paged'],
    's'              => $params['name'],
  ];

  if (!empty($tax_query)) {
    $query_args['tax_query'] = $tax_query;
  }

  if (!empty($meta_query)) {
    $query_args['meta_query'] = $meta_query;
  }

  return new WP_Query($query_args);
}



function render_dynamic_content_based_on_post_type(WP_REST_Request $request) {
  $content_found = get_filtered_content($request);

  $content_components = '';

  if ($content_found->have_posts() && $request['post_type'] == "product") {
      while ($content_found->have_posts()) {
          $content_found->the_post();

          ob_start(); // Start output buffering
          ?>
          <div class="col-md-4">
              <?php
                  import_component('product-card', [
                      'product-card' => get_the_ID(),
                  ]);
              ?>
          </div>
          <?php
          $content_components .= ob_get_clean(); // Append buffered output
      }

      wp_reset_postdata();
  }

  return rest_ensure_response([
      'total'          => $content_found->found_posts,
      'posts_total'   => count($content_found->posts),
      'page'           => $request['page'],
      'results'        => $content_found->posts,
      'content_cards'  => $content_components,
  ]);
}


add_filter('loop_shop_per_page', 'custom_loop_shop_per_page', 20);
function custom_loop_shop_per_page($cols) {
    return 12;
}


function allow_svg_uploads($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'allow_svg_uploads');


add_filter('wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    if (pathinfo($filename, PATHINFO_EXTENSION) === 'svg') {
        $data['ext'] = 'svg';
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}, 10, 4);


function show_popup_based_on_current_page(){
  $currentPageID = is_shop() ? woocommerce_get_page_id('shop') : get_the_ID();
    $currentPostType = get_post_type($currentPageID);

    $args = [
        'post_type'  => 'popup',
        'meta_query' => [
            'relation' => 'OR',
            [
                'key'     => 'pages',
                'value'   => '"' . $currentPageID . '"',
                'compare' => 'LIKE',
            ],
            [
                'key'     => 'dynamic_content',
                'value'   => '"' . $currentPostType . '"',
                'compare' => 'LIKE',
            ]
        ],
        'posts_per_page' => 1,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        $query->the_post();
        import_component('popup', [
            'popup' => [
              'ID' => get_the_ID(),
            ],
        ]);
    }
    wp_reset_postdata();

}
add_action('wp_footer', 'show_popup_based_on_current_page');


function concat_target_emails($target_emails){
  $target_emails_addresses = [];
  $site_email = get_option("site_email");

  if (is_array($target_emails) && !empty($target_emails)) {
      foreach($target_emails as $email) {
          if (is_email($email['email_address'])) {
              $target_emails_addresses[] = sanitize_email($email['email_address']);
          }
      }
      $target_emails_addresses = implode(',', $target_emails_addresses);
  }

  return empty($target_emails_addresses) ? $site_email : $target_emails_addresses;
}

?>