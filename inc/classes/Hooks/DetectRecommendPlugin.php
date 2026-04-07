<?php
/**
 * RundizStrap - Detect recommended plugin. (In fact, it is required to make this theme work perfectly.)
 * 
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundizstrap\Hooks;


if (!class_exists('\\Rundizstrap\\Hooks\\DetectRecommendPlugin')) {
    /**
     * Detect recommended plugin class.
     * 
     * @since 0.0.1
     */
    class DetectRecommendPlugin implements \Rundizstrap\Interfaces\AutoRegisterInterface
    {


        protected const TRANSIENT_NAME = 'rundizstrap_recommend_plugin_rundizstrapcompanion_not_found_dismissed';


        /**
         * AJAX dismiss the notice.
         */
        public function ajaxDismiss()
        {
            if (!$this->isUserHasRequiredCapability()) {
                // if current user has no capability to access plugin page.
                return;
            }

            check_ajax_referer('rundizstrap_detect_recommend_plugin_dismiss_nonce', 'nonce');

            $dismiss = sanitize_text_field(wp_unslash(($_POST['dismiss'] ?? '')));
            $output = [];

            if (strval($dismiss) === '1') {
                set_site_transient(static::TRANSIENT_NAME, 'true');
                set_site_transient(static::TRANSIENT_NAME . '_datetime', time());
                $output['dismiss'] = $dismiss;
                $output['success'] = true;
                $output['status'] = 200;
                $output['message'] = __('You have dismissed the notice.', 'rundizstrap');
            } else {
                $output['dismiss'] = $dismiss;
                $output['success'] = false;
                $output['status'] = 400;
                $output['message'] = __('You did not dismiss the notice', 'rundizstrap');
            }

            if (isset($output['status']) && intval($output['status']) >= 200 && intval($output['status']) < 400) {
                wp_send_json_success($output, intval($output['status']));
            } else {
                if (!isset($output['status'])) {
                    $output['status'] = 400;
                }
                wp_send_json_error($output, intval($output['status']));
            }
        }// ajaxDismiss


        /**
         * Detect recommended plugin and display alert if not found activated.
         * 
         * @since 0.0.1
         */
        public function detectAndDisplayAlert()
        {
            if (!class_exists('\\RundizstrapCompanion\\App\\App')) {
                // if PHP class of recommended plugin is not exists. it is not activated.
                if (!$this->isUserHasRequiredCapability()) {
                    // if current user has no capability to access plugin page.
                    return;
                }

                if ($this->isDismissed()) {
                    // if already dismissed the notice.
                    return;
                }

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
                    esc_html__('The %1$s plugin is recommended for %2$s theme and must be activated.', 'rundizstrap'),
                    '<strong style="text-decoration: underline;">RundizStrap Companion</strong>',
                    '<strong style="text-decoration: underline;">' . (is_object($theme) ? $theme->get('Name') : esc_html__('RundizStrap', 'rundizstrap')) . '</strong>'
                );
                $args = [
                    'dismissible' => true,
                    'id' => 'rundizstrap-dismiss-recommend-plugin',
                    'type' => 'error',
                ];

                wp_admin_notice($message, $args);
                unset($args, $message, $theme);
            }// endif;
        }// detectAndDisplayAlert


        /**
         * Enqueue script.
         */
        public function enqueueScript()
        {
            if (!class_exists('\\RundizstrapCompanion\\App\\App')) {
                // if PHP class of recommended plugin is not exists. it is not activated.
                if (!$this->isUserHasRequiredCapability()) {
                    // if current user has no capability to access plugin page.
                    return;
                }

                if ($this->isDismissed()) {
                    // if already dismissed the notice.
                    return;
                }

                wp_enqueue_script('rundizstrap-hooks-detectrecommendplugin-js');
            }// endif;
        }// enqueueScript


        /**
         * Check is user is dismissed.
         * 
         * @return bool Return `true` if dismissed, `false` if not.
         */
        private function isDismissed(): bool
        {
            $dismiss = get_site_transient(static::TRANSIENT_NAME);
            $dismissTimestamp = get_site_transient(static::TRANSIENT_NAME . '_datetime');
            if (!is_string($dismiss) || !is_numeric($dismissTimestamp)) {
                return false;
            }

            $lastYearFromNow = strtotime('-1 year');
            if (!is_numeric($lastYearFromNow)) {
                return false;
            }

            if (intval($dismissTimestamp) < intval($lastYearFromNow)) {
                // if the saved dismissed is older than a year.
                return false;
            } else {
                // if the saved dismissed is not older than a year.
                return true;
            }
        }// isDismissed


        /**
         * Check if user has required capability to know this notice to install recommend plugin.
         * 
         * @return bool Return `true` if yes, `false` if no.
         */
        private function isUserHasRequiredCapability(): bool
        {
            if (current_user_can('install_plugins') || current_user_can('update_plugins')) {
                return true;
            }
            return false;
        }// isUserHasRequiredCapability


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_action('init', [$this, 'registerScript']);// load first
            add_action('admin_enqueue_scripts', [$this, 'enqueueScript']);// load 2nd.
            add_action('admin_notices', [$this, 'detectAndDisplayAlert']);// load 3rd.

            add_action('wp_ajax_rundizstrap_detect_recommend_plugin_dismiss', [$this, 'ajaxDismiss']);
        }// registerHooks


        /**
         * Register script(s). Not enqueue here.
         */
        public function registerScript()
        {
            if (!class_exists('\\RundizstrapCompanion\\App\\App')) {
                // if PHP class of recommended plugin is not exists. it is not activated.
                if (!$this->isUserHasRequiredCapability()) {
                    // if current user has no capability to access plugin page.
                    return;
                }

                if ($this->isDismissed()) {
                    // if already dismissed the notice.
                    return;
                }

                wp_register_script('rundizstrap-hooks-detectrecommendplugin-js', get_theme_file_uri('assets/js/Admin/DetectRecommendPlugin.js'), [], RUNDIZSTRAP_VERSION, true);
                wp_localize_script(
                    'rundizstrap-hooks-detectrecommendplugin-js',
                    'RundizstrapHookDetectRecommendPluginObj',
                    [
                        'nonce' => wp_create_nonce('rundizstrap_detect_recommend_plugin_dismiss_nonce'),
                    ]
                );
            }// endif;
        }// registerScript


    }// DetectRecommendPlugin
}
