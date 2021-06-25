<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    1/30/21, 3:18 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Helpers;

use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class Trending
{
    public function week($limit = 15)
    {
        return $this->getResults(7);
    }

    protected function getResults($days, $limit = 15)
    {
        $data = Analytics::fetchMostVisitedPages(Period::days($days), $limit + 10);

        return $this->parseResults($data, $limit);
    }

    protected function parseResults($data, $limit)
    {
        return $data->reject(function ($item) {
            return $item['url'] == '/' or
                $item['url'] == '/blog' or
                startsWith($item['url'], '/category');
        })->unique('url')->transform(function ($item) {
            $item['pageTitle'] = str_replace(' - Laravel News', '', $item['pageTitle']);

            return $item;
        })->splice(0, $limit);
    }
}
