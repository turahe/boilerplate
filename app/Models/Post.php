<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/24/21, 12:04 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Models;

use App\Services\Libraries\Post\Markdown;
use App\Services\Libraries\Post\ReadTime\ReadTime;
use App\Services\Libraries\Slug\HasSlug;
use App\Services\Libraries\Slug\SlugOptions;
use App\Traits\ActivityTraits;
use App\Traits\Comments\HasComments;
use App\Traits\HasMetadata;
use App\Traits\HasTags;
use App\Traits\Rateable;
use Carbon\Carbon;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Turahe\Counters\Traits\HasCounter;
use Turahe\Likeable\Contracts\Likeable as LikeableContract;
use Turahe\Likeable\Traits\Likeable;
use Turahe\Master\Contracts\Sortable;
use Turahe\Master\Traits\SortableTrait;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property int|null $parent_id
 * @property int|null $category_id
 * @property int $user_id
 * @property string $slug
 * @property string $title
 * @property string|null $subtitle subtitle of title post
 * @property string|null $description description of post
 * @property string $content_raw
 * @property string $content_html
 * @property string $type
 * @property int $is_sticky
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string|null $layout
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Counters\Models\Counter[] $counters
 * @property-read int|null $counters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $dislikes
 * @property-read int $dislikes_count
 * @property-read \Turahe\Likeable\Models\LikeCounter|null $dislikesCounter
 * @property-read mixed $average_rating
 * @property-read string $content
 * @property-read string $cover
 * @property-read bool $disliked
 * @property-read mixed|string $excerpt
 * @property-read bool $liked
 * @property-read int|null $likes_count
 * @property-read int $likes_diff_dislikes_count
 * @property-read ReadTime $read_time
 * @property-read mixed $sum_rating
 * @property-read string $url
 * @property-read mixed $user_average_rating
 * @property-read mixed $user_sum_rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $likes
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $likesAndDislikes
 * @property-read int|null $likes_and_dislikes_count
 * @property-read \Turahe\Likeable\Models\LikeCounter|null $likesCounter
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-write mixed $tags
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\PostFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Query\Builder|Post onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Post orderByDislikesCount($direction = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|Post orderByLikesCount($direction = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|Post ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Post popular()
 * @method static \Illuminate\Database\Eloquent\Builder|Post published()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContentHtml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContentRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereDislikedBy($userId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereIsSticky($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLayout($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereLikedBy($userId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereSubtitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withAllTags($tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withAnyTags($tags, ?string $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Post withAnyTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Query\Builder|Post withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Post withoutTrashed()
 * @mixin \Eloquent
 */
class Post extends Model implements HasMedia, Sortable, LikeableContract
{
    use HasFactory;
    use InteractsWithMedia;
    use SoftDeletes;
    use SortableTrait;
    use HasSlug;
    use HasTags;
    use HasMetadata;
    use HasCounter;
    use HasFactory;
    use Rateable;
    use Likeable;
    use ActivityTraits;
    use HasComments;

    /**
     * @var array
     */
    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'parent_id',
        'title',
        'subtitle',
        'description',
        'content_raw',
        'content_html',
        'type',
        'is_sticky',
        'order_column',
        'published_at',
        'layout',
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
     * @param null|Media $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->format('webp')
            ->width(64)
            ->height(64)
            ->crop('crop-center', 64, 64)
            ->sharpen(10)
            ->optimize()
            ->quality(70);
//            ->withResponsiveImages();

        $this->addMediaConversion('slider')
            ->format('webp')
            ->width(526)
            ->height(307)
            ->crop('crop-center', 526, 307)
            ->sharpen(10)
            ->optimize()
            ->quality(70);
//            ->withResponsiveImages();

        $this->addMediaConversion('medium')
            ->format('webp')
            ->width(600)
            ->height(350)
            ->crop('crop-center', 600, 360)
            ->sharpen(10)
            ->optimize()
            ->quality(70);
//            ->withResponsiveImages();
    }

    /**
     * @return string
     */
    public function getCoverAttribute(): string
    {
//        if ($this->hasMedia() && $this->relationLoaded('media')) {
        return $this->getFirstTemporaryUrl(Carbon::now()->addHour(), 'image', 'medium');
//        }

//        return \Storage::url('images/not-found.jpg');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function newFactory()
    {
        return PostFactory::new();
    }

    /**
     * Count read time.
     *
     * @throws \Exception
     * @return ReadTime
     */
    public function getReadTimeAttribute(): ReadTime
    {
        $content = $this->content;
        $omitSeconds = config('site.omit_seconds');
        $timeOnly = config('site.time_only');
        $abbreviated = config('site.abbreviate_time_measurements');
        $wordsPerMinute = config('site.words_per_minute');
        $ltr = __('read-time.reads_left_to_right');
        $translation = __('read-time');

        return (new ReadTime($content))
            ->omitSeconds($omitSeconds)
            ->timeOnly($timeOnly)
            ->abbreviated($abbreviated)
            ->wpm($wordsPerMinute)
            ->ltr($ltr)
            ->setTranslation($translation);
    }

    /**
     * Return URL to post.
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        if (request()->expectsJson()) {
            return route('api.blogs.show', $this);
        }

        return route('blog.show', $this);
    }

    /**
     * Check if model has an address.
     *
     * @return bool
     */
    public function hasComment(): bool
    {
        return (bool) $this->comments->count();
    }

    /**
     * Return any address related to the model model.
     *
     * @return mixed
     */
    public function comment()
    {
        return $this->comments->first();
    }

    /**
     * Return collection of addresses related to the tagged model.
     * Ordered comment by latest published.
     * And get comment was approved by user or admin.
     *
     * @return MorphMany
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'model');
    }

    /**
     * Set the HTML content automatically when the raw content is set.
     *
     * @param string $value
     */
    public function setContentRawAttribute(string $value): void
    {
        $markdown = new Markdown();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->generate($value);
    }

    /**
     * Alias for content_raw.
     * @return string
     */
    public function getContentAttribute(): string
    {
        return $this->content_raw;
    }

    /**
     * @return mixed|string
     */
    public function getExcerptAttribute(): string
    {
        if ($this->description !== null) {
            return $this->description;
        }

        return Str::limit($this->content_raw);
    }

    /**
     * one to many relationship between user and posts
     * example: $post->user->name.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => __('status.undefined'),
        ]);
    }

    /**
     * Define an inverse one-to-one or many relationship.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id')->withDefault([
            'title' => __('status.undefined'),
        ]);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        if (request()->expectsJson()) {
            return 'id';
        }

        return 'slug';
    }

    /**
     * Scope a query to only include published blogs.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where([
                ['status', '=', 1],
                ['approved', '=', 1],
                ['published_at', '<=', now()],
            ]);
    }

    /**
     * Scope a query to most popular blogs.
     * calculate from rating and google analytics views.
     *
     * @return
     */
    public function scopePopular(): ?int
    {
        return $this->ratings_count;
    }
}
