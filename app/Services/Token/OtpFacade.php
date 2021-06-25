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

use Illuminate\Support\Facades\Facade;

/**
 * Class OtpFacade.
 *
 * @method static setPasswordGenerator(string $name): void
 * @method static check($authenticableId, string $token): bool
 * @method static addPasswordGenerator(string $name, $generator): void
 * @method static create($authenticatableId, ?int $length = null): TokenInterface
 * @method static retrieveByPlainText($authenticableId, string $plainText): ?TokenInterface
 * @method static retrieveByCipherText($authenticableId, string $cipherText): ?TokenInterface
 */
class OtpFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'otp';
    }
}
