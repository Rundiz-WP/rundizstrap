<?php
/**
 * Override WordPress wp-includes/formatting.php
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Libraries\WPOverride;


if (!class_exists('\\BootstrapBasicFSE\\Libraries\\WPOverride\\Formatting')) {
    /**
     * Formatting class.
     * 
     * @since 0.0.1
     */
    class Formatting
    {


        /**
         * Sanitizes an HTML class name(s) to ensure it only contains valid characters.
         * 
         * This will be call to function `sanitize_html_class` if input class name contain multiple values.
         * 
         * @since 0.0.1
         * @see `sanitize_html_class()` for more info
         * @param sintr|array $classname The CSS class name(s). Use space for multiple values. Or you can use array for multiple values.
         * @param string $fallback Optional. The value to return if the sanitization ends up as an empty string.
         * @return string The sanitized value.
         * @throws \InvalidArgumentException Throw excpetion if provided `$classname` is invalid type.
         */
        public static function sanitize_html_class($classname, string $fallback = ''): string
        {
            if (is_string($classname)) {
                // if class name is string.
                if (stripos($classname, ' ') !== false) {
                    // if found space in the class name. this contain multiple class names.
                    $classNames = explode(' ', $classname);
                } else {
                    return sanitize_html_class($classname, $fallback);
                }
            } elseif (is_array($classname)) {
                $classNames = $classname;
            } else {
                // if class name is something else.
                // do not translate exception in any other languages. it is very bad idea to do that!
                // if this error occur on client sites and they use some language that we don't know. the debug data (error log) will be very hard to know what it is.
                throw new \InvalidArgumentException('The argument `$classname` must be string or array. ' . ucfirst(gettype($classname)) . ' given.');
            }

            $output = '';
            if (is_array($classNames) || is_iterable($classNames)) {
                foreach ($classNames as $eachClass) {
                    if ('' === trim($eachClass)) {
                        continue;
                    }

                    $result = sanitize_html_class($eachClass, $fallback);
                    if ('' !== trim($result)) {
                        $output .= ' ' . $result;
                    }
                    unset($result);
                }// endforeach;
                unset($eachClass);
            }// endif;
            unset($classNames);

            return trim($output);
        }// sanitize_html_class


    }// Formatting
}
