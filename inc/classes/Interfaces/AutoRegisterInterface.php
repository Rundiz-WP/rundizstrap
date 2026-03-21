<?php
/**
 * Auto register interface.
 * 
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Interfaces;


if (!trait_exists('\\BootstrapBasicFSE\\Interfaces\\AutoRegisterInterface')) {
    /**
     * Auto register interface.
     * 
     * @since 0.0.1
     */
    interface AutoRegisterInterface
    {


        /**
         * Register actions, or filters that will be call to WordPress core.
         * 
         * @since 0.0.1
         */
        public function registerHooks();


    }// AutoRegisterInterface
}
