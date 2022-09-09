<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\CRM\RegisterKiaRequest;
use App\Http\Requests\CRM\RegisterKtpRequest;
use App\Models\CRM\Order;
use App\Models\District;
use App\Models\Village;
use Illuminate\Http\Request;

class OrderRegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function createKtp()
    {
        $districts = District::where('regency_id', 3276)->get();
        return view('crm.registration.create_ktp', compact('districts'));
    }

    public function createKia()
    {
        $districts = District::where('regency_id', 3276)->get();
        return view('crm/registration/create_kia', compact('districts'));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterKtpRequest $request)
    {
        // $order = Order::create($request->all());
        
        // $request->session()->flash('success', 'Pendaftaran Berhasil');

        // return view('crm/registration/invoice', compact('order'));
        
    }

    public function storeKtp(RegisterKtpRequest $request)
    {
        $order = Order::create($request->all());
        
        $request->session()->flash('success', 'Pendaftaran Berhasil');

        return view('crm/registration/invoice', compact('order'));
        
    }

    public function storeKia(RegisterKiaRequest $request)
    {
        $order = Order::create($request->all());
        
        $request->session()->flash('success', 'Pendaftaran Berhasil');

        return view('crm/registration/invoice', compact('order'));
        
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

    public function getVillage($district)
    {
        $village = Village::where('district_id', $district)->get();

        return $village;
    }
}
