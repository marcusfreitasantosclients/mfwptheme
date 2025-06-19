<?php
defined('ABSPATH') || exit;
?>

<?php 
if(is_wc_endpoint_url()){
    import_component("dashboard-nav-menu", ["dashboard-nav-menu" => []]);
}
?>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-md-12">
            <div class="woocommerce-MyAccount-content">
                <?php do_action('woocommerce_account_content'); ?>
            </div>
        </div>
    </div>
</div>
