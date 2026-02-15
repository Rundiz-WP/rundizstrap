<?php
/**
 * RundizStrap main theme's class.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE;


if (!class_exists('\\BootstrapBasicFSE\\BootstrapBasicFSE')) {
    /**
     * RundizStrap main theme's class.
     */
    class BootstrapBasicFSE
    {


        /**
         * After setup theme.
         * 
         * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/ Reference.
         * @since 0.0.1
         */
        public function afterSetupTheme()
        {
            // @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#default-block-styles Reference.
            add_theme_support('wp-block-styles');

            // @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#wide-alignment Reference.
            add_theme_support('align-wide');

            // @link https://developer.wordpress.org/advanced-administration/wordpress/post-formats/ Supported post formats.
            add_theme_support('post-formats', array('aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'));

            // @link https://developer.wordpress.org/reference/functions/add_editor_style/ Reference.
            add_editor_style([
                get_theme_file_uri('assets/vendor/bootstrap/css/bootstrap.min.css'),
                'style.css',
            ]);
        }// afterSetupTheme


        /**
         * Enqueue scripts & styles.
         * 
         * @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/ Reference.
         * @since 0.0.1
         */
        public function enqueueScriptsStyles()
        {
            // CSS
            wp_enqueue_style('bootstrap-basic-fse-bootstrap');
            wp_enqueue_style('bootstrap-basic-fse-bootstrap-icons');
            wp_enqueue_style('bootstrap-basic-fse-stylesheet');

            // JS
            wp_enqueue_script('bootstrap-basic-fse-bootstrap');
        }// enqueueScriptsStyles


        /**
         * Initialize the class.
         * 
         * @since 0.0.1
         */
        public function init()
        {
            $this->setConstants();

            add_filter('default_wp_template_part_areas', [$this, 'templatePartAreas']);

            add_action('after_setup_theme', [$this, 'afterSetupTheme']);
            add_action('init', [$this, 'registerScriptsStyles']);
            add_action('wp_enqueue_scripts', [$this, 'enqueueScriptsStyles']);
        }// init


        /**
         * Register scripts and styles that will be common use on this theme.
         * 
         * The assets that was registered in this method can be enqueue later on any parts including hooks by `enqueue_block_assets`.<br>
         * If not register with something earlier than `wp_enqueue_scripts`, it won't work.
         * 
         * @link https://developer.wordpress.org/reference/functions/wp_register_style/ Function reference.
         * @link https://github.com/WordPress/WordPress/blob/master/wp-includes/functions.wp-scripts.php#L187 The register style function called to `_wp_scripts_maybe_doing_it_wrong()`
         * @link https://github.com/WordPress/WordPress/blob/master/wp-includes/functions.wp-scripts.php#L41 The maybe doing it wrong function check that if `init` hook did called then it's work.
         * @link https://developer.wordpress.org/themes/core-concepts/including-assets/ Functions to use when enqueue/register asset files.
         * @since 0.0.1
         */
        public function registerScriptsStyles()
        {
            // CSS
            wp_register_style('bootstrap-basic-fse-bootstrap', get_theme_file_uri('assets/vendor/bootstrap/css/bootstrap.min.css'), [], '5.3.8');
            wp_register_style('bootstrap-basic-fse-bootstrap-icons', get_theme_file_uri('assets/vendor/bootstrap-icons/css/bootstrap-icons.min.css'), [], '1.13.1');
            wp_register_style('bootstrap-basic-fse-stylesheet', get_stylesheet_uri(), [], BOOTSTRAPBASICFSE_VERSION);
            wp_register_style('bootstrap-basic-fse-entry-content-readmore', get_theme_file_uri('assets/css/entry-content-readmore.css'), [], BOOTSTRAPBASICFSE_VERSION);

            // JS
            wp_register_script('bootstrap-basic-fse-bootstrap', get_theme_file_uri('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'), [], '5.3.8', true);
            wp_register_script('bootstrap-basic-fse-entry-content-readmore', get_theme_file_uri('assets/js/entry-content-readmore.js'), [], BOOTSTRAPBASICFSE_VERSION, true);
        }// registerScriptsStyles


        /**
         * Set constants.
         * 
         * @since 0.0.1
         */
        private function setConstants()
        {
            if (!defined('BOOTSTRAPBASICFSE_FILE')) {
                define('BOOTSTRAPBASICFSE_FILE', dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'functions.php');
            }

            if (!defined('BOOTSTRAPBASICFSE_VERSION')) {
                /* @var $theme \WP_Theme */
                $theme = (function_exists('wp_get_theme') ? wp_get_theme() : null);
                $themeVersion = (is_object($theme) ? $theme->get('Version') : date('Ym')); // phpcs:ignore WordPress.DateTime.RestrictedFunctions.date_date
                if (!is_string($themeVersion) || empty($themeVersion)) {
                    $themeVersion = false;
                }
                unset($theme);
                define('BOOTSTRAPBASICFSE_VERSION', $themeVersion);
                unset($themeVersion);
            }
        }// setConstants


        /**
         * Filter template part areas.
         * 
         * @link https://developer.wordpress.org/reference/hooks/default_wp_template_part_areas/ Reference.
         * @since 0.0.1
         * @param array $default_area_definitions The allowed template part area values.
         */
        public function templatePartAreas(array $default_area_definitions): array
        {
            $default_area_definitions[] = [
                'area' => 'sidebar',
                'area_tag' => 'aside',
                'label' => __('Sidebar', 'bootstrap-basic-fse'),
                'description' => __('Right side bar', 'bootstrap-basic-fse'),
                'icon' => 'sidebar',
            ];

            return $default_area_definitions;
        }// templatePartAreas


    }// BootstrapBasicFSE
}
