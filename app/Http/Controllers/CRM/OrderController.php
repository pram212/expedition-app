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
    public function index()
    {
        return view('crm.order.index_order');
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
        Order::destroy($request->id);

        return response("Data berhasil dihapus");

    }
}
