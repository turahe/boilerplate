<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/26/21, 12:29 AM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace Turahe\FlashDeal\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Turahe\Store\Models\Product;

class FlashDealProduct extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = 'flash_deal_products';

    /**
     * @return BelongsTo
     */
    public function flashDeal(): BelongsTo
    {
        return $this->belongsTo(FlashDeal::class, 'flash_deal_id')->withDefault([
            'title' => __('status.undefined'),
        ]);
    }

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id')->withDefault([
            'title' => __('status.undefined'),
        ]);
    }

}
