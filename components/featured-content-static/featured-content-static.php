<?php
function mf_featured_content_static($component_data){
    ?>
    <section class="py-5 my-5">
        <div class='container'>
            <div class='row align-items-center'>
                <div class='col-md-4'>
                    <?php import_component('simple-text', [
                        'simple-text' => [
                            'title' => $component_data['title'],
                            'text' => $component_data['text'],
                            'cta'   => $component_data['call_to_action']
                        ]
                    ]) ?>
                </div>

                <div class='col-md-8'>
                    <div class="row">
                        <?php if($component_data['featured_posts']){
                            foreach($component_data['featured_posts'] as $content){ ?>
                                <div class="col-md-4 my-2">
                                    <?php
                                        import_component('image-card', [
                                            'image-card' => $content,
                                        ]);
                                    ?>                                
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }