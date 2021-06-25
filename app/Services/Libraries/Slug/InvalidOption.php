<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    1/30/21, 3:18 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Libraries\Slug;

use Exception;

class InvalidOption extends Exception
{
    /**
     * @return static
     */
    public static function missingFromField()
    {
        return new static('Could not determine which fields should be sluggified');
    }

    /**
     * @return static
     */
    public static function missingSlugField()
    {
        return new static('Could not determine in which field the slug should be saved');
    }

    /**
     * @return static
     */
    public static function invalidMaximumLength()
    {
        return new static('Maximum length should be greater than zero');
    }
}
