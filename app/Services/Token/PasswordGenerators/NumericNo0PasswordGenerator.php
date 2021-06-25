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
use Exception;

/**
 * Class NumericNo0PasswordGenerator.
 */
class NumericNo0PasswordGenerator extends NumericPasswordGenerator implements PasswordGeneratorInterface
{
    /**
     * Generate a numeric password with no zeroes.
     *
     * @param int $length
     *
     * @return string
     */
    public function generate(int $length): string
    {
        return (string) str_replace(0, $this->getRandomDigitWithNo0(), (string) parent::generate($length));
    }

    /**
     * Generate a random digit with no zeroes.
     *
     * @return int
     */
    private function getRandomDigitWithNo0()
    {
        try {
            $int = random_int(1, 9);
        } catch (Exception $e) {
            $int = rand(1, 9);
        }

        return $int;
    }
}
