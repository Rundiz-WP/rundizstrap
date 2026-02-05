<?php
/**
 * Title: Bootstrap Basic FSE List of posts in search
 * Slug: bootstrap-basic-fse/template-query-loop-search
 * Categories: query
 * Block Types: core/query
 * Description: A list of posts for use with search result.
 *
 * @package bootstrap-basic-fse
 * @since 0.0.1
 */
?>
<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]}} -->
<div class="wp-block-query">
    <!-- wp:post-template {} -->
        <!-- wp:group {"tagName":"article","className":"border-bottom mb-5 pb-5"} -->
        <article class="wp-block-group border-bottom mb-5 pb-5">
            <!-- wp:post-title {"level":2,"isLink":true,"className":"h3"} /-->

            <!-- wp:post-excerpt {"moreText":"<?php esc_html_e('Read more', 'bootstrap-basic-fse'); ?>","className":"bootstrap-basic-fse-each-post-contents mt-0"} /-->
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

    <!-- wp:bbfse-plug/blocks-bs-pagination {"additionalClass":"mb-0","alignment":"justify-content-center","className": "mt-0 mb-5 mb-md-0"} /-->
</div>
<!-- /wp:query -->
