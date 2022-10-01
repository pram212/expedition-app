<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\CRM\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\District;
use App\Models\Master\category;
use App\Models\Master\PaymentStatus;
use App\Models\Master\ShippmentStatus;
use App\Models\Village;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $districts = District::where('regency_id', 3276)->get();
        $villages = Village::whereIn('district_id', District::where('regency_id', 3276)->pluck('id'))->get();
        $categories = category::all();
        $paymentStatus = PaymentStatus::all();
        $shipmentStatus = ShippmentStatus::all();
        $orders = new Order();
        $limit = 10;

        if ($request->created_at) {
            $requestExplode = explode("-", str_replace(" ", "", $request->created_at ));
            $startDate =  date("Y-m-d", strtotime($requestExplode[0]));
            $endDate = date("Y-m-d", strtotime($requestExplode[1]));    
            $orders = $orders->whereDate('created_at', '>', $startDate)->whereDate('created_at', '<', $endDate);       
        }

        if ($request->category_id) {
            $orders = $orders->where('category_id', $request->category_id);
        }
        if ($request->customer_name) {
            $orders = $orders->where('customer_name', 'like', '%' . $request->customer_name . '%');
        }
        if ($request->id_card) {
            $orders = $orders->where('id_card', 'like', '%' . $request->id_card . '%');
        }
        if ($request->district_id) {
            $orders = $orders->where('district_id', $request->district_id);
        }
        if ($request->village_id) {
            $orders = $orders->where('village_id', $request->village_id);
        }
        if ($request->payment_statuses_id) {
            $orders = $orders->where('payment_statuses_id', $request->payment_statuses_id);
        }
        if ($request->shippment_statuses_id) {
            $orders = $orders->where('shippment_statuses_id', $request->shippment_statuses_id);
        }
        if ($request->limit) {
            $limit = $request->limit;
        }

        $orders = $orders->with('category', 'paymentStatus', 'shippmentStatus', 'district', 'village')->paginate($limit)->withQueryString();
        
        $filters = $request->all();

        return view('crm.order.IndexOrder', compact('orders', 'districts', 'categories', 'shipmentStatus', 'paymentStatus', 'orders', 'villages', 'filters'));
    }

    public function printInvoice($id)
    {
        $orders = Order::where('id', $id)->get();
        return view('reporting.print_invoice', compact('orders'));
    }

    public function printInvoiceMultiple(Request $request)
    {   
        $ids = explode(",",$request->ids_order);
        $orders = Order::whereIn('id', $ids)->get();
        return view('reporting.print_invoice', compact('orders'));
    }
}
