<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/24/21, 5:42 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Models;

use App\Traits\ActivityTraits;
use App\Traits\HasMetadata;
use App\Traits\Rateable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Turahe\Likeable\Traits\Likeable;
use Turahe\Master\Contracts\Sortable;
use Turahe\Master\Traits\SortableTrait;

/**
 * App\Models\Comment
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $parent_id
 * @property int|null $order_column
 * @property string $model_type
 * @property int $model_id
 * @property string|null $title
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property string $type comment, review ,testimony faq, featured
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Comment[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $dislikes
 * @property-read int $dislikes_count
 * @property-read \Turahe\Likeable\Models\LikeCounter|null $dislikesCounter
 * @property-read mixed $average_rating
 * @property-read string $date
 * @property-read bool $disliked
 * @property-read Comment $first_child
 * @property-read bool $liked
 * @property-read int|null $likes_count
 * @property-read int $likes_diff_dislikes_count
 * @property-read string $month
 * @property-read mixed $publish
 * @property-read mixed $publish_date
 * @property-read mixed $publish_time
 * @property-read Collection $siblings
 * @property-read mixed $sum_rating
 * @property-read mixed $user_average_rating
 * @property-read mixed $user_sum_rating
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $likes
 * @property-read \Illuminate\Database\Eloquent\Collection|\Turahe\Likeable\Models\Like[] $likesAndDislikes
 * @property-read int|null $likes_and_dislikes_count
 * @property-read \Turahe\Likeable\Models\LikeCounter|null $likesCounter
 * @property-read Model|\Eloquent $model
 * @property-read Comment|null $parent
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\CommentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Query\Builder|Comment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment orderByDislikesCount($direction = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|Comment orderByLikesCount($direction = 'desc')
 * @method static \Illuminate\Database\Eloquent\Builder|Comment ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereDislikedBy($userId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereLikedBy($userId = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Comment withoutTrashed()
 * @mixin \Eloquent
 */
class Comment extends Model implements Sortable
{
    use SoftDeletes;
    use HasMetadata;
    use HasFactory;
    use ActivityTraits;
    use Likeable;
    use Rateable;
    use SortableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'parent_id',
        'title',
        'content',
        'type',
        'published_at',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

    /**
     * get publish attribute.
     *
     * @param $value
     * @throws \Exception
     * @return mixed
     */
    public function getPublishAttribute($value): string
    {
        return $this->attributes['published_at'] = Carbon::parse($value)->format('D, M Y');
    }

    /**
     * get publish date attribute.
     *
     * @param $value
     * @throws \Exception
     * @return mixed
     */
    public function getPublishDateAttribute($value): string
    {
        return $this->attributes['published_at'] = Carbon::parse($value)->format('Y-m-d');
    }

    /**
     * get publish time attribute.
     *
     * @param $value
     * @throws \Exception
     * @return mixed
     */
    public function getPublishTimeAttribute($value): string
    {
        return $this->attributes['published_at'] = Carbon::parse($value)->format('H:i');
    }

    /**
     * get publish date attribute.
     *
     * @param $value
     * @return string
     */
    public function getDateAttribute($value): string
    {
        return $this->attributes['published_at'] = Carbon::parse($value)->format('d');
    }

    /**
     * get publish month attribute.
     *
     * @param $value
     * @return string
     */
    public function getMonthAttribute($value): string
    {
        return $this->attributes['published_at'] = Carbon::parse($value)->format('M');
    }

    /**
     * Comment has children.
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->orderBy('order_column');
    }

    /**
     * Count category if have children.
     *
     * @return bool
     */
    public function hasChildren(): bool
    {
        if ($this->wherehas('children')) {
            return count($this->children);
        }

        return false;
    }

    /**
     * @throws \Exception
     * @return Comment
     */
    public function getFirstChildAttribute(): self
    {
        if (! $this->hasChildren()) {
            throw new \Exception("Comment `{$this->title}` doesn't have any children.");
        }

        return $this->children->sortBy('order_column')->first();
    }

    /**
     * @return Collection
     */
    public function getSiblingsAttribute(): Collection
    {
        return self::where('parent_id', $this->parent_id)
            ->orderBy('order_column')
            ->get();
    }

    /**
     * Parent of children.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id')->withDefault([
            'title' => __('status.undefined'),
        ]);
    }

    /**
     * check if model has parent.
     *
     * @return bool
     */
    public function hasParent(): bool
    {
        return ! is_null($this->parent_id);
    }

    /**
     * Return the comment's user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return  $this->belongsTo(User::class, 'user_id')->withDefault([
            'name' => __('status.undefined'),
        ]);
    }

    /**
     * Return the review's products
     * Many to one polymorphic relationship between reviews and products.
     *
     * @return MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param \DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

}
