<?php
/**
 * RundizStrap - Hook to enqueue style for `[gallery]` shortcode.
 * 
 * The gallery shortcode is created by WordPress.
 * 
 * @link https://codex.wordpress.org/Gallery_Shortcode Reference.
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundizstrap\Hooks;


if (!class_exists('\\Rundizstrap\Hooks\\GalleryShortcode')) {
    /**
     * Gallery shortcode class.
     * 
     * @since 0.0.1
     */
    class GalleryShortcode implements \Rundizstrap\Interfaces\AutoRegisterInterface
    {


        /**
         * Enqueue gallery style.
         *
         * @link https://developer.wordpress.org/reference/hooks/gallery_style/ Reference.
         * @since 0.0.1
         * @see `gallery_shortcode()`.
         */
        public function enqueueGalleryStyle()
        {
            global $post;
            if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'gallery')) {
                // if there is shortcode `[gallery]`.
                wp_enqueue_style('rundizstrap-gallery-shortcode');
            }
        }// enqueueGalleryStyle


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_action('wp_enqueue_scripts', [$this, 'enqueueGalleryStyle']);
        }// registerHooks


    }// GalleryShortcode
}
