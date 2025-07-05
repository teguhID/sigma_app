<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
        Config::$appendNotifUrl = config('midtrans.notification_url');
        Config::$overrideNotifUrl = config('midtrans.override_notification_url');
    }

    public function createTransaction(array $params)
    {
        return Snap::createTransaction($params);
    }

    public function getSnapToken(array $params)
    {
        try {
            $transaction = $this->createTransaction($params);
            return $transaction->token;
        } catch (\Exception $e) {
            throw new \Exception("Midtrans Error: " . $e->getMessage());
        }
    }

    public function handleNotification()
    {
        return new \Midtrans\Notification();
    }
}
