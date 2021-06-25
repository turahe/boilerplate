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

use App\Models\User;
use Illuminate\Support\Str;

class Token
{
    /**
     * Return a unique personal access token.
     */
    public static function generate(): string
    {
        do {
            $api_token = Str::random(60);
        } while (User::where('api_token', $api_token)->exists());

        return $api_token;
    }
}
