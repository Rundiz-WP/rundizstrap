<?php
/**
 * RundizStrap - Content modifier such as append clear float.
 * 
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundizstrap\Hooks;


if (!class_exists('\\Rundizstrap\\Hooks\\ContentModifier')) {
    /**
     * Content modifier class.
     * 
     * @since 0.0.1
     */
    class ContentModifier implements \Rundizstrap\Interfaces\AutoRegisterInterface
    {


        /**
         * Append clearfix (clear float).
         * 
         * @since 0.0.1
         * @param string $content Content of the current post.
         * @return string
         */
        public function appendClearfix(string $content): string
        {
            return $content . '<div class="clearfix"></div>';
        }// appendClearfix


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_filter('the_content', [$this, 'appendClearfix']);
        }// registerHooks


    }// ContentModifier
}
