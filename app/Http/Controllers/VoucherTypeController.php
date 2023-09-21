<?php

namespace App\Http\Controllers;

use App\Models\VoucherType;
use App\Http\Requests\StoreVoucherTypeRequest;
use App\Http\Requests\UpdateVoucherTypeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VoucherTypeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:voucherType.index|voucherType.create|voucherType.show|voucherType.edit|voucherType.destroy', ['only'=>['index']]);
        $this->middleware('permission:voucherType.create', ['only'=>['create','store']]);
        $this->middleware('permission:voucherType.show', ['only'=>['show']]);
        $this->middleware('permission:voucherType.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:voucherType.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $voucherTypes = VoucherType::all();

            return DataTables::of($voucherTypes)
            ->addIndexColumn()
            ->addColumn('status', function (VoucherType $voucherType) {
                return $voucherType->status == 'inactive' ? 'Inactivo' : 'Activo';
            })
            ->addColumn('actions', 'admin/voucherType/actions')
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.voucherType.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucherType.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVoucherTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoucherTypeRequest $request)
    {
        VoucherType::create($request->all());

        return redirect('voucherType')->with(
            'success_message',
            'Tipo de comprobante registrado con éxito.'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoucherType  $voucherType
     * @return \Illuminate\Http\Response
     */
    public function show(VoucherType $voucherType)
    {
        return view('admin.voucherType.show', compact('voucherType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoucherType  $voucherType
     * @return \Illuminate\Http\Response
     */
    public function edit(VoucherType $voucherType)
    {
        return view('admin.voucherType.edit', compact('voucherType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoucherTypeRequest  $request
     * @param  \App\Models\VoucherType  $voucherType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoucherTypeRequest $request, VoucherType $voucherType)
    {
        $voucherType->update($request->all());

        return redirect()->route('voucherType.index')->with(
            'success_message',
            'Tipo de comprobante editado con éxito.'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoucherType  $voucherType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoucherType $voucherType)
    {
        $voucherType->delete();
        toast('Tipo de comprobante Eliminado con Exito.','success');
        return redirect('voucherType');
    }
}
