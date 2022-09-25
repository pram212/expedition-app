<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CRM\Order;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class DatatablesController extends Controller
{
    public function getOrder()
    {
        $orders = Order::all();
        return DataTables::of($orders)
                    ->addIndexColumn()
                    ->addColumn('action', function($orders) {
                        $buttonEl = "<a href='" . url('crm/order/' . $orders->id . '/edit') . "' class='btn btn-primary w-100'>Edit</a>";
                        return $buttonEl;
                    })
                    ->addColumn('check', function($orders) {
                        return "<input class='order-checkbox' type='checkbox' name='selected_orders[]' value='".$orders->id."'>";
                    })
                    ->editColumn('category_id', function($orders) {
                        return  strtoupper(@$orders->category->name) ;
                    })
                    ->editColumn('payment_statuses_id', function($orders) {
                        $startTag = ($orders->payment_statuses_id == 2) 
                            ?"<div class='text-center p-1 rounded shadow text-success'>"
                            :"<div class='text-center p-1 rounded shadow text-danger'>";
                        $endTag = "</div>";
                        return $startTag . strtoupper(@$orders->paymentStatus->name)  . $endTag ;
                    })
                    ->editColumn('shippment_statuses_id', function($orders) {
                        if ($orders->shippment_statuses_id == 1) {
                            $textColor = "text-warning";
                        } else if ($orders->shippment_statuses_id == 2) {
                            $textColor = "text-success";
                        } else {
                            $textColor = "text-danger";
                        }

                        $startTag = "<div class='text-center p-1 rounded shadow ". $textColor ." text-success'>";
                        $endTag = "</div>";
                        return $startTag . strtoupper(@$orders->shippmentStatus->name)  . $endTag ;
                    })
                    ->editColumn('district_id', function($orders) {
                        return  @$orders->district->name ;
                    })
                    ->editColumn('village_id', function($orders) {
                        return  @$orders->village->name ;
                    })
                    ->editColumn('created_at', function($orders) {
                        return  date('d/m/Y', strtotime(@$orders->created_at)) ;
                    })
                    ->rawColumns(['action', 'payment_statuses_id', 'shippment_statuses_id'])
                    ->make(true);
    }

    public function getOrderPayment()
    {
        $orders = Order::get();
        return DataTables::of($orders)
                    ->addIndexColumn()
                    ->addColumn('action', function($orders) {
                        $buttonEl = ($orders->payment_statuses_id == 1)
                                    ? "<button class='btn btn btn-warning w-100' type='button'>Bayar</button>" 
                                    : "<button class='btn btn btn-danger w-100' type='button'>Cancel</button>";
                        return $buttonEl;
                    })
                    ->editColumn('category_id', function($orders) {
                        return  strtoupper(@$orders->category->name) ;
                    })
                    ->editColumn('payment_statuses_id', function($orders) {
                        $startTag = ($orders->payment_statuses_id == 2) 
                            ?"<div class='text-center p-1 rounded shadow text-success'>"
                            :"<div class='text-center p-1 rounded shadow text-danger'>";
                        $endTag = "</div>";
                        return $startTag . strtoupper(@$orders->paymentStatus->name)  . $endTag ;
                    })
                    ->editColumn('shippment_statuses_id', function($orders) {
                        return  @$orders->shippmentStatus->name ;
                    })
                    ->editColumn('district_id', function($orders) {
                        return  @$orders->district->name ;
                    })
                    ->editColumn('village_id', function($orders) {
                        return  @$orders->village->name ;
                    })
                    ->editColumn('created_at', function($orders) {
                        return  date('d/m/Y', strtotime(@$orders->created_at)) ;
                    })
                    ->rawColumns(['action', 'payment_statuses_id'])
                    ->make(true);
    }

    public function getOrderShipment()
    {
        $orders = Order::get();
        return DataTables::of($orders)
                    ->addIndexColumn()
                    ->editColumn('category_id', function($orders) {
                        return  strtoupper(@$orders->category->name) ;
                    })
                    ->editColumn('payment_statuses_id', function($orders) {
                        $startTag = ($orders->payment_statuses_id == 2) 
                            ?"<div class='text-center p-1 rounded shadow text-success'>"
                            :"<div class='text-center p-1 rounded shadow text-danger'>";
                        $endTag = "</div>";
                        return $startTag . strtoupper(@$orders->paymentStatus->name)  . $endTag ;
                    })
                    ->editColumn('shippment_statuses_id', function($orders) {
                        if ($orders->shippment_statuses_id == 1) {
                            $textColor = "text-warning";
                        } else if ($orders->shippment_statuses_id == 2) {
                            $textColor = "text-success";
                        } else {
                            $textColor = "text-danger";
                        }

                        $startTag = "<div class='text-center p-1 rounded shadow ". $textColor ." text-success'>";
                        $endTag = "</div>";
                        return $startTag . strtoupper(@$orders->shippmentStatus->name)  . $endTag ;
                    })
                    ->editColumn('district_id', function($orders) {
                        return  @$orders->district->name ;
                    })
                    ->editColumn('village_id', function($orders) {
                        return  @$orders->village->name ;
                    })
                    ->editColumn('created_at', function($orders) {
                        return  date('d/m/Y', strtotime(@$orders->created_at)) ;
                    })
                    ->rawColumns(['payment_statuses_id', 'shippment_statuses_id'])
                    ->make(true);
    }

    public function getInvoiceOrder()
    {
        $orders = Order::get();
        return DataTables::of($orders)
                    ->addIndexColumn()
                    ->editColumn('category_id', function($orders) {
                        return  strtoupper(@$orders->category->name) ;
                    })
                    ->editColumn('payment_statuses_id', function($orders) {
                       
                        return  ucwords(@$orders->paymentStatus->name);
                    })
                    ->editColumn('shippment_statuses_id', function($orders) {
                        return ucwords(@$orders->shippmentStatus->name);
                    })
                    ->editColumn('district_id', function($orders) {
                        return  @$orders->district->name ;
                    })
                    ->editColumn('village_id', function($orders) {
                        return  @$orders->village->name ;
                    })
                    ->editColumn('created_at', function($orders) {
                        return  date('d/m/Y', strtotime(@$orders->created_at)) ;
                    })
                    ->addColumn('action', function($orders) {
                        $buttonEl = "<a href='". url('invoice/print/'. $orders->id)."' target='_blank' class='btn btn btn-info w-100' type='button'>Cetak</a>";
                        return $buttonEl;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }
}
