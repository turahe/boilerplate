<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/26/21, 12:32 AM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace Turahe\FlashDeal\Models;


use App\Services\Libraries\Slug\HasSlug;
use App\Services\Libraries\Slug\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class FlashDeal extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use LogsActivity;
    use HasSlug;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'start_date',
        'end_date',
    ];

    /**
     * @return SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * @param string $collectionName
     * @return HasMedia
     */
    public function clearMediaCollection(string $collectionName = 'default'): HasMedia
    {
        $this->clearMediaCollectionExcept('default', $this->getFirstMedia());
        // This will remove all associated media in the 'images' collection except the first media
    }

    /**
     * @param null|Media $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('banner')
            ->width(1170)
            ->height(600)
            ->sharpen(10)
            ->optimize()
            ->quality(70)
            ->withResponsiveImages();
    }

    /**
     * @return HasMany
     */
    public function flashProducts(): HasMany
    {
        return $this->hasMany(FlashDealProduct::class, 'flash_deal_id');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'flash_deal_products', 'flash_deal_id', 'product_id');
    }

}
