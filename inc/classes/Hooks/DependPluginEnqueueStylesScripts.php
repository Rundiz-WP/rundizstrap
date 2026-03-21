<?php
/**
 * RundizStrap - Hook into dependency plugin (RundizStrap Companion) about enqueue/dequeue styles & scripts.
 * 
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundizstrap\Hooks;


if (!class_exists('\\Rundizstrap\Hooks\\DependPluginEnqueueStylesScripts')) {
    /**
     * Depend plugin enqueue class.
     * 
     * @since 0.0.1
     */
    class DependPluginEnqueueStylesScripts implements \Rundizstrap\Interfaces\AutoRegisterInterface
    {


        /**
         * Dequeue styles and scripts.
         * 
         * These enqueue names are on RundizStrap Companion that created for this theme by the same author.
         * It does not need to enqueue the same CSS & JS files on both plugin and theme. Use them based on this theme is enough.
         * 
         * @link https://developer.wordpress.org/reference/functions/wp_dequeue_style/ Reference.
         * @link https://developer.wordpress.org/reference/functions/wp_dequeue_script/ Reference.
         * @since 0.0.1
         */
        public function dequeueStylesScripts()
        {
            wp_dequeue_style('rundizstrap-companion-bootstrap-css');
            wp_dequeue_style('rundizstrap-companion-bootstrap-icons');
            wp_dequeue_script('rundizstrap-companion-bootstrap-js');
        }// dequeueStylesScripts


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            // "filter" hook below did not test on other OS.
            // So, I'm not sure does it work on all OS or not.
            add_filter('rundizstrap_companion_enqueue_styles_scripts', '__return_false');
            // "action" hook below should work fine because it was called after (priority 11) the plugin.
            add_action('wp_enqueue_scripts', [$this, 'dequeueStylesScripts'], 11);
        }// registerHooks


    }// DependPluginEnqueueStylesScripts
}
