<?php

namespace App\Http\Controllers;

use App\Models\MidtransKey;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function startMidtransConfig()
    {
        $isProd = false;
        $serverKey = null;
        $clientKey = null;
        $midtransProd = MidtransKey::where('type', 'isProduction')->first();
        if ($midtransProd) {
            if ($midtransProd->isProd) {
                \Midtrans\Config::$isProduction = true;
                $isProd = true;

                $serverKeyProd = MidtransKey::where('type', 'server key prod')->first();
                if ($serverKeyProd) {
                    \Midtrans\Config::$serverKey = $serverKeyProd->key;
                    $serverKey = $serverKeyProd->key;
                } else {
                    Log::debug('server key prod not found in midtrans_keys table');
                    // return back()->with('error', 'Transaction failed, please try again later...');
                    throw new Exception('Transaction failed, please try again later...');
                }

                $clientKeyProd = MidtransKey::where('type', 'client key prod')->first();
                if ($clientKeyProd) {
                    \Midtrans\Config::$clientKey = $clientKeyProd->key;
                    $clientKey = $clientKeyProd->key;
                } else {
                    Log::debug('client key prod not found in midtrans_keys table');
                    // return back()->with('error', 'Transaction failed, please try again later...');
                    throw new Exception('Transaction failed, please try again later...');
                }
            } else {
                \Midtrans\Config::$isProduction = false;

                $serverKeyDev = MidtransKey::where('type', 'server key dev')->first();
                if ($serverKeyDev) {
                    \Midtrans\Config::$serverKey = $serverKeyDev->key;
                    $serverKey = $serverKeyDev->key;
                } else {
                    Log::debug('server key Dev not found in midtrans_keys table');
                    // return back()->with('error', 'Transaction failed, please try again later...');
                    throw new Exception('Transaction failed, please try again later...');
                }

                $clientKeyDev = MidtransKey::where('type', 'client key dev')->first();
                if ($clientKeyDev) {
                    \Midtrans\Config::$clientKey = $clientKeyDev->key;
                    $clientKey = $clientKeyDev->key;
                } else {
                    Log::debug('client key Dev not found in midtrans_keys table');
                    // return back()->with('error', 'Transaction failed, please try again later...');
                    throw new Exception('Transaction failed, please try again later...');
                }
            }
        } else {
            Log::debug('isProduction not found in midtrans_keys table');
            // return back()->with('error', 'Transaction failed, please try again later...');
            throw new Exception('Transaction failed, please try again later...');
        }

        return json_encode([
            'isProd' => $isProd,
            'serverKey' => $serverKey,
            'clientKey' => $clientKey
        ]);
    }
}
