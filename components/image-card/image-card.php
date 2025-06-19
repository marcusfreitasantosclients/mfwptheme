<?php
function mf_image_card($component_data){ ?>

    <a class="mf_image_card" style="background: url(<?= $component_data['image']['url'] ?>)" href="<?= $component_data['url']['url'] ?>" target="<?= $component_data['url']['target'] ?>">
        <h4 class="mf_image_card_title">
            <?= $component_data['title']; ?> 
        </h4>
    </a>
<?php }