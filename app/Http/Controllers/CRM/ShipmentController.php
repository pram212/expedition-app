<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\CRM\Order;
use App\Models\Master\ShippmentStatus;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = ShippmentStatus::all();

        return view('crm.operation.index_shipment', compact('shipments'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::whereIn($request->id)->get();
        return $order;
        $order->shippment_statuses_id = $request->shippment_statuses_id;
        
        $order->save();
        
        return "Status pengiriman berhasil diubah";
    }

    public function multiUpdate(Request $request)
    {
        Order::whereIn('id', $request->id)->update([
            'shippment_statuses_id' => $request->shippment_statuses_id,
        ]);
        
        return "Status pengiriman berhasil diubah";
    }

   
}
