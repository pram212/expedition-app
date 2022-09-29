<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Models\CRM\Order;
use App\Models\District;
use App\Models\Master\category;
use App\Models\Master\PaymentStatus;
use App\Models\Master\ShippmentStatus;
use App\Models\Village;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        return view('crm.order.index_order', compact('orders', 'districts', 'categories', 'shipmentStatus', 'paymentStatus', 'orders', 'villages', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::where('regency_id', 3276)->get();
        $categories = category::all();
        $paymentStatus = PaymentStatus::all();
        $shipmentStatus = ShippmentStatus::all();

        return view('crm.order.create_order', compact('districts', 'categories', 'shipmentStatus', 'paymentStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        Order::create($request->all());
        return redirect('/crm/order')->with('success', 'Konsumen baru Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $districts = District::where('regency_id', 3276)->get();
        $villages = Village::where('district_id', $order->district_id)->get();
        $categories = category::all();
        $paymentStatus = PaymentStatus::all();
        $shipmentStatus = ShippmentStatus::all();

        return view('crm.order.edit_order', compact('districts', 'categories', 'shipmentStatus', 'paymentStatus', 'order', 'villages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrderRequest $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());

        return redirect('/crm/order')->with('success', 'Konsumen Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function multiDestroy(Request $request)
    {
        $ids = explode(",", $request->ids_orders);
        Order::destroy($ids);
        return back()->with('success', 'Data berhasil dihapus');

    }
}
