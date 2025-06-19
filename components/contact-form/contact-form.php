<?php
function mf_contact_form($component_data){    
    $side_images = $component_data['side_images'];
    $target_emails = $component_data['target_emails'];
    ?>
    <section class="py-5">
        <div class='container'>
            <div class='row'>
                <div class='col-md-6 '>
                    <?php import_component('simple-text', [
                        'simple-text' => [
                            'title' => $component_data['title'],
                            'text' => $component_data['text'],
                        ]
                    ]) ?>


                    <form class="mf_contact_form position-relative mt-5" data-target-emails="<?= concat_target_emails($target_emails); ?>">
                        <?php import_component('loading-spinner', ['loading-spinner' => null]); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your name">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                        </div>
                        
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" name="message" placeholder="Your message"></textarea>
                        </div>
                        
                        <button type="submit" class="mf_default_btn btn btn-primary bg-dark">Send message</button>
                    </form>
                </div>

                <div class='col-md-6 mt-3 mt-md-0'>
                    <div class="row">
                        <?php if(isset($side_images) && !empty($side_images)){
                            $count = 0;
                            $is_gallery = sizeof($side_images) > 1;
                            foreach($side_images as $image){ 
                                $count++;
                                ?>
                                <div class="mb-4 <?= $count == 1 ? 'col-12' : 'col-md-6' ?>">
                                    <div class="mf_contact_form_image_wrapper" style="<?= $is_gallery ? 'height: 400px' : '' ?>">
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