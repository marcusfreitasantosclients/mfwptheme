<?php
function mf_cards_side_img($component_data){
    $show_dynamic_content = $component_data['show_dynamic_content'];
    $cards_content = [];

    if(isset($show_dynamic_content) && $show_dynamic_content[0] == "yes"){
        foreach($component_data['cards_with_dynamic_content'] as $dynamic_content){
            $current_post = get_post($dynamic_content, ARRAY_A);
            $cards_content[] = $current_post;
        }

    }else{
        $cards_content = $component_data['cards'];
    }

    ?>
    <section class='py-5 bg-light'>
        <div class='container'>
            <div class='row align-items-center'>
                <div class='col-md-6'>
                    <?php import_component('simple-text', [
                        'simple-text' => [
                            'title' => $component_data['title'],
                            'text' => $component_data['text'],
                        ]
                    ]) ?>

                    <?php if(is_array($cards_content) && !empty($cards_content)){ ?>
                        <div class="row">
                            <?php foreach($cards_content as $card){ 
                                $icon_card_content = [
                                    'title' => isset($card['title']) ? $card['title'] : $card['post_title'],
                                    'text' => isset($card['text']) ? $card['text']  : $card['post_content'],
                                    'icon' => isset($card['icon']) ? $card['icon'] : get_the_post_thumbnail_url($card['ID'])
                                ];

                                ?>
                                <div class="col-md-6 my-3">
                                    <?php import_component('icon-card', [
                                        'icon-card' =>  $icon_card_content
                                    ]);?>                 
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <div class='col-md-6'>
                    <div class='mf_cards_side_img'>                    
                        <img class="img-fluid" src="<?= $component_data['side_image']['url'] ?>" alt="<?= $component_data['side_image']['alt'] ?>"  />
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }