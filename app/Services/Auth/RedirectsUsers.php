<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    3/11/21, 3:17 AM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Auth;

trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }
}
