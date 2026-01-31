<?php
/**
 * Bootstrap Basic FSE - Hook into gallery shortcode style.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Hooks;


if (!class_exists('\\BootstrapBasicFSE\Hooks\\GalleryStyle')) {
    /**
     * Gallery style class.
     * 
     * @since 0.0.1
     */
    class GalleryStyle implements \BootstrapBasicFSE\Interfaces\AutoRegisterInterface
    {


        /**
         * Gallery style for `[gallery]` shortcode.
         * 
         * @since 0.0.1
         * @see `gallery_shortcode()`.
         * @param string $gallery_style Default CSS styles and opening HTML div container for the gallery shortcode output.
         * @return string
         */
        public function galleryStyleShortcode(string $gallery_style): string
        {
            if (did_filter('gallery_style') > 1) {
                // if this filter is already did, no more work here.
                return $gallery_style;
            }

            ob_start();
            $Loader = new \BootstrapBasicFSE\Libraries\Loader();
            $Loader->loadView('Hooks/galleryStyle_v');
            unset($Loader);
            $output = ob_get_contents();
            ob_end_clean();
            return $output . $gallery_style;
        }// galleryStyleShortcode


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_filter('gallery_style', [$this, 'galleryStyleShortcode']);
        }// registerHooks


    }// GalleryStyle
}
