<?php
function mf_icon_card($component_data){ 
    ?>
    <div class="mf_cards_side_img_icon_card d-flex flex-column gap-2">
        <div class="position-relative">
            <div class="mf_icon_card_img_wrapper">            
                <img class='img-fluid' src="<?= $component_data['icon'] ?>" alt="<?= $component_data['title'] ?>"  />
           </div>
            <div class="mf_cards_side_img_icon_bg_element"></div>
        </div>
        <h3><?= $component_data['title'] ?></h3>
        <p><?= $component_data['text'] ?></p> 
    </div>  
<?php }