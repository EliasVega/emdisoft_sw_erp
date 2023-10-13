<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Http\Requests\StoreIndicatorRequest;
use App\Http\Requests\UpdateIndicatorRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IndicatorController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:indicator.index|indicator.edit|indicator.dianStatus|indicator.postStatus|indicator.payrollStatus|indicator.accountingStatus|indicator.inventoryStatus', ['only'=>['index']]);
        $this->middleware('permission:indicator.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:indicator.dianStatus', ['only'=>['postStstus']]);
        $this->middleware('permission:indicator.postStatus', ['only'=>['postStstus']]);
        $this->middleware('permission:indicator.payrollStatus', ['only'=>['payrollStatus']]);
        $this->middleware('permission:indicator.accountingStatus', ['only'=>['accountingStatus']]);
        $this->middleware('permission:indicator.inventoryStatus', ['only'=>['inventoryStatus']]);
        $this->middleware('permission:indicator.productPrice', ['only'=>['productPrice']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $indicators = Indicator::get();

            return DataTables::of($indicators)
            ->addColumn('edit', 'admin/indicator/actions')
            ->addColumn('dian', 'admin/indicator/dian')
            ->addColumn('post', 'admin/indicator/post')
            ->addColumn('payroll', 'admin/indicator/payroll')
            ->addColumn('accounting', 'admin/indicator/accounting')
            ->addColumn('inventory', 'admin/indicator/inventory')
            ->addColumn('productPrice', 'admin/indicator/productPrice')
            ->rawColumns(['edit', 'dian', 'post', 'payroll', 'accounting', 'productPrice', 'inventory'])
            ->make(true);
        }

        return view('admin.indicator.index');
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
     * @param  \App\Http\Requests\StoreIndicatorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIndicatorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function show(Indicator $indicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function edit(Indicator $indicator)
    {
        return view('admin.indicator.edit', compact('indicator'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateIndicatorRequest  $request
     * @param  \App\Models\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIndicatorRequest $request, Indicator $indicator)
    {
        $indicator->smlv = $request->smlv;
        $indicator->transport_assistance = $request->transport_assistance;
        $indicator->uvt = $request->uvt;
        $indicator->plastic_bag_tax = $request->plastic_bag_tax;
        $indicator->update();
        return redirect('indicator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indicator $indicator)
    {
        //
    }

    public function dianStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->dian == 'on') {
            $indicator->dian = 'off';
        } else {
            $indicator->dian = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function postStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->post == 'on') {
            $indicator->post = 'off';
        } else {
            $indicator->post = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function payrollStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->payroll == 'on') {
            $indicator->payroll = 'off';
        } else {
            $indicator->payroll = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function accountingStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->accounting == 'on') {
            $indicator->accounting = 'off';
        } else {
            $indicator->accounting = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function inventoryStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->inventory == 'on') {
            $indicator->inventory = 'off';
        } else {
            $indicator->inventory = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function productPrice($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->product_price == 'automatic') {
            $indicator->product_price = 'manual';
        } else {
            $indicator->product_price = 'automatic';
        }
        $indicator->update();

        return redirect('indicator');
    }
}
