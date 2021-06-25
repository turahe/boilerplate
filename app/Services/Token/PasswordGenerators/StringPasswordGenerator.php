<?php

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    2/18/21, 7:01 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Token\PasswordGenerators;

use App\Services\Token\PasswordGeneratorInterface;
use Illuminate\Support\Str;

/**
 * Class StringPasswordGenerator.
 */
class StringPasswordGenerator implements PasswordGeneratorInterface
{
    /**
     * Generate a string password with the given length.
     *
     * @param int $length
     *
     * @return string
     */
    public function generate(int $length): string
    {
        return Str::random($length);
    }
}
