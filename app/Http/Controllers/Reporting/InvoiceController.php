<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\CRM\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('reporting.index_invoice');
    }

    public function printInvoice($id)
    {
        $orders = Order::where('id', $id)->get();
        $pdf = Pdf::loadview('reporting.pdf_invoice', compact('orders'));

        return $pdf->stream();
    }

    public function printInvoiceMultiple(Request $request)
    {   
        $ids = explode(",",$request->ids_order);
        $orders = Order::whereIn('id', $ids)->get();
        $pdf = Pdf::loadview('reporting.pdf_invoice', compact('orders'));
        return $pdf->stream();
    }
}
