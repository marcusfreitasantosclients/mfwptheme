<?php
get_header();

$components = get_field('component_select');
if($components){
    foreach ($components as $component) {
        $component_name = $component['model'];
        import_component($component_name, $component);
    }
}
?>

<section>
    <div class="container">
        <?php the_content(); ?>
    </div>
</section>

<?php
get_footer();