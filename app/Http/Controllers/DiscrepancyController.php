<?php

namespace App\Http\Controllers;

use App\Models\Discrepancy;
use App\Http\Requests\StoreDiscrepancyRequest;
use App\Http\Requests\UpdateDiscrepancyRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DiscrepancyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:discrepancy.index|discrepancy.create|discrepancy.show|discrepancy.edit|discrepancy.destroy', ['only'=>['index']]);
        $this->middleware('permission:discrepancy.create', ['only'=>['create','store']]);
        $this->middleware('permission:discrepancy.show', ['only'=>['show']]);
        $this->middleware('permission:discrepancy.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:discrepancy.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $discrepancies = Discrepancy::get();

            return DataTables::of($discrepancies)
            ->addIndexColumn()
            ->addColumn('status', function (Discrepancy $discrepancy) {
                return $discrepancy->status == 'inactive' ? 'Inactivo' : 'Activo';
            })
            ->addColumn('edit', 'admin/discrepancy/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.discrepancy.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.discrepancy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDiscrepancyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscrepancyRequest $request)
    {
        $discrepancy = new Discrepancy();
        $discrepancy->code = $request->code;
        $discrepancy->type = $request->type;
        $discrepancy->description = $request->description;
        $discrepancy->status = $request->status;
        $discrepancy->save();

        return redirect('discrepancy');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discrepancy  $discrepancy
     * @return \Illuminate\Http\Response
     */
    public function show(Discrepancy $discrepancy)
    {
        return view('admin.discrepancy.show', compact('discrepancy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discrepancy  $discrepancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Discrepancy $discrepancy)
    {
        return view('admin.discrepancy.edit', compact('discrepancy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDiscrepancyRequest  $request
     * @param  \App\Models\Discrepancy  $discrepancy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiscrepancyRequest $request, Discrepancy $discrepancy)
    {
        $discrepancy->code = $request->code;
        $discrepancy->type = $request->type;
        $discrepancy->description = $request->description;
        $discrepancy->status = $request->status;
        $discrepancy->update();

        return redirect('discrepancy');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discrepancy  $discrepancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discrepancy $discrepancy)
    {
        $discrepancy->delete();
        toast('Discrepancia eliminada con éxito.','success');
        return redirect('discrepancy');
    }
}
