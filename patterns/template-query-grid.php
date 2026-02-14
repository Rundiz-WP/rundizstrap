<?php
/**
 * Title: BBFSE List posts as grid
 * Slug: bootstrap-basic-fse/template-query-grid
 * Categories: query
 * Block Types: core/query
 * Viewport width: 1400
 * Keywords: bootstrap basic, grid
 * Description: A list of posts, 3 columns.
 *
 * @package bootstrap-basic-fse
 * @since 0.0.1
 */


// mark default thumbnail on listing to `true`. special for this template pattern.
add_filter('bootstrap_basic_fse_default_thumbnail_on_listing', '__return_true');
?>
<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]}} -->
<div class="wp-block-query">
    <!-- wp:post-template {"className":"mb-5","layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"200px"}} -->
        <!-- wp:group {"tagName":"article","className":""} -->
        <article class="wp-block-group">
            <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"1"} /-->

            <!-- wp:post-title {"level":2,"isLink":true,"className":"h4"} /-->
        </article>
        <!-- /wp:group -->
    <!-- /wp:post-template -->

    <!-- wp:query-no-results -->
        <!-- wp:group {"className":"mb-5"} -->
        <div class="wp-block-group mb-5">
            <!-- wp:paragraph {"className":"m-0 lead"} -->
            <p class="m-0 lead"><?php echo esc_html_x('Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'bootstrap-basic-fse'); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    <!-- /wp:query-no-results -->

    <!-- wp:rundizstrap-companion/blocks-bs-pagination {"additionalClass":"mb-0","alignment":"justify-content-center","className": "mt-0 mb-5 mb-md-0"} /-->
</div>
<!-- /wp:query -->
