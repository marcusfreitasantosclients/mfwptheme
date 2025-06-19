<?php
function mf_dashboard_nav_menu(){ ?>
    <nav class="navbar navbar-expand-lg navbar-light rounded my-3 mf_dashboard_nav_menu">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="<?php echo esc_url( wc_get_account_endpoint_url( '' ) ); ?>">
                <i class="bxr  bx-arrow-left-stroke"></i> 
                Dashboard
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#accountNavbar" aria-controls="accountNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="accountNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>">Orders</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-address' ) ); ?>">Addresses</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>">Account Details</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
<?php }