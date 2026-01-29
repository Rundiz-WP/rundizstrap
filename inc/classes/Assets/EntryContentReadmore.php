<?php
/**
 * Load assets to work about entry content read more/less.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Assets;


use BootstrapBasicFSE\Libraries\WPOverride\Formatting;


if (!class_exists('\\BootstrapBasicFSE\\Assets\\EntryContentReadmore')) {
    /**
     * Entry content read more class.
     * 
     * @since 0.0.1
     */
    class EntryContentReadmore implements \BootstrapBasicFSE\Interfaces\AutoRegisterInterface
    {


        /**
         * Enqueue scripts & styles.
         * 
         * The assets in this method was registered on the `BootstrapBasicFSE` class.
         * 
         * @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/ Reference.
         * @since 0.0.1
         */
        public function enqueueScriptsStyles()
        {
            wp_enqueue_style('bootstrap-basic-fse-entry-content-readmore');

            // entry-content-readmore.js -------------------------------------------------------
            $linkClasses = 'btn btn-outline-secondary btn-sm rounded-pill';

            wp_localize_script(
                'bootstrap-basic-fse-entry-content-readmore',
                'BootstrapBasicFSEEntryContentReadmoreObj',
                [
                    /**
                     * Read more link CSS class.
                     * 
                     * @since 0.0.1
                     * @param string $class The read more link CSS class.
                     */
                    'readmoreLinkClass' => Formatting::sanitize_html_class(apply_filters('bootstrap_basic_fse_entry_content_readmore_readmore_link_class', $linkClasses)),
                    /**
                     * Read more wrapper CSS class.
                     * 
                     * @since 0.0.1
                     * @param string $class The read more wrapper CSS class.
                     */
                    'readmoreWrapperClass' => Formatting::sanitize_html_class(apply_filters('bootstrap_basic_fse_entry_content_readmore_readmore_wrapper_class', 'mt-1')),
                    /**
                     * Read less link CSS class.
                     * 
                     * @since 0.0.1
                     * @param string $class The read less link CSS class.
                     */
                    'readlessLinkClass' => Formatting::sanitize_html_class(apply_filters('bootstrap_basic_fse_entry_content_readmore_readless_link_class', $linkClasses)),
                    /**
                     * Read less wrapper CSS class.
                     * 
                     * @since 0.0.1
                     * @param string $class The read less wrapper CSS class.
                     */
                    'readlessWrapperClass' => Formatting::sanitize_html_class(apply_filters('bootstrap_basic_fse_entry_content_readmore_readless_wrapper_class', 'mt-3')),
                    'txtReadless' => esc_html(
                        /**
                         * Read less text.
                         * 
                         * @since 0.0.1
                         * @param string $text The read less text.
                         */
                        apply_filters('bootstrap_basic_fse_entry_content_readmore_readless_text', __('Read less', 'bootstrap-basic-fse'))
                    ),
                    'txtReadmore' => esc_html(
                        /**
                         * Read more text.
                         * 
                         * @since 0.0.1
                         * @param string $text The read more text.
                         */
                        apply_filters('bootstrap_basic_fse_entry_content_readmore_readmore_text', __('Read more', 'bootstrap-basic-fse'))
                    ),
                ]
            );
            wp_enqueue_script('bootstrap-basic-fse-entry-content-readmore');

            unset($linkClasses);
            // end entry-content-readmore.js ---------------------------------------------------
        }// enqueueScriptsStyles


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_action('wp_enqueue_scripts', [$this, 'enqueueScriptsStyles']);
        }// registerHooks


    }// EntryContentReadmore
}
