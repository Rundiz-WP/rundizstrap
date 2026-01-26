<?php
/**
 * Bootstrap Basic FSE loader class.
 * 
 * @package bootstrap-basic-fse
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


    }// Loader
}
