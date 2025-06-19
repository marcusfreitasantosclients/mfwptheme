<?php
function add_general_theme_settings_page() {
    add_options_page(
        'General Theme Settings',        
        'General Theme Settings',       
        'manage_options',               
        'theme_settings',               
        'render_general_theme_settings_page'
    );
}
add_action('admin_menu', 'add_general_theme_settings_page');

// Função que renderiza a página de configurações
function render_general_theme_settings_page() {
    ?>
    <div class="wrap enterprise__configuration">    
        <form method="post" action="options.php">
            <?php
                settings_fields('group_theme_settings');
                do_settings_sections('theme_settings'); 
            ?>

            <!-- NAVIGATION -->
            <div class="tab__navigation">
                <a href="#general" class="active">General</a>
                <a href="#social">Social</a>
                <a href="#integration">Integrations</a>
            </div>

            <!-- GENERAL -->
            <div class="tab__section" id="general">
                <table class="form-table" >
                    <tr valign="top">
                        <th scope="row">Favicon</th>
                        <td>
                            <div class="configs__image configs__image-logo">
                                <?php if (get_option('site_favicon')): ?><img src="<?= get_option('site_favicon'); ?>"><?php endif; ?>
                                <input type="text" name="site_favicon" id="site_favicon" value="<?= get_option('site_favicon'); ?>" />
                                <button type="button" class="button" id="upload_favicon_button">Select Favicon</button>
                            </div>
                            <p class="description">Choose an image for the website's favicon.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Header logo</th>
                        <td>
                            <div class="configs__image">
                                <?php if (get_option('site_logo_header')): ?><img src="<?= get_option('site_logo_header'); ?>"><?php endif; ?>
                                <input type="text" name="site_logo_header" id="site_logo_header" value="<?= get_option('site_logo_header'); ?>" />
                                <button type="button" class="button" id="upload_logo_header_button">Selecionar Logo Header</button>
                            </div>
                            <p class="description">Choose an image for the website's header.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Footer logo</th>
                        <td>
                            <div class="configs__image">
                                <?php if (get_option('site_logo_footer')): ?><img src="<?= get_option('site_logo_footer'); ?>"><?php endif; ?>
                                <input type="text" name="site_logo_footer" id="site_logo_footer" value="<?= get_option('site_logo_footer'); ?>" />
                                <button type="button" class="button" id="upload_logo_footer_button">Selecionar Logo Footer</button>
                            </div>
                            <p class="description">Choose an image for the website's footer.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Footer text</th>
                        <td>
                            <input style="width: 50%;" type="text" name="site_footer_text" id="site_footer_text" value="<?= get_option('site_footer_text'); ?>" placeholder=""/>
                            <p class="description">Insert a short company description.</p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- SOCIAL -->
            <div class="tab__section" id="social" style="display:none">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">E-mail</th>
                        <td>
                            <input type="email" name="site_email" id="site_email" value="<?= get_option('site_email'); ?>" placeholder="contact@email.com" />
                            <p class="description">Insert the company e-mail address.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Address</th>
                        <td>
                            <input type="text" name="site_address" id="site_address" value="<?= get_option('site_address'); ?>" placeholder="" />
                            <p class="description">Insert the company address.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Phone number</th>
                        <td>
                            <input type="text" name="site_phone" id="site_phone" value="<?= get_option('site_phone'); ?>" placeholder="949.702.1093" />
                            <p class="description">Insert the Whatsapp number. Only numbers.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Whatsapp</th>
                        <td>
                            <input type="text" name="site_whatsapp" id="site_whatsapp" value="<?= get_option('site_whatsapp'); ?>" placeholder="55110000999" />
                            <p class="description">Insert the Whatsapp number. Only numbers.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Whatsapp Message</th>
                        <td>
                            <input type="text" name="site_whatsapp_msg" id="site_whatsapp_msg" value="<?= get_option('site_whatsapp_msg'); ?>" placeholder="Hi there! I need more details about your products." />
                            <p class="description">Insert the Whatsapp custom message.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Whatsapp Modal Text</th>
                        <td>
                            <input type="text" name="site_whatsapp_modal_text" id="site_whatsapp_modal_text" value="<?= get_option('site_whatsapp_modal_text'); ?>" placeholder="Hi there! I need more details about your products." />
                            <p class="description">Insert the Whatsapp modal text.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Facebook</th>
                        <td>
                            <input type="url" name="site_facebook" id="site_facebook" value="<?= get_option('site_facebook'); ?>" placeholder="https://facebook.com/" />
                            <p class="description">Facebook profile url.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Instagram</th>
                        <td>
                            <input type="url" name="site_instagram" id="site_instagram" value="<?= get_option('site_instagram'); ?>" placeholder="https://instagram.com/" />
                            <p class="description">Instagram profile url.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">LinkedIn</th>
                        <td>
                            <input type="url" name="site_linkedin" id="site_linkedin" value="<?= get_option('site_linkedin'); ?>" placeholder="https://linkedin.com/" />
                            <p class="description">Linkedin profile url.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">TikTok</th>
                        <td>
                            <input type="url" name="site_tiktok" id="site_tiktok" value="<?= get_option('site_tiktok'); ?>" placeholder="https://tiktok.com/" />
                            <p class="description">Tiktok profile url.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">X (Twitter)</th>
                        <td>
                            <input type="url" name="site_twitter" id="site_twitter" value="<?= get_option('site_twitter'); ?>" placeholder="https://twitter.com/" />
                            <p class="description">X (Twitter) profile url.</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">YouTube</th>
                        <td>
                            <input type="url" name="site_youtube" id="site_youtube" value="<?= get_option('site_youtube'); ?>" placeholder="https://youtube.com/" />
                            <p class="description">Youtube channel url.</p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- INTEGRATIONS -->
            <div class="tab__section" id="integration" style="display:none">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Google Tag Manager (GTM)</th>
                        <td>
                            <input type="text" name="site_gtm" id="site_gtm" value="<?= get_option('site_gtm'); ?>" placeholder="GTM-XXXXXX" />
                            <p class="description">Insira o ID do Google Tag Manager (exemplo: GTM-XXXXXX).</p>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Google Recaptcha V3</th>
                        <td>
                            <input type="text" name="site_google_recaptcha_site_key" id="site_google_recaptcha_site_key" value="<?= get_option('site_google_recaptcha_site_key'); ?>" placeholder="" />
                            <p class="description">Recaptcha site key</p>
                        </td>
                        <td>
                            <input type="text" name="site_google_recaptcha_secret_key" id="site_google_recaptcha_secret_key" value="<?= get_option('site_google_recaptcha_secret_key'); ?>" placeholder="" />
                            <p class="description">Recaptcha secret key</p>
                        </td>
                    </tr>
                </table>
            </div>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

//REGISTER SETUP OPTIONS
function register_theme_settings() {
    $settings = [
        'site_footer_text',
        'site_email',
        'site_address',
        'site_phone',
        'site_whatsapp',
        'site_whatsapp_modal_text',
        'site_whatsapp_msg',
        'site_favicon',
        'site_logo_header',
        'site_logo_footer',
        'site_facebook',
        'site_instagram',
        'site_linkedin',
        'site_tiktok',
        'site_twitter',
        'site_youtube',
        'site_gtm',
        'site_google_recaptcha_site_key',
        'site_google_recaptcha_secret_key',
    ];

    foreach ($settings as $setting) {
        register_setting('group_theme_settings', $setting);
    }
}
add_action('admin_init', 'register_theme_settings');

//ENQUUE SCRIPTS
function scripts_general_theme_settings() {
    wp_enqueue_media();
    wp_enqueue_script('general-setup-js', get_template_directory_uri() . '/inc/general-setup/general-setup.js', ['jquery'], null, true);
    wp_enqueue_style('general-setup-css', get_template_directory_uri() . '/inc/general-setup/general-setup.css');
}
add_action('admin_enqueue_scripts', 'scripts_general_theme_settings');