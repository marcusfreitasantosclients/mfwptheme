<?php
function mf_text_with_image_cards($component_data){ ?>
    <section class="py-3">
        <div class="container">
            <div class="row justify-content-start g-3">
                <div class="col-md-12">
                    <?php if(isset($component_data['title'])){ ?>
                        <h2 class="mf_text_with_image_cards_title"><?= $component_data['title'] ?></h2>
                    <?php } ?>

                    <?php if(isset($component_data['subtitle'])){ ?>
                        <h3 class="mf_text_with_image_cards_subtitle"><?= $component_data['subtitle'] ?></h3>
                    <?php } ?>
                
                    <?php if(isset($component_data['text'])){ ?>
                        <div class="mf_text_with_image_cards_text">
                            <?= $component_data['text'] ?>
                        </div>
                    <?php } ?>
                </div>

                <?php if(isset($component_data['image_cards']) && is_array($component_data['image_cards'])){ ?>
                    <?php foreach($component_data['image_cards'] as $image_card){ ?>
                        
                        <div class="col-md-2 mf_text_with_image_cards_image_wrapper d-flex flex-column align-items-center gap-2 text-center">
                            <img src="<?= $image_card['image']['url'] ?>" alt="<?= $image_card['title'] ?>" />
                            <h4 class="mf_text_with_image_cards_button_text"><?= $image_card['title'] ?></h4>

                            <?php if($image_card['button']){ ?>
                                <?php 
                                    import_component('button', [
                                        'button' => [
                                            'text'     => "Request Samples",
                                            'url'      => esc_url(home_url('/finishes')),
                                            'target'   => '_self',
                                            'type'     => 'secondary',
                                            'color'    => 'light'
                                        ]
                                    ]);
                                ?>
                            <?php } ?>
                        </div>

                    <?php } ?>
                <?php } ?>


                <?php if(isset($component_data['legal_text'])){ ?>
                    <div class="col-12 my-2 mf_text_with_image_cards_legal_text">
                        <p><?= $component_data['legal_text'] ?></p>
                    </div>
                <?php } ?>

                <div class="col-12">
                    <hr/>
                </div>
            </div>
        </div>
    </section>
<?php }