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

use App\Exceptions\InvalidPathException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Filepond
{
    /**
     * Converts the given path into a filepond server id.
     *
     * @param  string $path
     *
     * @return string
     */
    public function getServerIdFromPath(string $path): string
    {
        return Crypt::encryptString($path);
    }

    /**
     * Converts the given filepond server id into a path.
     *
     * @param  string $serverId
     *
     * @return string
     */
    public function getPathFromServerId(string $serverId): string
    {
        if (! trim($serverId)) {
            throw new InvalidPathException();
        }

        $filePath = Crypt::decryptString($serverId);
        if (! Str::startsWith($filePath, $this->getBasePath())) {
            throw new InvalidPathException();
        }

        return $filePath;
    }

    /**
     * Get the storage base path for files.
     *
     * @return string
     */
    public function getBasePath(): string
    {
        return Storage::disk('local')
            ->path('tmp');
    }
}
