<?php

namespace App\Http\Controllers;

use App\Models\TaxType;
use App\Http\Requests\StoreTaxTypeRequest;
use App\Http\Requests\UpdateTaxTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TaxTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:taxType.index|taxType.create|taxType.show|taxType.edit|taxType.destroy', ['only'=>['index']]);
        $this->middleware('permission:taxType.create', ['only'=>['create','store']]);
        $this->middleware('permission:taxType.show', ['only'=>['show']]);
        $this->middleware('permission:taxType.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:taxType.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $taxTypes = TaxType::get();

            return DataTables::of($taxTypes)
            ->addColumn('edit', 'admin/taxType/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.taxType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.taxType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaxTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaxTypeRequest $request)
    {
        //dd($request->all());
        $taxType = new TaxType();
        $taxType->code = $request->code;
        $taxType->name = $request->name;
        $taxType->description = $request->description;
        $taxType->type_tax = $request->type_tax;
        $taxType->save();
        return redirect("taxType");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaxType  $taxType
     * @return \Illuminate\Http\Response
     */
    public function show(TaxType $taxType)
    {
        return view('admin.taxType.show', compact('taxType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaxType  $taxType
     * @return \Illuminate\Http\Response
     */
    public function edit(TaxType $taxType)
    {
        return view('admin.taxType.edit', compact('taxType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxTypeRequest  $request
     * @param  \App\Models\TaxType  $taxType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxTypeRequest $request, TaxType $taxType)
    {
        $taxType->code = $request->code;
        $taxType->name = $request->name;
        $taxType->description = $request->description;
        switch($request->type_tax) {
            case(1):
                $taxType->type_tax = 'tax_item';
            break;
            case(2):
                $taxType->type_tax = 'retention';
            break;
            case(3):
                $taxType->type_tax = 'tax_global';
            break;
            default:
        }
        $taxType->update();
        return redirect("taxType");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaxType  $taxType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxType $taxType)
    {
        $taxType->delete();
        toast('Impuesto Eliminado con Exito.','success');
        return redirect("taxType");
    }
}
