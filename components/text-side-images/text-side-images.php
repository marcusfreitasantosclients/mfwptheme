<?php
function mf_text_side_images($component_data){
    $side_images = $component_data['side_images'];
    ?>
    <section class="py-5 my-5">
        <div class='container'>
            <div class='row'>
                <div class='col-md-6'>
                    <?php import_component('simple-text', [
                        'simple-text' => [
                            'title' => $component_data['title'],
                            'text' => $component_data['text'],
                        ]
                    ]) ?>
                </div>

                <div class='col-md-6'>
                    <div class="row g-3">
                        <?php if(isset($side_images) && !empty($side_images)){
                            $is_gallery = sizeof($side_images) > 1;
                            foreach($side_images as $image){ ?>
                                <div class="<?= $is_gallery ? 'col-md-6' : 'col-12' ?>">
                                    <div class="mf_text_side_images_image_wrapper" style="<?= $is_gallery ? 'height: 300px' : '' ?>">
                                        <img class="img-fluid" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" />                          
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }