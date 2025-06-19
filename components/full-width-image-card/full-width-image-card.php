<?php
function mf_full_width_image_card($component_data){ ?>

    <a class="row mf_full_width_image_card" href="<?= $component_data["permalink"] ?>" style="background: url(<?= $component_data["image"] ?>) ">
        <div class="col-md-10"></div>

        <div class="col-md-2 p-0 m-0">
            <div class="mf_horizontal_card_content_wrapper">
                <h2> <?= $component_data['title'] ?> </h2>
                <div class="mf_horizontal_card_content mb-3"> <?= $component_data['content'] ?> </div>
            </div>
        </div>
    </a>

<?php }