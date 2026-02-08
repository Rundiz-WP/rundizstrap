<?php
/**
 * Bootstrap Basic FSE - Hook into comment form and modify the fields use Bootstrap CSS classes.
 * 
 * @package bootstrap-basic-fse
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace BootstrapBasicFSE\Hooks;


return;// disabled. use block `wp:bbfse-plug/blocks-bs-comment-form` instead.
// leave this file as fallback.


if (!class_exists('\\BootstrapBasicFSE\\Hooks\\CommentForm')) {
    /**
     * Comment form class.
     * 
     * @since 0.0.1
     */
    class CommentForm implements \BootstrapBasicFSE\Interfaces\AutoRegisterInterface
    {


        /**
         * @since 0.0.1
         * @type string Form control class that is required for many `input`, `textarea`.
         */
        private const FORM_CTRL_CLASS = 'form-control';


        /**
         * Modify form default values.
         * 
         * @since 0.0.1
         * @param array $defaults The default comment form arguments.
         * @return array
         */
        public function commentFormDefaults(array $defaults): array
        {
            $defaults['class_form'] .= ' mb-4';

            return $defaults;
        }// commentFormDefaults


        /**
         * Modify comment form field's wrapper.
         * 
         * Modify the HTML that wrap the input fields such as input, textarea and make it use Bootstrap CSS class.
         * 
         * @link https://stackoverflow.com/a/45331336/128761 DOMXPath contain class reference.
         * @since 0.0.1
         * @see `comment_form()` function.
         * @param array $comment_fields The comment fields.
         * @return array
         */
        public function commentFormFields(array $comment_fields): array
        {
            if (isset($comment_fields['cookies']) && is_string($comment_fields['cookies'])) {
                $Dom = new \DOMDocument();
                $Dom->loadHTML($comment_fields['cookies'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $Input = $Dom->getElementsByTagName('input')->item(0);
                $XPath = new \DOMXPath($Dom);
                $targetClass = 'form-check-input';
                $Elements = $XPath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $targetClass ')]");
                if ($Elements->length <= 0) {
                    // if there is no certain CSS class. set it to selected tag.
                    $Input->className = $targetClass;
                }

                $comment_fields['cookies'] = sprintf(
                    '<div class="mb-3 form-check">%s %s</div>',
                    $Dom->saveHTML($Input),
                    // label text copied from inside function `comment_form()`.
                    sprintf(
                        '<label class="form-check-label" for="wp-comment-cookies-consent">%s</label>',
                        __('Save my name, email, and website in this browser for the next time I comment.', 'bootstrap-basic-fse')
                    ),
                );

                unset($Dom, $Elements, $Input, $targetClass, $XPath);
            }// endif;

            if (isset($comment_fields['url']) && is_string($comment_fields['url'])) {
                $Dom = new \DOMDocument();
                $Dom->loadHTML($comment_fields['url'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $Input = $Dom->getElementsByTagName('input')->item(0);
                $XPath = new \DOMXPath($Dom);
                $Elements = $XPath->query('//*[contains(concat(\' \', normalize-space(@class), \' \'), \' ' . static::FORM_CTRL_CLASS . ' \')]');
                if ($Elements->length <= 0) {
                    // if there is no certain CSS class. set it to selected tag.
                    $Input->className = static::FORM_CTRL_CLASS;
                }

                $comment_fields['url'] = sprintf(
                    '<div class="mb-3">%s %s</div>',
                    // label text copied from inside function `comment_form()`.
                    sprintf(
                        '<label class="form-label" for="url">%s</label>',
                        __('Website', 'bootstrap-basic-fse')
                    ),
                    $Dom->saveHTML($Input),
                );

                unset($Dom, $Elements, $Input, $XPath);
            }// endif;

            if (isset($comment_fields['email']) && is_string($comment_fields['email'])) {
                $Dom = new \DOMDocument();
                $Dom->loadHTML($comment_fields['email'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $Input = $Dom->getElementsByTagName('input')->item(0);
                $XPath = new \DOMXPath($Dom);
                $Elements = $XPath->query('//*[contains(concat(\' \', normalize-space(@class), \' \'), \' ' . static::FORM_CTRL_CLASS . ' \')]');
                if ($Elements->length <= 0) {
                    // if there is no certain CSS class. set it to selected tag.
                    $Input->className = static::FORM_CTRL_CLASS;
                }

                $comment_fields['email'] = sprintf(
                    '<div class="mb-3">%s %s</div>',
                    // label text copied from inside function `comment_form()`.
                    sprintf(
                        '<label class="form-label" for="email">%s</label>',
                        __('Email', 'bootstrap-basic-fse')
                    ),
                    $Dom->saveHTML($Input),
                );

                unset($Dom, $Elements, $Input, $XPath);
            }// endif;

            if (isset($comment_fields['author']) && is_string($comment_fields['author'])) {
                $Dom = new \DOMDocument();
                $Dom->loadHTML($comment_fields['author'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $Input = $Dom->getElementsByTagName('input')->item(0);
                $XPath = new \DOMXPath($Dom);
                $Elements = $XPath->query('//*[contains(concat(\' \', normalize-space(@class), \' \'), \' ' . static::FORM_CTRL_CLASS . ' \')]');
                if ($Elements->length <= 0) {
                    // if there is no certain CSS class. set it to selected tag.
                    $Input->className = static::FORM_CTRL_CLASS;
                }

                $comment_fields['author'] = sprintf(
                    '<div class="mb-3">%s %s</div>',
                    // label text copied from inside function `comment_form()`.
                    sprintf(
                        '<label class="form-label" for="author">%s</label>',
                        __('Name', 'bootstrap-basic-fse')
                    ),
                    $Dom->saveHTML($Input),
                );

                unset($Dom, $Elements, $Input, $XPath);
            }// endif;

            if (isset($comment_fields['comment']) && is_string($comment_fields['comment'])) {
                $Dom = new \DOMDocument();
                $Dom->loadHTML($comment_fields['comment'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
                $Input = $Dom->getElementsByTagName('textarea')->item(0);
                $XPath = new \DOMXPath($Dom);
                $Elements = $XPath->query('//*[contains(concat(\' \', normalize-space(@class), \' \'), \' ' . static::FORM_CTRL_CLASS . ' \')]');
                if ($Elements->length <= 0) {
                    // if there is no certain CSS class. set it to selected tag.
                    $Input->className = static::FORM_CTRL_CLASS;
                }

                $comment_fields['comment'] = sprintf(
                    '<div class="mb-3">%s %s</div>',
                    // label text copied from inside function `comment_form()`.
                    sprintf(
                        '<label class="form-label" for="comment">%s</label>',
                        _x('Comment', 'noun', 'bootstrap-basic-fse')
                    ),
                    $Dom->saveHTML($Input),
                );

                unset($Dom, $Elements, $Input, $XPath);
            }// endif;

            return $comment_fields;
        }// commentFormFields


        /**
         * Comment form submit button.
         * 
         * @since 0.0.1
         * @see `comment_form()` function.
         * @param string $submit_button HTML markup for the submit button.
         * @param array $args Arguments passed to comment_form().
         * @return string
         */
        public function commentFormSubmitButton(string $submit_button, array $args): string
        {
            $submit_button = '<button class="btn btn-primary" type="submit">' . ($args['label_submit'] ?? __('Post Comment', 'bootstrap-basic-fse')) . '</button>';

            return $submit_button;
        }// commentFormSubmitButton


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_filter('comment_form_fields', [$this, 'commentFormFields']);
            add_filter('comment_form_submit_button', [$this, 'commentFormSubmitButton'], 10, 2);
            add_filter('comment_form_defaults', [$this, 'commentFormDefaults']);
        }// registerHooks


    }// CommentForm
}
