<?php
/**
 * Title: Hero bird flame
 * Slug: bootstrap-basic-fse/hero-bird-flame
 * Categories: banner
 * Keywords: bootstrap basic, bird, smoke, flame, hero
 * Description: A hero section for display image banner with heading and paragraph text.
 *
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */
?>
<!-- wp:group {"className":"p-4 p-md-5 mb-4 rounded text-body-emphasis bg-white","style":{
        "background":{
            "backgroundImage":{"url":"<?php echo esc_url(get_theme_file_uri('assets/imgs/bird-flame-1920x768.webp')); ?>"},
            "backgroundSize":"cover",
            "backgroundPosition":"center",
            "backgroundRepeat":"no-repeat"
        }
    }} -->
<div class="wp-block-group p-4 p-md-5 mb-4 rounded text-body-emphasis bg-white">
    <!-- wp:rundizstrap-companion/blocks-bs-column {"className":"col-lg-6 px-0"} -->
    <div class="wp-block-rundizstrap-companion-blocks-bs-column col-lg-6 offset-lg-6 px-0">
        <!-- wp:heading {"level":1,"className":"display-4 fst-italic"} -->
        <h1 class="wp-block-heading display-4 fst-italic"><?php esc_html_e('Bootstrap Basic FSE', 'bootstrap-basic-fse'); ?></h1>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"className":"lead my-3"} -->
        <p class="lead my-3"><?php esc_html_e('A modern WordPress Block Theme (FSE) based on Bootstrap', 'bootstrap-basic-fse'); ?></p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:rundizstrap-companion/blocks-bs-column -->
</div>
<!-- /wp:group -->