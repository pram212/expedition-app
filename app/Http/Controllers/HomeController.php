<?php

namespace App\Http\Controllers;

use App\Models\CRM\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalOrders = Order::count();

        $tagihan = Order::where('payment_statuses_id', 1)
                        ->where('shippment_statuses_id', '!=', 3)
                        ->count();

        $pemasukan = Order::where('payment_statuses_id', 2)
                        ->where('shippment_statuses_id', '!=', 3)
                        ->count();

        $totaltagihan =  number_format( $tagihan * 20000 , 2, ',', '.');
        $totalPemasukan =  number_format( $pemasukan * 20000 , 2, ',', '.');

        return view('home', compact('totalOrders', 'totaltagihan', 'totalPemasukan'));
    }
}
