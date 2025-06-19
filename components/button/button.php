<?php
function mf_button($component_data){ 
    $button_url = $component_data['url'];
    $button_text = $component_data['text'];
    $button_target = $component_data['target'];
    $button_type = $component_data['type'];
    $button_color = 'bg-' . $component_data['color'];
    $button_color_text = $component_data['color'] == 'light' ? 'text-secondary' : 'text-light';

    ?>
    <a href='<?= $button_url ?>' target='<?= $button_target ?>' class="mf_default_btn <?= "$button_color_text $button_color" ?> rounded btn btn-<?=$button_type?>"><?= $button_text ?></a>
<?php }