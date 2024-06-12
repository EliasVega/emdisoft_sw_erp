<?php

namespace App\Http\Controllers;

use App\Models\charge;
use App\Http\Requests\StorechargeRequest;
use App\Http\Requests\UpdatechargeRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ChargeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:charge.index|charge.create|charge.show|charge.edit|charge.destroy', ['only'=>['index']]);
        $this->middleware('permission:charge.create', ['only'=>['create','store']]);
        $this->middleware('permission:charge.show', ['only'=>['show']]);
        $this->middleware('permission:charge.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:charge.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $charges = Charge::get();

            return DataTables::of($charges)
                ->addColumn('edit', 'admin/charge/actions')
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.charge.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.charge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorechargeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorechargeRequest $request)
    {
        $charge = new Charge();
        $charge->name = $request->name;
        $charge->description = $request->description;
        $charge->status = $request->status;
        $charge->save();

        Alert::success('Cargo','Creado Satisfactoriamente.');
        return redirect('charge');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function show(charge $charge)
    {
        return view("admin.charge.show", compact('charge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function edit(charge $charge)
    {
        return view("admin.charge.edit", compact('charge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatechargeRequest  $request
     * @param  \App\Models\charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatechargeRequest $request, charge $charge)
    {
        $charge->name = $request->name;
        $charge->description = $request->description;
        $charge->status = $request->status;
        $charge->update();

        Alert::success('Cargo','Editado Satisfactoriamente.');
        return redirect('charge');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\charge  $charge
     * @return \Illuminate\Http\Response
     */
    public function destroy(charge $charge)
    {
        $charge->delete();
        toast('Cargo eliminado con éxito.','success');
        return redirect("charge");
    }
}
