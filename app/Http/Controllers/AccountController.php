<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Models\AccountGroup;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accounts = Account::get();

            return DataTables::of($accounts)
            ->addIndexColumn()
            ->addColumn('accountGroup', function (Account $account) {
                return $account->accountGroup->name;
            })
            ->addColumn('edit', 'admin/account/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.account.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accountGroups = AccountGroup::get();
        return view('admin.account.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $account = new Account();
        $account->code = $request->code;
        $account->name = $request->name;
        $account->total_amount = 0;
        $account->account_group_id = $request->account_group_id;
        $account->save();

        return redirect('account');
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return view("admin.account.show", compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Account $account)
    {
        $accountGroups = AccountGroup::get();
        return view("admin.account.edit", compact('account', 'accountGroups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $account->code = $request->code;
        $account->name = $request->name;
        $account->total_amount = 0;
        $account->account_group_id = $request->account_group_id;
        $account->update();

        return redirect('account');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        Alert::success('Cuenta','eliminada con éxito.');
        return redirect("account");
    }
}
