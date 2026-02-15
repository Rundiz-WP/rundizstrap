<?php
/**
 * RundizStrap - Load text domain.
 * 
 * In WordPress 6.7, changes in translation handling emphasize loading translations from the centralized wp-content/languages/themes/ directory.
 * (Read more at https://wordpress.org/support/topic/translations-are-no-longer-loading-from-the-theme-folder/ )
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Hooks;


if (!class_exists('\\BootstrapBasicFSE\\Hooks\\LoadTextDomain')) {
    /**
     * Load text domain class.
     * 
     * @since 0.0.1
     */
    class LoadTextDomain implements \BootstrapBasicFSE\Interfaces\AutoRegisterInterface
    {


        /**
         * Load text domain if in development mode and current WP version is >= 6.7
         * 
         * @link https://wordpress.org/support/topic/translations-are-no-longer-loading-from-the-theme-folder/ WordPress them not loading translation.
         * @since 0.0.1
         */
        public function loadTextDomain()
        {
            global $wp_version;

            if (
                isset($wp_version) &&
                version_compare($wp_version, '6.7', '>=') && 
                function_exists('wp_get_environment_type') &&
                wp_get_environment_type() === 'development' &&
                function_exists('wp_get_development_mode') &&
                (
                    wp_get_development_mode() === 'all' || 
                    wp_get_development_mode() === 'theme'
                )
            ) {
                load_textdomain('bootstrap-basic-fse', get_template_directory() . '/languages/bootstrap-basic-fse-th.mo');
            }
        }// loadTextDomain


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_action('after_setup_theme', [$this, 'loadTextDomain']);
        }// registerHooks


    }// LoadTextDomain
}
