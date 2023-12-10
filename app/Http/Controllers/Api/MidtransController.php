<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $midtransConfig = json_decode($this->startMidtransConfig());

        $response = new \Midtrans\Notification();

        $transaction = $response->transaction_status;
        $type = $response->payment_type;
        $order_id = $response->order_id;
        $transaction_id = $response->transaction_id;
        $fraud = $response->fraud_status;
        $signature = $response->signature_key;
        $hash = hash('sha512', $order_id . $response->status_code . $response->gross_amount . $midtransConfig->serverKey);

        if ($hash != $signature) {
            Log::error('INVOICE CODE : ' . $order_id . ' invalid signature');
            return response()->json([
                'message' => 'signature invalid'
            ], 400);
        }

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            return $this->midtrans_settlement(Transaction::where('transaction_id', $transaction_id), $response);
        } else if ($transaction == 'pending') {
            // return $this->orderPending($order_id, $response);
            Log::debug('pending');
            return true;
        } else if ($transaction == 'deny') {
            // return $this->orderDeny($order_id, $response);
            Log::debug('deny');
            return true;
        } else if ($transaction == 'expire') {
            return $this->midtrans_expire(Transaction::where('transaction_id', $transaction_id), $response);
            Log::debug('expire');
            return true;
        } else if ($transaction == 'cancel') {
            // return $this->orderCancel($order_id, $response);
            Log::debug('cancel');
            return true;
        } elseif ($transaction == 'refund') {
            // return $this->orderRefund($order_id, $response);
            Log::debug('refund');
            return true;
        } elseif ($transaction = 'partial_refund') {
            // return $this->orderPartialRefund($order_id, $response);
            Log::debug('partial_refund');
            return true;
        }
    }
}
