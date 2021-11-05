<?php

namespace App\Controllers\Midtrans;

use App\Controllers\BaseController;

class Payment extends BaseController
{
    public function index()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-TQY02mTXOhm-WoCWAKLNj8LX';
        
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'payment_type' => 'gopay',
            'gopay' => array(
                'enable_callback' => true,                // optional
                'callback_url' => 'someapps://callback'   // optional
            )
        );
        
        $data = [
            'snapToken' => \Midtrans\Snap::getSnapToken($params)
        ];

        return view('Admin_View/Pembelian/bayar', $data);

    }
}

