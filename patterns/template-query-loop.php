<?php
/**
 * Title: BBFSE List of posts
 * Slug: rundizstrap/template-query-loop
 * Categories: query
 * Block Types: core/query
 * Keywords: bootstrap basic, list posts
 * Description: A list of posts, with featured image, post date, author.
 *
 * @package rundizstrap
 * @since 0.0.1
 */
?>
<!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[]}} -->
<div class="wp-block-query">
    <!-- wp:post-template {} -->
        <!-- wp:group {"tagName":"article","className":"border-bottom mb-5 pb-5"} -->
        <article class="wp-block-group border-bottom mb-5 pb-5">
            <!-- wp:post-featured-image {"isLink":true,"aspectRatio":"3/1"} /-->

            <!-- wp:post-title {"level":2,"isLink":true,"className":"h3"} /-->

            <!-- wp:pattern {"slug":"rundizstrap/hidden-post-date-author"} /-->

            <!-- wp:post-content {"className":"rundizstrap-each-post-contents mt-0 rundizstrap-entry-content-readmore"} /-->
        </article>
        <!-- /wp:group -->
    <!-- /wp:post-template -->

    <!-- wp:query-no-results -->
        <!-- wp:group {"className":"border-top mb-4 p-5"} -->
        <div class="wp-block-group border-top mb-4 p-5">
            <!-- wp:paragraph {"className":"m-0 lead"} -->
            <p class="m-0 lead"><?php echo esc_html_x('Sorry, but nothing was found. Please try a search with different keywords.', 'Message explaining that there are no results returned from a search.', 'rundizstrap'); ?></p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    <!-- /wp:query-no-results -->

    <!-- wp:rundizstrap-companion/blocks-bs-pagination {"additionalClass":"mb-0","alignment":"justify-content-center","className": "mt-0 mb-5 mb-md-0"} /-->
</div>
<!-- /wp:query -->
