<?php

namespace App\Http\Controllers;

use App\Models\Subaccount;
use App\Http\Requests\StoreSubaccountRequest;
use App\Http\Requests\UpdateSubaccountRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class SubaccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subaccounts = Subaccount::get();

            return DataTables::of($subaccounts)
            ->addIndexColumn()
            ->addColumn('account', function (Subaccount $subaccount) {
                return $subaccount->account->name;
            })
            ->addColumn('edit', 'admin/subaccount/actions')
            ->addColumn('status', 'admin/subaccount/status')
            ->rawColumns(['edit', 'status'])
            ->make(true);
        }

        return view('admin.subaccount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.subAccount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubaccountRequest $request)
    {
        $subaccount = new Subaccount();
        $subaccount->code = $request->code;
        $subaccount->name = $request->name;
        $subaccount->total_amount = 0;
        $subaccount->status = 'inactive';
        $subaccount->account_id = $request->account_id;
        $subaccount->save();

        return redirect('subaccount');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subaccount $subaccount)
    {
        return view("admin.subaccount.show", compact('subaccount'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subaccount $subaccount)
    {
        $accounts = Account::get();
        return view("admin.subaccount.edit", compact('subaccount', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubaccountRequest $request, Subaccount $subaccount)
    {
        $subaccount->code = $request->code;
        $subaccount->name = $request->name;
        $subaccount->total_amount = 0;
        $subaccount->account_id = $request->account_id;
        $subaccount->update();

        return redirect('subaccount');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subaccount $subaccount)
    {
        $subaccount->delete();
        Alert::success('Subcuenta','eliminada con éxito.');
        return redirect("subcuenta");
    }
}
