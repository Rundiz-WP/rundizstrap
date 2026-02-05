<?php
/**
 * Title: Comments
 * Slug: bootstrap-basic-fse/comments
 * Description: Comments area with comments list, pagination, and comment form.
 * Categories: text
 * Block Types: core/comments
 *
 * @package bootstrap-basic-fse
 * @since 0.0.1
 */

?>
<!-- wp:comments {"tagName":"section","className":"wp-block-comments-query-loop mt-5 border-top border-secondary-subtle pt-5"} -->
<section class="wp-block-comments wp-block-comments-query-loop mt-5 border-top border-secondary-subtle pt-5">
    <!-- wp:heading -->
    <h2 class="wp-block-heading"><?php esc_html_e('Comments', 'bootstrap-basic-fse'); ?></h2>
    <!-- /wp:heading -->

    <!-- wp:comments-title {"level":3,"className":"mb-3"} /-->

    <!-- wp:comment-template -->
        <!-- wp:group {"className":"border rounded overflow-hidden mb-4"} -->
        <div class="wp-block-group border rounded overflow-hidden mb-4">
            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"top"},"className":"column-gap-2"} -->
            <div class="wp-block-group column-gap-2">
                <!-- wp:avatar {"size":50} /-->

                <!-- wp:group {"className":"me-2 mb-2"} -->
                <div class="wp-block-group bootstrap-basic-fse-comment-content-wrapper me-2 mb-2">
                    <!-- wp:comment-author-name {"className":"mt-0 mb-2","style":{"typography":{"fontStyle":"normal","fontWeight":"600"}}} /-->

                    <!-- wp:comment-date {"className":"mt-0 mb-2","fontSize":"small"} /-->

                    <!-- wp:comment-content /-->

                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                    <div class="wp-block-group">
                        <!-- wp:comment-edit-link {"fontSize":"small"} /-->

                        <!-- wp:comment-reply-link {"fontSize":"small"} /-->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    <!-- /wp:comment-template -->

    <!-- wp:comments-pagination {"layout":{"type":"flex","justifyContent":"space-between"},"className":"mb-4"} -->
        <!-- wp:comments-pagination-previous {"className":"btn btn-outline-secondary"} /-->
        <!-- wp:comments-pagination-next {"className":"btn btn-outline-secondary"} /-->
    <!-- /wp:comments-pagination -->

    <!-- wp:bbfse-plug/blocks-bs-comment-form /-->
</section>
<!-- /wp:comments -->
