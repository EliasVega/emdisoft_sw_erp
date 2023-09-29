<?php

namespace App\Http\Controllers;

use App\Models\CashOutflow;
use App\Http\Requests\StoreCashOutflowRequest;
use App\Http\Requests\UpdateCashOutflowRequest;
use App\Models\CashRegister;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class CashOutflowController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:cashOutflow.index|cashOutflow.store', ['only'=>['index']]);
        $this->middleware('permission:cashOutflow.store', ['only'=>['store']]);
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
                //Consulta para mostrar salidas de efectivo a admin y superadmin
                $cashOutflows = CashOutflow::get();
            } else {
                //Consulta para mostrar salidas de efectivo de los demas roles
                $cashOutflows = CashOutflow::where('user_id', $users->id);
            }
            return DataTables::of($cashOutflows)
            ->addIndexColumn()
            ->addColumn('branch', function (CashOutflow $cashOutflow) {
                return $cashOutflow->branch->name;
            })
            ->addColumn('user', function (CashOutflow $cashOutflow) {
                return $cashOutflow->user->name;
            })
            ->addColumn('admin', function (CashOutflow $cashOutflow) {
                return $cashOutflow->admin->name;
            })
            ->addColumn('cash', function (CashOutflow $cashOutflow) {
                return number_format($cashOutflow->cash, 2);
            })
            ->editColumn('created_at', function(CashOutflow $cashOutflow){
                return $cashOutflow->created_at->format('yy-m-d: h:m');
            })
            ->make(true);
        }

        return view('admin.cash_outflow.index');
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
     * @param  \App\Http\Requests\StoreCashOutflowRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashOutflowRequest $request)
    {
        $user = Auth::user();
        $admin_id = $request->admin_id;
        $code = $request->admin;
        $cash = $request->cash;
        $verificationCode = VerificationCode::select('id', 'code')->where('user_id', '=', $admin_id)->first();
        $cashRegister = CashRegister::where('user_id', '=', $user->id)->where('status', '=', 'open')->first();

        if($verificationCode == null){
            toast('Usuario No autorizado para ejercer como administrador.','warning');
            return redirect("cashOutflow");
        }

        if ($verificationCode->code != $code) {
            toast('Error en codigo de verificacion.','warning');
            return redirect("cashOutflow");
        } else {
            $cashOutflow = new CashOutflow();
            $cashOutflow->user_id = $user->id;
            $cashOutflow->cash_register_id = $cashRegister->id;
            $cashOutflow->branch_id = $user->branch_id;
            $cashOutflow->admin_id = $admin_id;
            $cashOutflow->cash = $cash;
            $cashOutflow->reason = $request->reason;
            $cashOutflow->save();

            $cashRegister->out_cash += $cash;
            $cashRegister->out_total += $cash;
            $cashRegister->cash_out_total += $cash;
            $cashRegister->update();
        }
        toast('Entrega de efectivo de la Caja realizado con exito.','success');
        return redirect("cashOutflow");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashOutflow  $cashOutflow
     * @return \Illuminate\Http\Response
     */
    public function show(CashOutflow $cashOutflow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashOutflow  $cashOutflow
     * @return \Illuminate\Http\Response
     */
    public function edit(CashOutflow $cashOutflow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashOutflowRequest  $request
     * @param  \App\Models\CashOutflow  $cashOutflow
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashOutflowRequest $request, CashOutflow $cashOutflow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashOutflow  $cashOutflow
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashOutflow $cashOutflow)
    {
        //
    }
}
