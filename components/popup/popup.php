<?php     
function mf_popup($component_data){ 
    global $version;
    $component_css = THEME_DIR . '/components/contact-form/contact-form.css';
    $component_js = THEME_DIR . '/components/contact-form/contact-form.js';

    if (file_exists($component_css)) {
        wp_enqueue_style('component-' . $component_css, THEME_URL . '/components/contact-form/contact-form.css', [], $version);
    }

    if (file_exists($component_js)) {
        wp_enqueue_script('component-' . $component_js, THEME_URL . '/components/contact-form/contact-form.js', [], $version, true);
    }

    $title = get_field("title", $component_data->ID);
    $subtitle = get_field("subtitle", $component_data->ID);
    $side_img = get_field("side_image", $component_data->ID);
    $show_form = get_field("lead_form", $component_data->ID);
    $delay = get_field("delay", $component_data->ID);
    $target_emails = get_field("target_emails", $component_data->ID);

    ?>
    <div class="custom__popup" data-delay="<?= $delay ?>">
        <button class="custom__popup_close">
            <i class="bx  bx-x-circle"></i> 
        </button>

        <div class="custom__popup_img">
            <img src="<?= $side_img['url']; ?>" alt="<?= $side_img['alt'] ?>" />
        </div>

        <div class="custom__popup_form_wrapper">
            
            <h2><?= $title; ?></h2>
            <h3><?= $subtitle; ?></h2>
            
            <span class="custom__loader"></span>
            <?php if( $show_form && in_array('show', $show_form) ) { ?>
                <form class="mf_contact_form position-relative mt-5" data-target-emails="<?= concat_target_emails($target_emails); ?>">
                    <?php import_component('loading-spinner', ['loading-spinner' => null]); ?>

                    <div class="mb-3">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Your name">
                    </div>
                    
                    <div class="mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
                    </div>
                    
                    <div class="mb-3">
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                    </div>
                    
                    <button type="submit" class="mf_default_btn btn btn-primary bg-dark">Send message</button>
                </form>
            <?php } ?>
        </div>
    </div>
<?php }
