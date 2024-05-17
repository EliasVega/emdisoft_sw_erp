<?php

namespace App\Http\Controllers;

use App\Models\AuxiliaryAccount;
use App\Http\Requests\StoreAuxiliaryAccountRequest;
use App\Http\Requests\UpdateAuxiliaryAccountRequest;
use App\Models\Subaccount;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AuxiliaryAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $auxiliaryAccounts = AuxiliaryAccount::get();

            return DataTables::of($auxiliaryAccounts)
            ->addIndexColumn()
            ->addColumn('subaccount', function (AuxiliaryAccount $auxiliaryAccount) {
                return $auxiliaryAccount->subaccount->name;
            })
            ->addColumn('edit', 'admin/auxiliaryAccount/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.auxiliaryAccount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subaccounts = Subaccount::get();
        return view("admin.auxiliaryAccount.create", compact('subaccounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAuxiliaryAccountRequest $request)
    {
        $auxiliaryAccount = new AuxiliaryAccount();
        $auxiliaryAccount->code = $request->code;
        $auxiliaryAccount->name = $request->name;
        $auxiliaryAccount->total_amount = 0;
        $auxiliaryAccount->status = 'inactive';
        $auxiliaryAccount->subaccount_id = $request->subaccount_id;
        $auxiliaryAccount->save();

        return redirect('auxiliaryAccount');
    }

    /**
     * Display the specified resource.
     */
    public function show(AuxiliaryAccount $auxiliaryAccount)
    {
        $subaccount = Subaccount::get();
        return view("admin.auxiliaryAccount.show", compact('auxiliaryAccount', 'subaccount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AuxiliaryAccount $auxiliaryAccount)
    {
        $subaccounts = Subaccount::get();
        return view("admin.auxiliaryAccount.edit", compact('auxiliaryAccount', 'subaccounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAuxiliaryAccountRequest $request, AuxiliaryAccount $auxiliaryAccount)
    {
        $auxiliaryAccount->code = $request->code;
        $auxiliaryAccount->name = $request->name;
        $auxiliaryAccount->total_amount = 0;
        $auxiliaryAccount->status = 'inactive';
        $auxiliaryAccount->subaccount_id = $request->subaccount_id;
        $auxiliaryAccount->update();

        return redirect('auxiliaryAccount');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AuxiliaryAccount $auxiliaryAccount)
    {
        $auxiliaryAccount->delete();
        Alert::success('Cuenta Auxiliar','eliminada con éxito.');
        return redirect("auxiliaryAccount");
    }
}
