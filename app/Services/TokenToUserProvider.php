<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/23/21, 4:41 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services;

use App\Models\Token;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Str;

class TokenToUserProvider implements UserProvider
{
    private $token;
    private $user;

    public function __construct(User $user, Token $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function retrieveById($identifier)
    {
        return $this->user->find($identifier);
    }

    public function retrieveByToken($identifier, $token)
    {
        $token = $this->token->with('user')->where($identifier, $token)->first();

        return $token && $token->user ? $token->user : null;
    }

    public function updateRememberToken(Authenticatable $user, $token)
    {
        // update via remember token not necessary
    }

    public function retrieveByCredentials(array $credentials)
    {
        // implementation upto user.
        // how he wants to implement -
        // let's try to assume that the credentials ['username', 'password'] given
        $user = $this->user;
        foreach ($credentials as $credentialKey => $credentialValue) {
            if (! Str::contains($credentialKey, 'password')) {
                $user->where($credentialKey, $credentialValue);
            }
        }

        return $user->first();
    }

    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        $plain = $credentials['password'];

        return app('hash')->check($plain, $user->getAuthPassword());
    }
}
