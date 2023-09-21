<?php

namespace App\Http\Controllers;

use App\Models\Liability;
use App\Http\Requests\StoreLiabilityRequest;
use App\Http\Requests\UpdateLiabilityRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class LiabilityController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:liability.index|liability.create|liability.show|liability.edit|liability.destroy', ['only'=>['index']]);
        $this->middleware('permission:liability.create', ['only'=>['create','store']]);
        $this->middleware('permission:liability.show', ['only'=>['show']]);
        $this->middleware('permission:liability.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:liability.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $liabilities = Liability::get();

            return DataTables::of($liabilities)
            ->addColumn('edit', 'admin/liability/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.liability.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.liability.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLiabilityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLiabilityRequest $request)
    {
        $liability = new Liability();
        $liability->code = $request->code;
        $liability->name = $request->name;
        $liability->save();

        return redirect('liability');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Liability  $liability
     * @return \Illuminate\Http\Response
     */
    public function show(Liability $liability)
    {
        return view('admin.liability.show', compact('liability'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Liability  $liability
     * @return \Illuminate\Http\Response
     */
    public function edit(Liability $liability)
    {
        return view('admin.liability.edit', compact('liability'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLiabilityRequest  $request
     * @param  \App\Models\Liability  $liability
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLiabilityRequest $request, Liability $liability)
    {
        $liability->code = $request->code;
        $liability->name = $request->name;
        $liability->update();

        return redirect('liability');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Liability  $liability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liability $liability)
    {
        $liability->delete();
        toast('Responsabilidad Fiscal eliminada con éxito.','success');
        return redirect('liability');
    }
}
