<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    3/10/21, 4:45 AM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Libraries;

use App\Models\Address;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

trait Addressable
{
    /**
     * Check if model has an address.
     *
     * @return bool
     */
    public function hasAddress(): bool
    {
        return (bool) $this->loadCount('addresses');
    }

    /**
     * Return any address related to the model model.
     *
     * @return mixed
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'model')->where('type', 'main');
    }

    /**
     * Return collection of addresses related to the tagged model.
     *
     * @return MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'model');
    }

    /**
     * Fetch primary address.
     *
     * @return MorphOne or null
     */
    public function primaryAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'model')->where('type', 'primary');
    }

    /**
     * Fetch billing address.
     *
     * @return MorphOne or null
     */
    public function billingAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'model')->where('type', 'billing');
    }

    /**
     * Fetch billing address.
     *
     * @return MorphOne or null
     */
    public function shippingAddress(): MorphOne
    {
        return $this->morphOne(Address::class, 'model')->where('type', 'shipping');
    }

    /**
     * Deletes all the addresses of this model.
     *
     * @return bool
     */
    public function flushAddresses(): bool
    {
        return $this->addresses()->delete();
    }
}
