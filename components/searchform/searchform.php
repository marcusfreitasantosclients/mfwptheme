<?php 
    function mf_searchform($component_data){ ?>
        <form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
            <div class="input-group align-items-center">
                <input type="text" class="flex-grow-1" placeholder="Search" aria-label="Search form" aria-describedby="button-addon2" name="s" id="s">
                <i class="bx bx-search d-none d-md-block" ></i>
             </div>
        </form>
    <?php }
?>

