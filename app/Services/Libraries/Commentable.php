<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    1/30/21, 3:18 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Libraries;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

trait Commentable
{
    /**
     * Check if model has an address.
     *
     * @return bool
     */
    public function hasComment(): bool
    {
        return (bool) $this->comments()->count();
    }

    /**
     * Return any address related to the model model.
     *
     * @return Collection
     */
    public function comment(): Collection
    {
        return $this->comments()->first();
    }

    /**
     * Return collection of addresses related to the tagged model.
     *
     * @return MorphMany
     */
    public function comments():MorphMany
    {
        return $this->morphMany(Comment::class, 'model');
    }
}
