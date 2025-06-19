<?php
function mf_banner_video($component_data){
    $video_url_desktop = $component_data['video_url_desktop'];
    $video_url_mobile = $component_data['video_url_mobile'];
    $banner_url = $component_data['banner_url'];

    ?>

    <a class="mf_video_container" href="<?= $banner_url ?>">
        <video autobuffer="true" preload="auto" muted loop autoplay>
            <source src="<?= wp_is_mobile() ? $video_url_mobile : $video_url_desktop ?>"  type="video/mp4" />
            Your browser does not support the video tag.
        </video>
    </a>

<?php }