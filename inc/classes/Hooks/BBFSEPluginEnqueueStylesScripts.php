<?php
/**
 * Bootstrap Basic FSE - Hook into "Bootstrap Basic FSE Plugin" about enqueue/dequeue styles & scripts.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Hooks;


if (!class_exists('\\BootstrapBasicFSE\Hooks\\BBFSEPluginEnqueueStylesScripts')) {
    /**
     * BBFSE Plugin enqueue class.
     * 
     * @since 0.0.1
     */
    class BBFSEPluginEnqueueStylesScripts implements \BootstrapBasicFSE\Interfaces\AutoRegisterInterface
    {


        /**
         * Dequeue styles and scripts.
         * 
         * These enqueue names are on Bootstrap Basic FSE Plugin (BBFSE Plugin) that created for this theme by the same author.
         * It does not need to enqueue the same CSS & JS files on both plugin and theme. Use them based on this theme is enough.
         * 
         * @link https://developer.wordpress.org/reference/functions/wp_dequeue_style/ Reference.
         * @link https://developer.wordpress.org/reference/functions/wp_dequeue_script/ Reference.
         * @since 0.0.1
         */
        public function dequeueStylesScripts()
        {
            wp_dequeue_style('bbfse-plugin-bootstrap-css');
            wp_dequeue_style('bbfse-plugin-bootstrap-icons');
            wp_dequeue_script('bbfse-plugin-bootstrap-js');
        }// dequeueStylesScripts


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            // "filter" hook below did not test on other OS.
            // So, I'm not sure if there is problem with plugin loading order that cause this to not work or not. 
            // Use action hook below (that is under this filter hook) instead.
            //add_filter('bbfse_plugin_enqueue_styles_scripts', '__return_false');
            // "action" hook below should work fine because it was called after (priority 11) the plugin.
            add_action('wp_enqueue_scripts', [$this, 'dequeueStylesScripts'], 11);
        }// registerHooks


    }// BBFSEPluginEnqueueStylesScripts
}
