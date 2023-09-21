<?php

namespace App\Http\Controllers;

use App\Models\Regime;
use App\Http\Requests\StoreRegimeRequest;
use App\Http\Requests\UpdateRegimeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RegimeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:regime.index|regime.create|regime.show|regime.edit|regime.destroy', ['only'=>['index']]);
        $this->middleware('permission:regime.create', ['only'=>['create','store']]);
        $this->middleware('permission:regime.show', ['only'=>['show']]);
        $this->middleware('permission:regime.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:regime.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $regimes = Regime::get();

            return DataTables::of($regimes)
            ->addColumn('edit', 'admin/regime/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.regime.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.regime.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRegimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegimeRequest $request)
    {
        $regime = new Regime();
        $regime->code = $request->code;
        $regime->name = $request->name;
        $regime->save();
        return redirect("regime");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Regime  $regime
     * @return \Illuminate\Http\Response
     */
    public function show(Regime $regime)
    {
        return view('admin.regime.show', compact('regime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Regime  $regime
     * @return \Illuminate\Http\Response
     */
    public function edit(Regime $regime)
    {
        return view('admin.regime.edit', compact('regime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegimeRequest  $request
     * @param  \App\Models\Regime  $regime
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegimeRequest $request, Regime $regime)
    {
        $regime->code = $request->code;
        $regime->name = $request->name;
        $regime->update();
        return redirect('regime');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Regime  $regime
     * @return \Illuminate\Http\Response
     */
    public function destroy(Regime $regime)
    {
        $regime->delete();
        toast('Regimen Eliminado con Exito.','success');
        return redirect("regime");
    }
}
