<?php get_header(); ?>

<div class="container text-center my-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h1 class="display-1 text-danger">404</h1>
      <h2 class="mb-3">Oops! Page not found.</h2>
      <p class="lead mb-4">
        The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
      </p>

        <?php 
        import_component('button', [
            'button' => [
                'text'     => "← Back to Home",
                'url'      => esc_url(home_url('/')),
                'target'   => '_self',
                'type'     => 'primary',
                'color'    => 'dark'
            ]
        ]);
        ?>

      <div class="row justify-content-center">
        <div class="mt-4 col-md-4">
          <?php import_component('searchform', ['searchform' => []]); ?>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
