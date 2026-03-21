<?php
/**
 * RundizStrap - Content pagination.
 * 
 * @package rundizstrap
 * @since 0.0.1
 * @license http://opensource.org/licenses/MIT MIT
 */


namespace Rundizstrap\Hooks;


if (!class_exists('\\Rundizstrap\\Hooks\\ContentPagination')) {
    /**
     * Content pagination class.
     * 
     * @since 0.0.1
     */
    class ContentPagination implements \Rundizstrap\Interfaces\AutoRegisterInterface
    {


        /**
         * @since 0.0.1
         * @var bool Value of has blocks detection. Default is `true`.
         */
        private $hasBlock = true;


        /**
         * Add pagination links if using classic editor.
         * 
         * @link https://developer.wordpress.org/reference/hooks/the_content/ Reference
         * @link https://github.com/WordPress/gutenberg/issues/29484 Issue
         * @since 0.0.1
         * @param string $content Content of the current post.
         * @return string
         */
        public function addPaginationLinks(string $content): string
        {
            if (!is_singular() || !is_main_query() || true === $this->hasBlock) {
                return $content;
            }

            global $multipage;

            // Only add links if it's classic content and multipage.
            if ($multipage) {
                $links = wp_link_pages([
                    'echo' => 0,
                ]);

                if (!empty($links)) {
                    $content .= $links;
                }
            }

            return $content;
        }// addPaginationLinks


        /**
         * Detect that is this post content has blocks.
         * 
         * Only work in singular (post, page, any post type).
         * 
         * @link https://developer.wordpress.org/reference/hooks/the_content/ Reference
         * @since 0.0.1
         * @param string $content Content of the current post.
         */
        public function detectHasBlock(string $content): string
        {
            if (!is_singular() || !is_main_query()) {
                return $content;
            }

            $this->hasBlock = has_blocks($content);

            return $content;
        }// detectHasBlock


        /**
         * Modify link pages args to be matched Bootstrap style.
         * 
         * @since 0.0.1
         * @param array $parsed_args An array of page link arguments. See `wp_link_pages()` for information on accepted arguments.
         * @return array
         */
        public function modifyWPLinkPagesArgs(array $parsed_args): array
        {
            $parsed_args['before'] = '<div class="mt-3">' . 
                esc_html__('Pages:', 'rundizstrap') . 
                '<nav class="post-nav-links" aria-label="' . esc_html__('Content pages', 'rundizstrap') . '">' .
                '<ul class="pagination">';
            $parsed_args['after'] = '</ul></nav></div>';
            $parsed_args['separator'] = '';

            return $parsed_args;
        }// modifyWPLinkPagesArgs


        /**
         * Modify link pages link HTML to be matched Bootstrap style.
         * 
         * @since 0.0.1
         * @param string $link The page number HTML output.
         * @param int $i Page number for paginated posts' page links.
         * @return string
         */
        public function modifyWPLinkPagesLink(string $link, int $i): string
        {
            if (stripos($link, '<a') === false) {
                // if not found `<a>` link.
                return '<li class="page-item active"><a class="page-link" href="#">' . $link . '</a></li>' . PHP_EOL;
            } else {
                // if found `<a>` link.
                if (stripos($link, 'class=') !== false) {
                    // if found `class=".."` attribute.
                    $pattern = 'class\s*=\s*[\'"](?<classValue>[\w \-_]+)[\'"]';
                    $replace = 'class="$1 page-link"';
                    $link = preg_replace('/' . $pattern . '/', $replace, $link);
                    unset($pattern, $replace);
                } else {
                    // if not found `class=".."` attribute.
                    $link = str_ireplace('<a', '<a class="page-link"', $link);
                }
                // always wrap pagination with `<li>` element.
                return '<li class="page-item">' . $link . '</li>' . PHP_EOL;
            }// endif;
        }// modifyWPLinkPagesLink


        /**
         * {@inheritDoc}
         * 
         * @since 0.0.1
         */
        public function registerHooks()
        {
            add_filter('wp_link_pages_args', [$this, 'modifyWPLinkPagesArgs']);
            add_filter('wp_link_pages_link', [$this, 'modifyWPLinkPagesLink'], 10, 2);
            add_filter('the_content', [$this, 'detectHasBlock'], 1);// high priority (lower number) to make sure it can detects `<!--nextpage-->` in the content before it gets replaced.
            add_filter('the_content', [$this, 'addPaginationLinks'], 11);
        }// registerHooks


    }// ContentPagination
}
