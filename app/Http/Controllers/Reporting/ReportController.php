<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\CRM\Order;
use App\Models\District;
use App\Models\Master\category;
use App\Models\Master\PaymentStatus;
use App\Models\Master\ShippmentStatus;
use App\Models\Village;
use Illuminate\Http\Request;

class ReportController extends Controller
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


        if (!$request->filter) {
           $orders = [];
        } else {
            $orders = new Order();
            if ($request->created_at) {
                // $requestdate = str_replace(" ", "", $request->created_at );
                $requestExplode = explode("-", str_replace(" ", "", $request->created_at ));
                $startDate =  date("Y-m-d", strtotime($requestExplode[0]));
                $endDate = date("Y-m-d", strtotime($requestExplode[1]));    
                $orders = $orders->whereDate('created_at', '>', $startDate)->whereDate('created_at', '<', $endDate);       
            }

            if ($request->category_id) {
                $orders = $orders->where('category_id', $request->category_id);
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

            $orders = $orders->with('category', 'paymentStatus', 'shippmentStatus', 'district', 'village')->get();
            
        }

        $filters = $request->all();

        return view('reporting.index_reporting', compact('districts', 'categories', 'shipmentStatus', 'paymentStatus', 'orders', 'villages', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
