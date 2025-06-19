<?php
function mf_dynamic_carousel($component_data){
    ?>
    <section class="py-5 my-5">
        
        <div class='container'>
            <div class='row align-items-center'>
                <div class='col-12 text-center mb-5'>
                    <?php import_component('simple-text', [
                        'simple-text' => [
                            'title' => $component_data['title'],
                            'text' => $component_data['text'],
                        ]
                    ]) ?>
                </div>

                <div class='col-12'>
                    <div class="row">
                        <?php if($component_data['featured_posts']){ ?>
                            <div class="splide mf_dynamic_carousel">
                                <div class="splide__track">
                                    <div class="splide__list">
                                        <?php foreach($component_data['featured_posts'] as $current_post){ ?>
                                            <div class="col-md-4 my-2 splide__slide">
                                                <?php
                                                    import_component('dynamic-carousel-item', [
                                                        'dynamic-carousel-item' => $current_post
                                                    ]);
                                                ?>                                
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }