<?php
/**
 * Title: Hero paper ripped and clouds
 * Slug: bootstrap-basic-fse/hero-paper-ripped-clouds
 * Categories: banner
 * Keywords: bootstrap basic, bird, smoke, flame, hero
 * Description: A hero section for display image banner in painting style.
 *
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */
?>
<!-- wp:group {"className":"mb-4 text-body-emphasis bg-white"} -->
<div class="wp-block-group mb-4 text-body-emphasis bg-white">
    <!-- wp:cover {
        "className":"rounded",
        "url":"<?php echo esc_url(get_theme_file_uri('assets/imgs/paper-ripped-clouds-1920x540.webp')); ?>",
        "dimRatio":30,
        "overlayColor":"white",
        "isUserOverlayColor":true,
        "contentPosition":"bottom center",
        "isDark":false,
        "style":{
            "color":{"duotone":"unset"},
            "dimensions":{"aspectRatio":"32/9"}
        }
    } -->
    <div class="wp-block-cover is-light has-custom-content-position is-position-bottom-center rounded">
        <img class="wp-block-cover__image-background" alt="" src="<?php echo esc_url(get_theme_file_uri('assets/imgs/paper-ripped-clouds-1920x540.webp')); ?>" data-object-fit="cover"/>
        <span aria-hidden="true" class="wp-block-cover__background has-white-background-color has-background-dim-30 has-background-dim"></span>
        <div class="wp-block-cover__inner-container">
            <!-- wp:paragraph {"className":"display-6","style":{"typography":{"textAlign":"center"}}} -->
            <p class="has-text-align-center display-6"><?php esc_html_e('Open up a new perspective', 'bootstrap-basic-fse'); ?></p>
            <!-- /wp:paragraph -->
        </div>
    </div>
    <!-- /wp:cover -->
</div>
<!-- /wp:group -->