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

/**
 * Class PasswordGeneratorManager.
 */
interface PasswordGeneratorManagerInterface
{
    /**
     * Registers the given password generator with the given name.
     *
     * @param string                                     $name
     * @param callable|PasswordGeneratorInterface|string $generator
     */
    public function register(string $name, $generator): void;

    /**
     * Get the previously registered generator by the given name.
     *
     * @param null|string $generatorName
     *
     * @return callable
     */
    public function get(?string $generatorName = null): callable;
}
