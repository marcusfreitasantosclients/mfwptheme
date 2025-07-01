<?php function mf_cart_empty(){ ?>
  <div class="container text-center my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <i class='bx  bx-confused cart_empty_icon'></i> 
        <h1 class="mb-3">Seu carrinho está vazio.</h1>
        <p class="lead mb-4">
          Visite a loja e comece a adicionar produtos ao seu carrinho.
        </p>



          <?php 
          $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
          import_component('button', [
              'button' => [
                  'text'     => "Ver produtos",
                  'url'      => esc_url($shop_page_url),
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
<?php }