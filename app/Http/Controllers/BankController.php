<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class BankController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:bank.index|bank.create|bank.show|bank.edit|bank.destroy', ['only'=>['index']]);
        $this->middleware('permission:bank.create', ['only'=>['create','store']]);
        $this->middleware('permission:bank.show', ['only'=>['show']]);
        $this->middleware('permission:bank.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:bank.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $banks = Bank::get();

            return DataTables::of($banks)
                ->addColumn('edit', 'admin/bank/actions')
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.bank.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankRequest $request)
    {
        $bank = new Bank;
        $bank->name = $request->name;
        $bank->save();

        return redirect('bank');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        return view("admin.bank.show", compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view("admin.bank.edit", compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankRequest  $request
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankRequest $request, Bank $bank)
    {
        $bank->name = $request->name;
        $bank->save();
        Alert::success('Banco','Editado Satisfactoriamente.');
        return redirect('bank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->delete();
        toast('Banco eliminado con éxito.','success');
        return redirect("bank");
    }
}
