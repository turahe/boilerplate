<?php

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    2/18/21, 7:01 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Token;

class Encryptor implements EncryptorInterface
{
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function encrypt(string $plainText): string
    {
        return hash_hmac('sha256', $plainText, $this->key);
    }
}
