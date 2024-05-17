<?php

namespace App\Http\Controllers;

use App\Models\SubauxiliaryAccount;
use App\Http\Requests\StoreSubauxiliaryAccountRequest;
use App\Http\Requests\UpdateSubauxiliaryAccountRequest;
use App\Models\AuxiliaryAccount;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class SubauxiliaryAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subauxiliaryAccounts = SubauxiliaryAccount::get();

            return DataTables::of($subauxiliaryAccounts)
            ->addIndexColumn()
            ->addColumn('subauxiliaryAccount', function (SubauxiliaryAccount $subauxiliaryAccount) {
                return $subauxiliaryAccount->subaccount->name;
            })
            ->addColumn('edit', 'admin/subauxiliaryAccount/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.subauxiliaryAccount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $auxiliaryAccounts = AuxiliaryAccount::get();
        return view("admin.subauxiliaryAccount.create", compact('auxiliaryAccounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubauxiliaryAccountRequest $request)
    {
        $subauxiliaryAccount = new SubauxiliaryAccount();
        $subauxiliaryAccount->code = $request->code;
        $subauxiliaryAccount->name = $request->name;
        $subauxiliaryAccount->total_amount = 0;
        $subauxiliaryAccount->status = 'active';
        $subauxiliaryAccount->subauxiliary_account_id = $request->subauxiliary_account_id;
        $subauxiliaryAccount->save();

        return redirect('subauxiliaryAccount');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubauxiliaryAccount $subauxiliaryAccount)
    {
        $auxiliaryAccounts = AuxiliaryAccount::get();
        return view("admin.subauxiliaryAccount.show", compact('subauxiliaryAccounts', 'auxiliaryAccounts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubauxiliaryAccount $subauxiliaryAccount)
    {
        $auxiliaryAccounts = AuxiliaryAccount::get();
        return view("admin.subauxiliaryAccount.edit", compact('subauxiliaryAccounts', 'auxiliaryAccounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubauxiliaryAccountRequest $request, SubauxiliaryAccount $subauxiliaryAccount)
    {
        $subauxiliaryAccount->code = $request->code;
        $subauxiliaryAccount->name = $request->name;
        $subauxiliaryAccount->total_amount = 0;
        $subauxiliaryAccount->status = 'active';
        $subauxiliaryAccount->subauxiliary_account_id = $request->subauxiliary_account_id;
        $subauxiliaryAccount->update();

        return redirect('subauxiliaryAccount');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubauxiliaryAccount $subauxiliaryAccount)
    {
        $subauxiliaryAccount->delete();
        Alert::success('Cuenta Sub Auxiliar','eliminada con éxito.');
        return redirect("subauxiliaryAccount");
    }
}
