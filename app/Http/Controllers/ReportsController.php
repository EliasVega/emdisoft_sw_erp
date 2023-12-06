<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Purchase;
use App\Models\RestaurantOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReportsController extends Controller
{
    public function reportInvoice(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . ' 00:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDate . ' 23:59:59');

                $invoices = Invoice::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            } else {
                $invoices = Invoice::get();
            }
            return DataTables::of($invoices)
            ->addIndexColumn()
            ->addColumn('customer', function (Invoice $invoice) {
                return $invoice->third->name;
            })
            ->addColumn('identification', function (Invoice $invoice) {
                return $invoice->third->identification;
            })
            ->make(true);
        }
        return view('admin.reports.reportInvoice');
    }

    public function reportPurchase(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . ' 00:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDate . ' 23:59:59');

                $purchases = Purchase::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            } else {
                $purchases = Purchase::get();
            }
            return DataTables::of($purchases)
            ->addIndexColumn()
            ->addColumn('customer', function (Purchase $purchase) {
                return $purchase->third->name;
            })
            ->addColumn('identification', function (Purchase $purchase) {
                return $purchase->third->identification;
            })
            ->make(true);
        }
        return view('admin.reports.reportPurchase');
    }

    public function reportRestaurantOrder(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . ' 00:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDate . ' 23:59:59');

                $restaurantOrders = RestaurantOrder::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            } else {
                $restaurantOrders = RestaurantOrder::get();
            }
            return DataTables::of($restaurantOrders)
            ->addIndexColumn()
            ->addColumn('status', function (RestaurantOrder $restaurantOrder) {
                if ($restaurantOrder->status == 'pending') {
                    return $restaurantOrder->status == 'pendisng' ? 'Comanda' : 'Comanda';
                } elseif ($restaurantOrder->status == 'generated') {
                    return $restaurantOrder->status == 'generated' ? 'Facturada' : 'Facturada';
                }elseif ($restaurantOrder->status == 'canceled') {
                    return $restaurantOrder->status == 'canceled' ? 'Anulada' : 'Anulada';
                }
            })
            ->addColumn('invoice', function (RestaurantOrder $restaurantOrder) {
                if ($restaurantOrder->invoice == null) {
                    return null;
                } else {
                    return $restaurantOrder->invoice->document;
                }
            })
            ->addColumn('user', function (RestaurantOrder $restaurantOrder) {
                return $restaurantOrder->user->name;
            })
            ->addColumn('table', function (RestaurantOrder $restaurantOrder) {
                return $restaurantOrder->restaurantTable->name;
            })
            ->editColumn('created_at', function(RestaurantOrder $restaurantOrder){
                return $restaurantOrder->created_at->format('Y-m-d');
            })
            ->make(true);
        }
        return view('admin.reports.reportRestaurantOrder');
    }
}
