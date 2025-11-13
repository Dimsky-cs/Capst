<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Konseling;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = config('services.midtrans.is_sanitized');
        Config::$is3ds = config('services.midtrans.is_3ds');
    }

    // Method untuk menampilkan halaman bayar (Snap)
    public function show($order_id)
    {
        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();
        $konseling = $transaction->konseling;
        $user = $konseling->user;

        // Jika token belum ada, buat baru
        if (empty($transaction->payment_token)) {
            $params = [
                'transaction_details' => [
                    'order_id' => $transaction->order_id,
                    'gross_amount' => $transaction->amount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                    'phone' => $konseling->client_phone,
                ],
                // [FITUR 2 JAM] Atur waktu kedaluwarsa
                'expiry' => [
                    'start_time' => $konseling->created_at->format('Y-m-d H:i:s O'),
                    'unit' => 'hour',
                    'duration' => 2,
                ],
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $transaction->payment_token = $snapToken;
                $transaction->save();
            } catch (\Exception $e) {
                return back()->with('error', $e->getMessage());
            }
        }

        return view('user.payment', compact('transaction'));
    }

    // Method untuk menangani Webhook/Callback dari Midtrans
    public function callback(Request $request)
    {
        $serverKey = config('services.midtrans.server_key');
        $notification = new Notification();

        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $order_id = $notification->order_id;
        $fraud = $notification->fraud_status;

        $transaction = Transaction::where('order_id', $order_id)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Update status transaksi
        if ($status == 'capture' || $status == 'settlement') {
            // Pembayaran berhasil
            $transaction->status = 'success';
            // Update status konseling
            $transaction->konseling->status = 'confirmed'; // atau 'paid'
            $transaction->konseling->save();
        } else if ($status == 'pending') {
            $transaction->status = 'pending';
        } else if ($status == 'deny' || $status == 'cancel' || $status == 'expire') {
            // Pembayaran gagal atau kedaluwarsa
            $transaction->status = 'failed';
            $transaction->konseling->status = 'cancelled';
            $transaction->konseling->save();
        }

        $transaction->save();

        return response()->json(['message' => 'Notification processed']);
    }
}
