<?php

namespace App\Http\Controllers;

use App\Models\CashInflow;
use App\Http\Requests\StoreCashInflowRequest;
use App\Http\Requests\UpdateCashInflowRequest;
use App\Models\CashRegister;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CashInflowController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:cashInflow.index|cashInflow.store', ['only'=>['index']]);
        $this->middleware('permission:cashInflow.store', ['only'=>['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar entradas de efectivo a admin y superadmin
                $cashInflows = CashInflow::get();
            } else {
                //Consulta para mostrar entradas de efectivo de los demas roles
                $cashInflows = CashInflow::where('user_id', $users->id);
            }
            return DataTables::of($cashInflows)
            ->addIndexColumn()
            ->addColumn('branch', function (CashInflow $cashInflow) {
                return $cashInflow->branch->name;
            })
            ->addColumn('admin', function (CashInflow $cashInflow) {
                return $cashInflow->admin->name;
            })
            ->addColumn('user', function (CashInflow $cashInflow) {
                return $cashInflow->user->name;
            })
            ->addColumn('cash', function (CashInflow $cashInflow) {
                return number_format($cashInflow->cash, 2);
            })
            ->editColumn('created_at', function(CashInflow $cashInflow){
                return $cashInflow->created_at->format('yy-m-d: h:m');
            })
            ->make(true);
        }

        return view('admin.cash_inflow.index');
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
     * @param  \App\Http\Requests\StoreCashInflowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashInflowRequest $request)
    {
        $user = Auth::user();
        $cash = $request->cash;
        $cashRegister = CashRegister::where('user_id', '=', $user->id)->where('status', '=', 'open')->first();

        $cashInflow = new CashInflow();
        $cashInflow->cash = $cash;
        $cashInflow->reason = $request->reason;
        $cashInflow->cash_register_id = $cashRegister->id;
        $cashInflow->user_id = $user->id;
        $cashInflow->branch_id = $user->branch_id;
        $cashInflow->admin_id = $request->admin_id;
        $cashInflow->save();

        $cashRegister->cash_in_total += $cash;
        $cashRegister->in_cash += $cash;
        $cashRegister->in_total += $cash;
        $cashRegister->update();

        toast('Recarga de Caja creada Satisfactoriamente.','success');
        return redirect("cashInflow");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashInflow  $cashInflow
     * @return \Illuminate\Http\Response
     */
    public function show(CashInflow $cashInflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashInflow  $cashInflow
     * @return \Illuminate\Http\Response
     */
    public function edit(CashInflow $cashInflow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashInflowRequest  $request
     * @param  \App\Models\CashInflow  $cashInflow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashInflowRequest $request, CashInflow $cashInflow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashInflow  $cashInflow
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashInflow $cashInflow)
    {
        //
    }
}
