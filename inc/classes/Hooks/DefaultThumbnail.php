<?php
/**
 * Bootstrap Basic FSE - Show default thumbnail if there is no post feature image.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Hooks;


if (!class_exists('\\BootstrapBasicFSE\Hooks\\DefaultThumbnail')) {
    /**
     * Default thumbnail class.
     * 
     * @since 0.0.1
     */
    class DefaultThumbnail implements \BootstrapBasicFSE\Interfaces\AutoRegisterInterface
    {


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_filter('post_thumbnail_html', [$this, 'setDefaultPostThumbnail'], 10, 5);
        }// registerHooks


        /**
         * Set default post thumbnail if there is no post feature image.
         * 
         * @link https://developer.wordpress.org/reference/hooks/post_thumbnail_html/ Reference
         * @since 0.0.1
         * @param string $html The post thumbnail HTML.
         * @param int $post_id The post ID.
         * @param int $post_thumbnail_id The post thumbnail ID, or 0 if there isn’t one.
         * @param string|array $size Requested image size. Can be any registered image size name, or an array of width and height values in pixels (in that order).
         * @param string|array $attr Query string or array of attributes.
         * @return string
         */
        public function setDefaultPostThumbnail(string $html, int $post_id, int $post_thumbnail_id, string|array $size, string|array $attr): string
        {
            if (intval($post_thumbnail_id) !== 0) {
                // if there is post feature image.
                return $html;
            }

            /**
             * Set default thumbnail on singular page (single post, page).
             * 
             * @since 0.0.1
             * @param bool $set_default_on_singular Set to `true` to set default image on singular post. Default is `false`.
             */
            $set_default_on_singular = apply_filters('bootstrap_basic_fse_default_thumbnail_on_singular', false);

            /**
             * Set default thumbnail on list posts.
             * 
             * @since 0.0.1
             * @param bool $set_default_on_listing Set to `true` to set default image on list posts. Default is `true`.
             */
            $set_default_on_listing = apply_filters('bootstrap_basic_fse_default_thumbnail_on_listing', false);

            if (is_singular() && false === $set_default_on_singular) {
                // if it is singular and mark to not set default image on singular.
                return $html;
            }
            if ((is_home() || is_archive() || is_tax() || is_search()) && false === $set_default_on_listing) {
                // if it is listing and mark to not set default image on listing.
                return $html;
            }
            unset($set_default_on_listing, $set_default_on_singular);

            /**
             * Default thumbnail URL.
             * 
             * @since 0.0.1
             * @param string $image_url The default image URL without any HTML tag.
             */
            $image_url = apply_filters('bootstrap_basic_fse_default_thumbnail_url', get_theme_file_uri('assets/imgs/default-image.webp'));

            $html = '<img';
            if (is_string($size) && 'post-thumbnail' === strtolower($size)) {
                $html .= ' class="attachment-post-thumbnail size-post-thumbnail wp-post-image img-fluid"';
            } else {
                $html .= ' class="img-fluid"';
            }
            $html .= ' src="' . esc_url($image_url) . '"';
            unset($image_url);
            $html .= ' alt="' . (isset($attr['alt']) ? esc_attr($attr['alt']) : '') . '"';
            if (isset($attr['style'])) {
                $html .= ' style="' . $attr['style'] . '"';
            }
            $html .= ' height="1080" width="1920"';
            $html .= '>';// close `<img` tag.
            return $html;
        }// setDefaultPostThumbnail


    }// DefaultThumbnail
}
