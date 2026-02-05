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
<!-- wp:bbfse-plug/blocks-bs-container {"className":"container mb-3"} -->
<div class="wp-block-bbfse-plug-blocks-bs-container container mb-3">
    <!-- wp:bbfse-plug/blocks-bs-row {"className":"g-0"} -->
    <div class="wp-block-bbfse-plug-blocks-bs-row row g-0">
        <!-- wp:bbfse-plug/blocks-bs-column {"className":"col border-top border-5 pt-3 d-flex justify-content-start fw-light text-body-secondary"} -->
        <div class="wp-block-bbfse-plug-blocks-bs-column col border-top border-5 pt-3 d-flex justify-content-start fw-light text-body-secondary">
            <!-- wp:paragraph {"className":"p-0 my-0"} -->
            <p class="p-0 my-0"><?php printf(
                /* translators: %1$s open link tag, %2$s close link tag. */
                esc_html__('Powered by %1$sWordPress%2$s.', 'bootstrap-basic-fse'),
                '<a class="link-secondary" href="https://wordpress.org" target="wordpress">',
                '</a>'
            ); ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"className":"p-0 my-0 ms-1"} -->
            <p class="p-0 my-0 ms-1"><?php printf(
                /* translators: %1$s open link tag, %2$s close link tag. */
                esc_html__('Theme: %1$sBootstrap Basic FSE%2$s.', 'bootstrap-basic-fse'),
                '<a class="link-secondary" href="https://rundiz.com" target="rundiz-com">',
                '</a>'
            ); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:bbfse-plug/blocks-bs-column -->
    </div>
    <!-- /wp:bbfse-plug/blocks-bs-row -->
</div>
<!-- /wp:bbfse-plug/blocks-bs-container -->
