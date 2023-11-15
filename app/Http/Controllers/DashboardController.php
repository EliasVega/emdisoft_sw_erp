<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::get();
        $invoices = Invoice::get();
        $dateactual = Carbon::now();
        $year = $dateactual->format('Y');
        $lastYear = $year - 1;

        $invoiceLastYear = [];
        $invoiceThisYear = [];
        $invoiceLastMonth = [];
        $invoiceThisMonth = [];
        $purchaseThisMonth = [];
        $invoiceTotalMonth = 0;
        $purchaseTotalMonth = 0;

        $day = [];
        $cont = 0;
        for ($i=30; $i >= 0; $i--) {
            $date = Carbon::now();
            $fecha = $date->subDay($i);
            $day[$cont] = $fecha->format('d') . '-';

            $dateThisMonth = $fecha->toDateString();
            $invoiceThisMonth[$cont] = Invoice::whereDate('created_at', $dateThisMonth)->sum('total_pay');
            if ($invoiceThisMonth[$cont] == null) {
                $invoiceThisMonth[$cont] = '0.00';
            }
            $invoiceTotalMonth += $invoiceThisMonth[$cont];

            $purchaseThisMonth[$cont] = Purchase::whereDate('created_at', $dateThisMonth)->sum('total_pay');
            if ($purchaseThisMonth[$cont] == null) {
                $purchaseThisMonth[$cont] = '0.00';
            }
            $purchaseTotalMonth += $purchaseThisMonth[$cont];
            $cont++;
        }
        $invoicesByMonth = $invoices->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y-m');
        });
        for ($i=0; $i < 12; $i++) {

            $invoiceLastYear[$i] = Invoice::whereYear('created_at', $lastYear)->whereMonth('created_at', $i + 1)->sum('total_pay');
        }
        for ($i=0; $i < 12; $i++) {

            $invoiceThisYear[$i] = Invoice::whereYear('created_at', $year)->whereMonth('created_at', $i + 1)->sum('total_pay');
            if ($invoiceThisYear[$i] == 0) {
                $invoiceThisYear[$i] = '0.00';
            }
        }
        $invoiceYear = Invoice::whereYear('created_at', $year)->sum('total_pay');
        //dd($invoiceThisYear);
        $purchaseTotal = 0;
        $invoiceTotal = 0;

        if ($purchases != null) {
            foreach ($purchases as $purchase) {
                $purchaseTotal = $purchaseTotal + $purchase->sum('total_pay');
            }
        }

        if ($invoices != null) {
            foreach ($invoices as $invoice) {
                $invoiceTotal = $invoiceTotal + $invoice->sum('total_pay');
            }
        }

        $invoicesByPaymentForm = $invoices->groupBy('payment_form_id', function ($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        });

        $invoicesByDepartment = $invoices->groupBy('third.municipality_id');

        return view('admin.dashboard.index', compact(
            'invoicesByMonth',
            'purchaseTotal',
            'invoiceTotal',
            'invoicesByPaymentForm',
            'invoicesByDepartment',
            'invoiceLastYear',
            'invoiceThisYear',
            'invoiceYear',
            'day',
            'invoiceThisMonth',
            'purchaseThisMonth',
            'invoiceTotalMonth',
            'purchaseTotalMonth'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
