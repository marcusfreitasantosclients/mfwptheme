<?php get_header(); ?>
<?php wc_print_notices(); ?>

<?php import_component("single-product", [
    "single-product" => [
        "product_id" => get_the_ID()
    ]
]) ?>

<?php get_footer(); ?>