<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/25/21, 9:54 AM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Turahe\Master\Contracts\Sortable;
use Turahe\Master\Traits\SortableTrait;

class Category extends Model implements HasMedia, Sortable
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    use HasFactory;
    use NodeTrait;
    use SortableTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        'parent_id',
        'title',
        'description',
        'layout',
        'type',
    ];

    /**
     * @return string
     */
    public function getLftName()
    {
        return 'record_left';
    }

    /**
     * @return string
     */
    public function getRgtName()
    {
        return 'record_right';
    }

    /**
     * @return string
     */
    public function getParentIdName()
    {
        return 'parent_id';
    }

    /**
     * Get cover image url.
     *
     * @return string
     */
    public function getCoverAttribute(): string
    {
        if ($this->hasMedia('image') && $this->relationLoaded('media') && config('filesystems.default') !== 'public') {
            return $this->getFirstTemporaryUrl(Carbon::now()->addHour(), 'image', 'sm');
        }

        if ($this->getFirstMediaUrl('image', 'sm')) {
            return $this->getFirstMediaUrl('image', 'sm');
        }

        return \Storage::url('images/not-found.jpg');
    }
    /**
     * one to many relationship category model and other models.
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'category_id', 'id')
            ->latest('published_at');
    }
}
