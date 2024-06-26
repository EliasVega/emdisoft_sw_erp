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
        $this->middleware('permission:indicator.index|indicator.edit|indicator.dianStatus|indicator.posStatus|indicator.logoStatus|indicator.payrollStatus|indicator.workLaborStatus|indicator.accountingStatus|indicator.inventoryStatus|indicator.productPrice|indicator.materialStatus|indicator.restaurantStatus|indicator.barcodeStatus', ['only'=>['index']]);
        $this->middleware('permission:indicator.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:indicator.dianStatus', ['only'=>['dianStstus']]);
        $this->middleware('permission:indicator.posStatus', ['only'=>['posStstus']]);
        $this->middleware('permission:indicator.logoStatus', ['only'=>['logoStstus']]);
        $this->middleware('permission:indicator.payrollStatus', ['only'=>['payrollStatus']]);
        $this->middleware('permission:indicator.workLaborStatus', ['only'=>['workLaborStatus']]);
        $this->middleware('permission:indicator.accountingStatus', ['only'=>['accountingStatus']]);
        $this->middleware('permission:indicator.inventoryStatus', ['only'=>['inventoryStatus']]);
        $this->middleware('permission:indicator.productPrice', ['only'=>['productPrice']]);
        $this->middleware('permission:indicator.materialStatus', ['only'=>['materialStatus']]);
        $this->middleware('permission:indicator.restaurantStatus', ['only'=>['restaurantStatus']]);
        $this->middleware('permission:indicator.barcodeStatus', ['only'=>['barcodeStatus']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $indicators = Indicator::findOrFail(1);

        return view('admin.indicator.index', compact('indicators'));
    }

    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $indicators = Indicator::get();
            return DataTables::of($indicators)
            ->addColumn('edit', 'admin/indicator/actions')
            ->addColumn('dian', 'admin/indicator/dian')
            ->addColumn('pos', 'admin/indicator/pos')
            ->addColumn('logo', 'admin/indicator/logo')
            ->addColumn('payroll', 'admin/indicator/payroll')
            ->addColumn('workLabor', 'admin/indicator/workLabor')
            ->addColumn('accounting', 'admin/indicator/accounting')
            ->addColumn('inventory', 'admin/indicator/inventory')
            ->addColumn('productPrice', 'admin/indicator/productPrice')
            ->addColumn('rawMaterial', 'admin/indicator/rawMaterial')
            ->addColumn('restaurant', 'admin/indicator/restaurant')
            ->addColumn('barcode', 'admin/indicator/codebar')
            ->addColumn('cvpinvoice', 'admin/indicator/cvpinvoice')
            ->addColumn('sqio', 'admin/indicator/sqio')
            ->addColumn('sqio', 'admin/indicator/cmep')
            ->addColumn('imgp', 'admin/indicator/imgp')
            ->addColumn('price_with_tax', 'admin/indicator/priceWithTax')
            ->rawColumns([
                'edit',
                'dian',
                'pos',
                'logo',
                'payroll',
                'workLabor',
                'accounting',
                'productPrice',
                'inventory',
                'rawMaterial',
                'restaurant',
                'barcode',
                'cvpinvoice',
                'sqio',
                'cmep',
                'imgp',
                'priceWithTax'
                ])
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
        $indicator->weekly_hours = $request->weekly_hours;
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

    public function posStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->pos == 'on') {
            $indicator->pos = 'off';
        } else {
            $indicator->pos = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function logoStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->logo == 'on') {
            $indicator->logo = 'off';
        } else {
            $indicator->logo = 'on';
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

    public function workLaborStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->work_labor == 'on') {
            $indicator->work_labor = 'off';
        } else {
            $indicator->work_labor = 'on';
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

    public function materialStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->raw_material == 'on') {
            $indicator->raw_material = 'off';
        } else {
            $indicator->raw_material = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function restaurantStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->restaurant == 'on') {
            $indicator->restaurant = 'off';
        } else {
            $indicator->restaurant = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function barcodeStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->barcode == 'on') {
            $indicator->barcode = 'off';
        } else {
            $indicator->barcode = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function cvpinvoiceStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->cvpinvoice == 'on') {
            $indicator->cvpinvoice = 'off';
        } else {
            $indicator->cvpinvoice = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function sqioStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->sqio == 'on') {
            $indicator->sqio = 'off';
        } else {
            $indicator->sqio = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function cmepStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->cmep == 'employee') {
            $indicator->cmep = 'product';
        } else {
            $indicator->cmep = 'employee';
        }
        $indicator->update();

        return redirect('indicator');
    }
    public function imgpStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->imgp == 'on') {
            $indicator->imgp = 'off';
        } else {
            $indicator->imgp = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }

    public function priceWithTaxStatus($id)
    {
        $indicator = Indicator::findOrFail($id);

        if ($indicator->price_with_tax == 'on') {
            $indicator->price_with_tax = 'off';
        } else {
            $indicator->price_with_tax = 'on';
        }
        $indicator->update();

        return redirect('indicator');
    }
}
