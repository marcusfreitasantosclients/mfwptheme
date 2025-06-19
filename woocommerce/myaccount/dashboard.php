<?php
defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
?>


<div class="py-4">
  <div class="row">
    <div class="col-12 mb-4">
      <h2 class="fw-bold">👋 Welcome, <?php echo esc_html( $current_user->display_name ); ?>!</h2>
      <p class="text-muted">Here’s a quick overview of your account.</p>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h5 class="card-title">📦 Recent Orders</h5>
          <p class="card-text">View your recent orders and their status.</p>
			<?php import_component('button', [
					'button' => [
						'text'     => "View Orders",
						'url'      => esc_url( wc_get_account_endpoint_url( 'orders' ) ),
						'target'   => "_self",
						'type'     => 'primary',
						'color'    => 'light'
					]
				]);
			?>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h5 class="card-title">🏠 Addresses</h5>
          <p class="card-text">Edit your billing and shipping addresses.</p>
		  <?php import_component('button', [
					'button' => [
						'text'     => "View Orders",
						'url'      => esc_url( wc_get_account_endpoint_url( 'edit-address' ) ),
						'target'   => "_self",
						'type'     => 'secondary',
						'color'    => 'light'
					]
				]);
			?>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h5 class="card-title">👤 Account Details</h5>
          <p class="card-text">Update your name, email, and password.</p>
		  <?php import_component('button', [
					'button' => [
						'text'     => "View Orders",
						'url'      => esc_url( wc_get_account_endpoint_url( 'edit-account' ) ),
						'target'   => "_self",
						'type'     => 'primary',
						'color'    => 'light'
					]
				]);
			?>
        </div>
      </div>
    </div>
  </div>
</div>
