<?php
/**
 * Title: Post date & author
 * Slug: bootstrap-basic-fse/hidden-post-date-author
 * Inserter: no
 *
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * 
 * @license http://opensource.org/licenses/MIT MIT
 */

?>
<!-- wp:group {"className":"text-body-tertiary mt-0 mb-4","style":{"spacing":{"blockGap":"0.3rem"}},"fontSize":"small","layout":{"type":"flex","flexWrap":"wrap"}} -->
<div class="wp-block-group bootstrap-basic-fse-entry-meta text-body-tertiary mt-0 mb-4 has-small-font-size">
    <!-- wp:paragraph -->
    <p><?php esc_html_e('Posted on', 'bootstrap-basic-fse'); ?></p>
    <!-- /wp:paragraph -->

    <!-- wp:post-date {"isLink":true,"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"style":{"spacing":{"margin":{"right":"var:preset|spacing|20"}}}} /-->

    <!-- wp:paragraph -->
    <p><?php esc_html_e('by', 'bootstrap-basic-fse'); ?></p>
    <!-- /wp:paragraph -->

    <!-- wp:post-author-name {"isLink":true} /-->
</div>
<!-- /wp:group -->