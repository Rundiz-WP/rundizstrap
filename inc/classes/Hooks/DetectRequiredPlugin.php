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
            if (!class_exists('\\RundizstrapCompanion\\App\\App')) {
                // if PHP class of required plugin is not exists. it is not activated.

                // check current admin page use `get_current_screen()` instead of `global $pagenow;` 
                // because `$pagenow` can't detect sub page like 'themes.php?page=themecheck'.
                $currentScreen = get_current_screen();
                $displayInAdminPages = ['dashboard', 'plugins', 'themes'];
                if (isset($currentScreen) && !in_array(($currentScreen->id ?? ''), $displayInAdminPages, true)) {
                    // if not in certain admin pages
                    // do not display, it will be annoying to show on all pages.
                    return;
                }
                unset($currentScreen, $displayInAdminPages);

                /* @var $theme \WP_Theme */
                $theme = (function_exists('wp_get_theme') ? wp_get_theme() : null);

                $message = sprintf(
                    /* translators: %1$s the plugin name, %2$s the theme name. */
                    esc_html__('The %1$s plugin is required for %2$s theme and must be activated.', 'bootstrap-basic-fse'),
                    '<strong style="text-decoration: underline;">RundizStrap Companion</strong>',
                    '<strong style="text-decoration: underline;">' . (is_object($theme) ? $theme->get('Name') : esc_html__('Bootstrap Basic FSE', 'bootstrap-basic-fse')) . '</strong>'
                );
                $args = [
                    'dismissible' => true,
                    'type' => 'error',
                ];

                wp_admin_notice($message, $args);
                unset($args, $message, $theme);
            }// endif;
        }// detectAndDisplayAlert


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_action('admin_notices', [$this, 'detectAndDisplayAlert']);
        }// registerHooks


    }// DetectRequiredPlugin
}
