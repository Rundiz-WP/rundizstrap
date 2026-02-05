<?php
/**
 * Bootstrap Basic FSE - Detect required plugin.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Hooks;


if (!class_exists('\\BootstrapBasicFSE\\Hooks\\DetectRequiredPlugin')) {
    /**
     * Detect required plugin class.
     * 
     * @since 0.0.1
     */
    class DetectRequiredPlugin implements \BootstrapBasicFSE\Interfaces\AutoRegisterInterface
    {


        /**
         * Detect required plugin and display alert if not found activated.
         * 
         * @since 0.0.1
         */
        public function detectAndDisplayAlert()
        {
            if (!class_exists('\\BBFSEPlug\\App\\App')) {
                $Loader = new \BootstrapBasicFSE\Libraries\Loader();
                $Loader->loadView('Hooks/detectRequiredPlugin_v');
                unset($Loader);
            }// endif;
        }// detectAndDisplayAlert


        /**
         * Enqueue styles and scripts.
         * 
         * @since 0.0.1
         */
        public function enqueueStylesAndScripts()
        {
            wp_enqueue_script('bootstrap-basic-fse-hooks-detect-required-plugin', get_theme_file_uri('assets/js/Hooks/detect-required-plugin.js'), [], BOOTSTRAPBASICFSE_VERSION, true);
        }// enqueueStylesAndScripts


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_action('wp_enqueue_scripts', [$this, 'enqueueStylesAndScripts']);
            add_action('wp_footer', [$this, 'detectAndDisplayAlert']);
        }// registerHooks


    }// DetectRequiredPlugin
}
