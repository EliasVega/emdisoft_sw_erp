<?php

namespace App\Http\Controllers;

use App\Models\Tax;
use App\Http\Requests\StoreTaxRequest;
use App\Http\Requests\UpdateTaxRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TaxController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:tax.index|tax.create|tax.show|tax.edit|tax.destroy', ['only'=>['index']]);
        $this->middleware('permission:tax.create', ['only'=>['create','store']]);
        $this->middleware('permission:tax.show', ['only'=>['show']]);
        $this->middleware('permission:tax.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:tax.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $taxes = Tax::get();

            return DataTables::of($taxes)
            ->addIndexColumn()
            ->addColumn('branch', function (Tax $tax) {
                return $tax->taxable->branch->name;
            })
            ->addColumn('type', function (tax $tax) {
                if ($tax->type == 'purchase') {
                    return $tax->type == 'purchase' ? 'F. Compra' : 'Compra';
                } elseif ($tax->type == 'invoice') {
                    return $tax->type == 'invoice' ? 'F. Venta' : 'Venta';
                } else if($tax->type == 'ndpurchase') {
                    return $tax->type == 'ndpurchase' ? 'ND. Compra' : 'ND Compra';
                } else if($tax->type == 'ncpurchase') {
                    return $tax->type == 'ncpurchase' ? 'NC. Compra' : 'NC Compra';
                } else if($tax->type == 'ndinvoice') {
                    return $tax->type == 'ndinvoice' ? 'ND. Venta' : 'ND Venta';
                } else if($tax->type == 'ndinvoice') {
                    return $tax->type == 'ndinvoice' ? 'NC. Venta' : 'C. Venta';
                }
            })
            ->addColumn('document_id', function (Tax $tax) {
                return $tax->taxable->id;
            })
            ->addColumn('third', function (Tax $tax) {
                return $tax->taxable->third->name;
            })
            ->addColumn('identification', function (Tax $tax) {
                return $tax->taxable->third->identification;
            })
            ->addColumn('taxType', function (Tax $tax) {
                return $tax->companyTax->taxType->name;
            })
            ->addColumn('percentage', function (Tax $tax) {
                return $tax->companyTax->percentage->percentage;
            })
            ->editColumn('generation_date', function(Tax $tax){
                return $tax->created_at->format('yy-m-d');
            })
            ->addColumn('edit', 'admin/tax/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.tax.index');
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
     * @param  \App\Http\Requests\StoreTaxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function show(Tax $tax)
    {
        return view('admin.tax.show', compact('tax'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function edit(Tax $tax)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxRequest  $request
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxRequest $request, Tax $tax)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tax  $tax
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tax $tax)
    {
        //
    }
}
