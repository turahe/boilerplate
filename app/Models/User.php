<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Turahe\Counters\Traits\HasCounter;
use Turahe\Wallet\Interfaces\PointRoyaltyInterface;
use Turahe\Wallet\Interfaces\Wallet;
use Turahe\Wallet\Traits\HasPointRoyalty;
use Turahe\Wallet\Traits\HasWallet;

class User extends Authenticatable implements HasMedia, MustVerifyEmail, Wallet, PointRoyaltyInterface
{
    use Notifiable;
    use HasFactory;
    use HasApiTokens;
    use InteractsWithMedia;
    use SoftDeletes;
    use HasRoles;
    use HasCounter;
    use HasWallet;
    use HasPointRoyalty;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param null|Media $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large')
            ->width(256)
            ->height(256)
            ->sharpen(10)
            ->optimize();

        $this->addMediaConversion('medium')
            ->width(180)
            ->height(180)
            ->sharpen(10)
            ->optimize();

        $this->addMediaConversion('small')
            ->width(120)
            ->height(120)
            ->sharpen(10)
            ->optimize();

        $this->addMediaConversion('x-small')
            ->width(88)
            ->height(88)
            ->sharpen(10)
            ->optimize();
    }
}
