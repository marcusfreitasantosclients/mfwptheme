<?php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <title><?= get_bloginfo('name') . ' | ' . get_bloginfo('description'); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= get_option('site_favicon'); ?>">
    <link href='<?= THEME_URL ?>/assets/libs/boxicons/basic/boxicons.css' rel='stylesheet'>
    <link href='<?= THEME_URL ?>/assets/libs/boxicons/brands/boxicons-brands.css' rel='stylesheet'>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php import_component('header', ['header' => []]); ?>


