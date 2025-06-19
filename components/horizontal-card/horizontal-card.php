<?php
function mf_horizontal_card($component_data){ ?>
    <div class="row mb-4 mf_horizontal_card">
        <div class="col-md-4 mb-2">
            <div class="mf_horizontal_card_img_wrapper">
                <img class="img-fluid" src="<?= $component_data['image'] ?>" alt="<?= $component_data['title'] ?>" />
            </div>
        </div>

        <div class="col-md-8">
            <div class="mf_horizontal_card_content_wrapper">
                <h2> <?= $component_data['title'] ?> </h2>
                <div class="mf_horizontal_card_content mb-3"> <?= $component_data['content'] ?> </div>

                <?php
                import_component('button', [
                    'button' => [
                        'text'     => $component_data['link']['text'],
                        'url'      => $component_data['link']['url'],
                        'target'   => $component_data['link']['target'],
                        'type'     => 'primary',
                        'color'    => 'dark'
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
<?php }