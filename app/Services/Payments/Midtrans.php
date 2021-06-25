<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    4/9/21, 12:55 AM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

namespace App\Services\Payments;

use App\Models\Order;

class Midtrans
{
    /**
     * Generate payment token.
     *
     * @param Order $order order data
     *
     * @return void
     */
    private function _generatePaymentToken($order)
    {
        $this->initPaymentGateway();

        $customerDetails = [
            'first_name' => $order->customer_first_name,
            'last_name' => $order->customer_last_name,
            'email' => $order->customer_email,
            'phone' => $order->customer_phone,
        ];

        $params = [
            'enable_payments' => \App\Models\Payment::PAYMENT_CHANNELS,
            'transaction_details' => [
                'order_id' => $order->code,
                'gross_amount' => $order->grand_total,
            ],
            'customer_details' => $customerDetails,
            'expiry' => [
                'start_time' => date('Y-m-d H:i:s T'),
                'unit' => \App\Models\Payment::EXPIRY_UNIT,
                'duration' => \App\Models\Payment::EXPIRY_DURATION,
            ],
        ];

        $snap = \Midtrans\Snap::createTransaction($params);

        if ($snap->token) {
            $order->payment_token = $snap->token;
            $order->payment_url = $snap->redirect_url;
            $order->save();
        }
    }

    /**
     * Initiate payment gateway request object.
     *
     * @return void
     */
    private function initPaymentGateway()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }
}
