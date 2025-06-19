<?php
function mf_simple_text($component_data){ ?>
    <div class="w-100 mf_simple_text">
        <?php if(isset($component_data['title'])){ ?>
            <h2>
                <?= $component_data['title'] ?>
            </h2>
        <?php } ?>

        <?php if(isset($component_data['text'])){ ?>
            <div class="w-100">
                <?= $component_data['text'] ?>
            </div>
        <?php } ?>

        <?php if(isset($component_data['cta'])){
            import_component('button', [
                'button' => [
                    'text'     => $component_data['cta']['title'],
                    'url'      => $component_data['cta']['url'],
                    'target'   => '_blank',
                    'type'     => 'primary',
                    'color'    => 'dark'
                ]
            ]);
        } ?>
    </div>
<?php }