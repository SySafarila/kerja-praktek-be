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

    public function midtrans_error_redirect($th)
    {
        switch ($th->getCode()) {
            case 400:
                // Log::error('400: Validation Error, merchant sends bad request data example; validation error, invalid transaction type, invalid credit card format, etc.');
                return redirect()->route('ppdb.index')->with('error', 'Error 400')->withInput();
                break;

            case 401:
                // Log::error('401: Access denied due to unauthorized transaction, please check client key or server key');
                return redirect()->route('ppdb.index')->with('error', 'Error 401')->withInput();
                break;

            case 402:
                return redirect()->route('ppdb.index')->with('error', 'Metode pembayaran yang dipilih sedang tidak tersedia, silahkan coba beberapa saat lagi.')->withInput();
                break;

            case 403:
                // Log::error("403: The requested resource is only capable of generating content not acceptable according to the accepting headers that sent in the request");
                return redirect()->route('ppdb.index')->with('error', 'Error 403')->withInput();
                break;

            case 404:
                // Log::error("404: The requested resource is not found");
                return redirect()->route('ppdb.index')->with('error', 'Error 404')->withInput();
                break;

            case 405:
                // Log::error("405: HTTP method is not allowed");
                return redirect()->route('ppdb.index')->with('error', 'Error 405')->withInput();
                break;

            case 406:
                // Log::error("406: Duplicate order ID. Order ID has already been utilized previously");
                return redirect()->route('ppdb.index')->with('error', 'Error 406')->withInput();
                break;

            case 407:
                // Log::error("407: Expired transaction");
                return redirect()->route('ppdb.index')->with('error', 'Error 407')->withInput();
                break;

            case 408:
                // Log::error("408: Merchant sends the wrong data type");
                return redirect()->route('ppdb.index')->with('error', 'Error 408')->withInput();
                break;

            case 410:
                // Log::error("410: Merchant account is deactivated. Please contact Midtrans support");
                return redirect()->route('ppdb.index')->with('error', 'Error 410')->withInput();
                break;

            case 411:
                // Log::error("411: Token id is missing, invalid, or timed out");
                return redirect()->route('ppdb.index')->with('error', 'Error 411')->withInput();
                break;

            case 412:
                // Log::error("412: Merchant cannot modify status of the transaction");
                return redirect()->route('ppdb.index')->with('error', 'Error 412')->withInput();
                break;

            case 413:
                // Log::error("413: The request cannot be processed due to malformed syntax in the request body");
                return redirect()->route('ppdb.index')->with('error', 'Error 413')->withInput();
                break;

            case 505:
                return redirect()->route('ppdb.index')->with('error', 'Metode pembayaran yang dipilih sedang tidak tersedia.')->withInput();
                break;

            case 501:
                // Log::error('501: Feature is not available yet');
                return redirect()->route('ppdb.index')->with('error', 'Error 501')->withInput();
                break;

            case 502:
                // Log::error('502: Internal Server Error: Bank Connection Problem');
                return redirect()->route('ppdb.index')->with('error', 'Koneksi dengan Bank terkait sedang bermasalah, silahkan coba beberapa saat lagi.')->withInput();
                break;

            case 503:
                // Log::error('503: Internal Server Error');
                return redirect()->route('ppdb.index')->with('error', 'Error 503')->withInput();
                break;

            case 504:
                // Log::error('504: Internal Server Error: Fraud detection is unavailable');
                return redirect()->route('ppdb.index')->with('error', 'Error 504')->withInput();
                break;

            case 505:
                // Log::error('505: Unable to create virtual account number for this transaction');
                return redirect()->route('ppdb.index')->with('error', 'Tidak dapat membuat virtual account untuk transaksi ini, silahkan coba beberapa saat lagi.')->withInput();
                break;

            default:
                return redirect()->route('ppdb.index')->with('error', $th->getMessage())->withInput();
                break;
        }
    }

    public function midtrans_error_logger($th)
    {
        switch ($th->getCode()) {
            case 400:
                Log::error('400: Validation Error, merchant sends bad request data example; validation error, invalid transaction type, invalid credit card format, etc.');
                break;

            case 401:
                Log::error('401: Access denied due to unauthorized transaction, please check client key or server key');
                break;

            case 402:
                Log::error("402: Merchant doesn't have access for this payment type");
                break;

            case 403:
                Log::error("403: The requested resource is only capable of generating content not acceptable according to the accepting headers that sent in the request");
                break;

            case 404:
                Log::error("404: The requested resource is not found");
                break;

            case 405:
                Log::error("405: HTTP method is not allowed");
                break;

            case 406:
                Log::error("406: Duplicate order ID. Order ID has already been utilized previously");
                break;

            case 407:
                Log::error("407: Expired transaction");
                break;

            case 408:
                Log::error("408: Merchant sends the wrong data type");
                break;

            case 410:
                Log::error("410: Merchant account is deactivated. Please contact Midtrans support");
                break;

            case 411:
                Log::error("411: Token id is missing, invalid, or timed out");
                break;

            case 412:
                Log::error("412: Merchant cannot modify status of the transaction");
                break;

            case 413:
                Log::error("413: The request cannot be processed due to malformed syntax in the request body");
                break;

            case 500:
                Log::error('500: Internal Server Error');
                break;

            case 501:
                Log::error('501: Feature is not available yet');
                break;

            case 502:
                Log::error('502: Internal Server Error: Bank Connection Problem');
                break;

            case 503:
                Log::error('503: Internal Server Error');
                break;

            case 504:
                Log::error('504: Internal Server Error: Fraud detection is unavailable');
                break;

            case 505:
                Log::error('505: Unable to create virtual account number for this transaction');
                break;

            default:
                Log::error($th->getCode() . ': ' . $th->getMessage());
                break;
        }
    }
}
