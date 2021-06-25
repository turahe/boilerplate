<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/23/21, 4:41 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageUploadHandler
{
    protected array $allowed_ext = ['jpeg', 'jpg', 'png', 'gif'];

    public function save($file, $folder, $max_width = false)
    {
        $folder_name = "uploads/{$folder}/".date('Ym/d', time());
        $upload_path = Storage::disk(config('filesystems.default', 'public'))->path($folder_name);
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
        $filename = time().'_'.Str::random(10).'.'.$extension;

        if (! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        $file->move($upload_path, $filename);

        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path.'/'.$filename, $max_width);
        }

        return [
            'path' => "{$folder_name}/{$filename}",
            'storage_path' => "/storage/{$folder_name}/{$filename}",
            'full_path' => Storage::disk(config('filesystems.default', 'public'))->url($folder_name.'/'.$filename),
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        $image = Image::make($file_path);
        $image->resize($max_width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->save();
    }
}
