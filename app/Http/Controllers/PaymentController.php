<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tr_user_registration;
use App\Services\MidtransService;

class PaymentController extends Controller
{
    public function notification(Request $request)
    {
        return response()->json([
            'data' => $request->all(),
            'status' => 'success'
        ]);
    }

    public function update(Request $request)
    {
        $orderId = $request->order_id ?? null;
        $transactionStatus = $request->transaction_status ?? 'unknown';

        $statusBayar = match ($transactionStatus) {
            'settlement', 'capture' => 'paid',
            'pending' => 'pending',
            'expire' => 'expired',
            'cancel', 'deny', 'failure', 'cancelled' => 'failed',
            default => 'pending'
        };

        $registration = tr_user_registration::where('order_id', $orderId)->first();

        if (!$registration) {
            return redirect()->back()->with('status', [
                'type' => 'error',
                'message' => "Transaksi tidak ditemukan: $orderId"
            ]);
        }

        $statusMap = [
            'pending' => 1,
            'paid' => 2,
            'expired' => 3,
            'failed' => 4
        ];

        $registration->id_status_bayar = $statusMap[$statusBayar] ?? 1;
        $registration->updated_by = 'midtrans_callback';
        $registration->save();

        return redirect()->back()->with('status', [
            'type' => 'success',
            'message' => "Status pembayaran berhasil diperbarui menjadi: $statusBayar"
        ]);
    }

    public function finishPayment($registrationId)
    {
        $registration = tr_user_registration::find($registrationId);

        if (!$registration) {
            return redirect()->route('payment.failed');
        }

        return view('payment.finish', [
            'registration' => $registration,
            'status' => $registration->status_bayar->name
        ]);
    }
}
