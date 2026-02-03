<?php
/**
 * Title: Post categories, tags
 * Slug: bootstrap-basic-fse/hidden-post-taxonomy
 * Inserter: no
 *
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * 
 * @license http://opensource.org/licenses/MIT MIT
 */
?>

<!-- wp:group {"className":"clearfix","layout":{"type":"constrained"}} -->
<div class="wp-block-group clearfix">
    <!-- wp:post-terms {"term":"category","prefix":"<?php esc_html_e('Categories: ', 'bootstrap-basic-fse'); ?>","className":"d-inline me-3 ms-0"} /-->

    <!-- wp:post-terms {"term":"post_tag","prefix":"<?php esc_html_e('Tags: ', 'bootstrap-basic-fse'); ?>","className":"d-inline mt-0 ms-0"} /-->
</div>
<!-- /wp:group -->