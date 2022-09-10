<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\Order;
use App\Models\Master\PaymentStatus;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = PaymentStatus::all();

        return view('crm.operation.index_payment', compact('payments'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        
        $paymentVal = $order->payment_statuses_id == 1 ? 2 : 1;
        
        $order->payment_statuses_id = $paymentVal;
        
        $order->save();

        $message = $paymentVal == 2 ? "Pembayaran berhasil disimpan" : "Pembayaran berhasil dibatalkan";
        
        return $message;
    }
}
