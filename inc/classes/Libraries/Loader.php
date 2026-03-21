<?php
/**
 * RundizStrap loader class.
 * 
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Libraries;


if (!class_exists('\\BootstrapBasicFSE\Libraries\\Loader')) {
    /**
     * Loader class.
     * 
     * @since 0.0.1
     */
    class Loader
    {


        /**
         * Automatic look into those classes and register all the class that supported.
         * 
         * All the classes that implemented `AutoRegisterInterface` will be called to `registerHooks()` method automatically.<br>
         * This method may contain call to actions, or filters of WordPress core.
         * 
         * @since 0.0.1
         */
        public function autoRegisterClasses()
        {
            $thisThemeDir = dirname(BOOTSTRAPBASICFSE_FILE);
            $filesList = $this->getClassFileList($thisThemeDir . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'classes');

            if (is_array($filesList) || is_iterable($filesList)) {
                foreach ($filesList as $file) {
                    $fileAsClassName = '\\BootstrapBasicFSE' . str_replace([$thisThemeDir, '.php', '/'], ['', '', '\\'], $file);
                    $fileAsClassName = str_replace(['inc\\classes\\'], '', $fileAsClassName);

                    if (class_exists($fileAsClassName)) {
                        $TestClass = new \ReflectionClass($fileAsClassName);
                        if (
                            !$TestClass->isAbstract() && 
                            !$TestClass->isTrait() && 
                            $TestClass->implementsInterface('\\BootstrapBasicFSE\\Interfaces\\AutoRegisterInterface')
                        ) {
                            $ClassObj = new $fileAsClassName();
                            if (method_exists($ClassObj, 'registerHooks')) {
                                $ClassObj->registerHooks();
                            }
                            unset($ClassObj);
                        }
                    }// endif;
                    unset($fileAsClassName);
                }// endforeach;
                unset($file);
            }
            unset($filesList, $thisThemeDir);
        }// autoRegisterClasses


        /**
         * Get files list that may contain class in specific path. The result will be sort by file name.
         *
         * @since 0.0.1
         * @param string $path The full path without trailing slash.
         * @return array Return indexed array of files list.
         */
        private function getClassFileList(string $path): array
        {
            $Di = new \RecursiveDirectoryIterator($path, \RecursiveDirectoryIterator::SKIP_DOTS);
            $It = new \RecursiveIteratorIterator($Di);
            unset($Di);

            $filesList = [];
            foreach ($It as $file) {
                $filesList[] = $file;
            }// endforeach;
            unset($file, $It);
            natsort($filesList);

            return $filesList;
        }// getClassFileList


        /**
         * Load views.
         *
         * @since 0.0.1
         * @param string $view_name View file name, refer from inc/views folder, without .php extension.
         * @param array $data For send data variable to view.
         * @param bool $require_once Set to `true` to use `include_once`, `false` to use `include`. Default is `false`.
         * @return bool Return `true` if success loading.
         * @throws \Exception Throws the error if views file was not found.
         */
        public function loadView(string $view_name, array $data = [], bool $require_once = false): bool
        {
            $view_dir = dirname(BOOTSTRAPBASICFSE_FILE) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;
            $templateFile = $view_dir . $view_name . '.php';
            unset($view_dir);

            if ('' !== $view_name && file_exists($templateFile) && is_file($templateFile)) {
                // if views file was found.
                if (is_array($data)) {
                    extract($data, EXTR_PREFIX_SAME, 'dupvar_');// phpcs:ignore WordPress.PHP.DontExtract.extract_extract
                }

                if (true === $require_once) {
                    include_once $templateFile;
                } else {
                    include $templateFile;
                }

                unset($templateFile);
                return true;
            } else {
                // if views file was not found.
                // throw the exception to notice the developers.
                throw new \Exception(
                    sprintf(
                        // translators: %s: Template path.
                        esc_html(__('The views file was not found (%s).', 'rundizstrap')), 
                        str_replace(['\\', '/'], '/', $templateFile)// phpcs:ignore WordPress.Security.EscapeOutput
                    )
                );
            }
        }// loadView


    }// Loader
}
