<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/23/21, 4:41 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait UploadableTrait
{
    /**
     * Upload a single file in the server.
     *
     * @param UploadedFile $file
     * @param null $folder
     * @param string $disk
     * @param null $filename
     * @return false|string
     */
    public function uploadOne(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = ! is_null($filename) ? $filename : Str::random(25);

        return $file->storeAs(
            $folder,
            $name.'.'.$file->getClientOriginalExtension(),
            $disk
        );
    }

    /**
     * @param UploadedFile $file
     *
     * @param string $folder
     * @param string $disk
     *
     * @return false|string
     */
    public function storeFile(UploadedFile $file, $folder = 'products', $disk = 'public')
    {
        return $file->store(config('app.unique_id').DIRECTORY_SEPARATOR.$folder, ['disk' => $disk]);
    }
}
