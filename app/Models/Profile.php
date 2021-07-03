<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/24/21, 5:41 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Profile
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string $first_name
 * @property string|null $last_name
 * @property string|null $alias
 * @property int|null $gender true is female (because women are always right) and false male
 * @property string|null $birthplace
 * @property string|null $birthday
 * @property string|null $religion
 * @property string|null $marital
 * @property string|null $citizenship
 * @property string|null $number_personnel
 * @property string|null $number_citizen
 * @property string|null $number_taxpayer
 * @property string|null $number_passport
 * @property string|null $hobby
 * @property int|null $weight
 * @property int|null $height
 * @property int|null $size_shoes
 * @property int|null $size_shirt
 * @property int|null $size_pants
 * @property string|null $blood
 * @property string|null $eyes
 * @property string|null $rhesus
 * @property string|null $biography
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\ProfileFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAlias($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBlood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCitizenship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEyes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereHobby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMarital($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNumberCitizen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNumberPassport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNumberPersonnel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereNumberTaxpayer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereReligion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereRhesus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSizePants($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSizeShirt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSizeShoes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereWeight($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    use HasFactory;
}
