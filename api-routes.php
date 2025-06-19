<?php
add_action( 'rest_api_init', function () {
    register_rest_route( 'forms/v2', '/send-form-data', array(
      'methods' => 'POST',
      'callback' => 'send_form_data',
    ) );
} );

add_action( 'rest_api_init', function () {
  register_rest_route( 'content/v2', '/get-content', array(
    'methods' => 'GET',
    'callback' => 'render_dynamic_content_based_on_post_type',
    'permission_callback' => '__return_true',
  ) );
} );