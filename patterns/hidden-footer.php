<?php
/**
 * Title: Footer
 * Slug: bootstrap-basic-fse/hidden-footer
 * Inserter: no
 *
 * @package bootstrap-basic-fse
 * @since 0.0.1
 */

?>
<!-- wp:bbfse-plugin/blocks-bs-container {"className":"container mb-3"} -->
<div class="wp-block-bbfse-plugin-blocks-bs-container container mb-3">
    <!-- wp:bbfse-plugin/blocks-bs-row {"className":"g-0"} -->
    <div class="wp-block-bbfse-plugin-blocks-bs-row row g-0">
        <!-- wp:bbfse-plugin/blocks-bs-column {"className":"col border-top border-5 pt-3 d-flex justify-content-between fw-light text-body-secondary"} -->
        <div class="wp-block-bbfse-plugin-blocks-bs-column col border-top border-5 pt-3 d-flex justify-content-between fw-light text-body-secondary">
            <!-- wp:site-title {"level":0,"className":"p-0 m-0"} /-->

            <!-- wp:paragraph {"className":"p-0 m-0"} -->
            <p class="p-0 m-0"><?php printf(
                /* translators: %1$s open link tag, %2$s close link tag. */
                esc_html__('Powered by %1$sWordPress%2$s.', 'bootstrap-basic-fse'),
                '<a class="link-secondary" href="https://wordpress.org" target="wordpress">',
                '</a>'
            ); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:bbfse-plugin/blocks-bs-column -->
    </div>
    <!-- /wp:bbfse-plugin/blocks-bs-row -->
</div>
<!-- /wp:bbfse-plugin/blocks-bs-container -->
