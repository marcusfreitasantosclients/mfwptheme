<?php
function mf_whatsapp_modal($component_data){
    $whatsapp_number = get_option('site_whatsapp');
    $whatsapp_msg = get_option('site_whatsapp_msg');
    $whatsapp_modal_text = get_option('site_whatsapp_modal_text');
    $whatsapp_custom_link = "https://api.whatsapp.com/send?phone=$whatsapp_number&text=$whatsapp_msg";
    ?>

    <a class="whatsapp__custom_btn" href="<?php echo $whatsapp_custom_link; ?>" target="_blank">
        <i class="bxl  bx-whatsapp"></i>  
    </a>

    <div class="whatsapp__popup">
        <button class="custom__popup_close">
            <i class="bx  bx-x-circle"></i> 
        </button>
        <h4><?= $whatsapp_modal_text; ?></h4>
    </div>

<?php }