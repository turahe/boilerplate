<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    1/30/21, 3:18 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Libraries\Post;

use League\CommonMark\GithubFlavoredMarkdownConverter;

class Markdown
{
    /**
     * Convert markdown to HTML.
     *
     * @param string $text
     * @return string
     */
    public function generate(string $text): string
    {
        try {
            $markdown = new GithubFlavoredMarkdownConverter();

            return $markdown->convertToHtml($text);
        } catch (\Exception $exception) {
        }
    }
}
