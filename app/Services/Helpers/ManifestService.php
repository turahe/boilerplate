<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/23/21, 4:41 PM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Helpers;

use App\Models\Option;
use Illuminate\Support\Facades\Storage;

/**
 * Class ManifestService.
 */
class ManifestService
{
    /**
     * @return array
     */
    public function generate(): array
    {
        $option = Option::all(['option_key', 'option_value'])->keyBy('option_key')->transform(function ($setting) {
            return $setting->option_value;
        });

        $basicManifest = [
            'name' => $option['site_name'],
            'short_name' => $option['site_title'],
            'start_url' => $option['start_url'],
            'display' => $option['display'],
            'theme_color' => $option['theme_color'],
            'background_color' => $option['background_color'],
            'orientation' =>  $option['orientation'],
            'status_bar' =>  $option['status_bar'],
        ];

        foreach (config('site.manifest.icons') as $size => $file) {
            $fileInfo = pathinfo($file['path']);
            $basicManifest['icons'][] = [
                'src' => Storage::url($file['path']),
                'type' => 'image/'.$fileInfo['extension'],
                'sizes' => $size,
                'purpose' => $file['purpose'],
            ];
        }

        if (config('site.manifest.shortcuts')) {
            foreach (config('site.manifest.shortcuts') as $shortcut) {
                if (array_key_exists('icons', $shortcut)) {
                    $fileInfo = pathinfo($shortcut['icons']['src']);
                    $icon = [
                        'src' => $shortcut['icons']['src'],
                        'type' => 'image/'.$fileInfo['extension'],
                        'purpose' => $shortcut['icons']['purpose'],
                    ];
                    if (isset($shortcut['icons']['sizes'])) {
                        $icon['sizes'] = $shortcut['icons']['sizes'];
                    }
                } else {
                    $icon = [];
                }

                $basicManifest['shortcuts'][] = [
                    'name' => trans($shortcut['name']),
                    'description' => trans($shortcut['description']),
                    'url' => $shortcut['url'],
                    'icons' => [
                        $icon,
                    ],
                ];
            }
        }

        foreach (config('site.manifest.custom') as $tag => $value) {
            $basicManifest[$tag] = $value;
        }

        return $basicManifest;
    }
}
