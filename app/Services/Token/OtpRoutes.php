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

use App\Http\Controllers\OtpController;
use Illuminate\Support\Facades\Route;

class OtpRoutes
{
    /**
     * Binds the Passport routes into the controller.
     */
    public static function register(): void
    {
        Route::resource('otp', OtpController::class, [
            'only'       => ['create', 'store'],
            'prefix'     => 'otp',
        ])->middleware(['web', 'auth']);
    }
}
