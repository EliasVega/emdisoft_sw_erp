<?php

namespace App\Http\Controllers;

use App\Models\CompanyTax;
use App\Http\Requests\StoreCompanyTaxRequest;
use App\Http\Requests\UpdateCompanyTaxRequest;
use App\Models\Percentage;
use App\Models\TaxType;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CompanyTaxController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:companyTax.index|companyTax.create|companyTax.show|companyTax.edit|companyTax.destroy', ['only'=>['index']]);
        $this->middleware('permission:companyTax.create', ['only'=>['create','store']]);
        $this->middleware('permission:companyTax.show', ['only'=>['show']]);
        $this->middleware('permission:companyTax.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:companyTax.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $companyTaxes = CompanyTax::get();

            return DataTables::of($companyTaxes)
            ->addIndexColumn()
            ->addColumn('taxType', function (CompanyTax $companyTax) {
                return $companyTax->taxType->name;
            })
            ->addColumn('percentage', function (CompanyTax $companyTax) {
                return $companyTax->percentage->percentage;
            })
            ->addColumn('edit', 'admin/companyTax/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.companyTax.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taxTypes = TaxType::get();
        $percentages = Percentage::get();
        return view('admin.companyTax.create', compact('taxTypes', 'percentages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompanyTaxRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyTaxRequest $request)
    {
        $companyTax = new CompanyTax();
        $companyTax->name = $request->name;
        $companyTax->description = $request->description;
        $companyTax->tax_type_id = $request->tax_type_id;
        $companyTax->percentage_id = $request->percentage_id;
        $companyTax->save();
        return redirect("companyTax");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyTax  $companyTax
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyTax $companyTax)
    {
        return view('admin.tax.show', compact('tax'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyTax  $companyTax
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyTax $companyTax)
    {
        $taxTypes = TaxType::get();
        $percentages = Percentage::get();
        return view('admin.companyTax.edit', compact('companyTax', 'taxTypes', 'percentages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyTaxRequest  $request
     * @param  \App\Models\CompanyTax  $companyTax
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyTaxRequest $request, CompanyTax $companyTax)
    {
        $companyTax->name = $request->name;
        $companyTax->description = $request->description;
        $companyTax->tax_type_id = $request->tax_type_id;
        $companyTax->percentage_id = $request->percentage_id;
        $companyTax->update();

        Alert::success('Impuesto','Editado Satisfactoriamente.');
        return redirect("companyTax");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyTax  $companyTax
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyTax $companyTax)
    {
        $companyTax->delete();
        toast('Impuesto Eliminado con Exito.','success');
        return redirect("companyTax");
    }
}
