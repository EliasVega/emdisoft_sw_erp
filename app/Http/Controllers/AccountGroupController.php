<?php

namespace App\Http\Controllers;

use App\Models\AccountGroup;
use App\Http\Requests\StoreAccountGroupRequest;
use App\Http\Requests\UpdateAccountGroupRequest;
use App\Models\AccountClass;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AccountGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accountGroups = AccountGroup::get();

            return DataTables::of($accountGroups)
            ->addIndexColumn()
            ->addColumn('accountClass', function (AccountGroup $accountGroup) {
                return $accountGroup->accountClass->name;
            })
            ->addColumn('edit', 'admin/accountGroup/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.accountGroup.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accountClasses = AccountClass::get();
        return view('admin.accountGroup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountGroupRequest $request)
    {
        $accountGroup = new AccountGroup();
        $accountGroup->code = $request->code;
        $accountGroup->name = $request->name;
        $accountGroup->total_amount = 0;
        $accountGroup->account_class_id = $request->account_class_id;
        $accountGroup->save();

        return redirect('accountGroup');
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountGroup $accountGroup)
    {
        return view("admin.accountGroup.show", compact('accountGroup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountGroup $accountGroup)
    {
        $accountClasses = AccountClass::get();
        return view("admin.accountGroup.edit", compact('accountGroup', 'accountClasses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountGroupRequest $request, AccountGroup $accountGroup)
    {
        $accountGroup->code = $request->code;
        $accountGroup->name = $request->name;
        $accountGroup->total_amount = 0;
        $accountGroup->account_class_id = $request->account_class_id;
        $accountGroup->update();

        return redirect('accountGroup');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountGroup $accountGroup)
    {
        $accountGroup->delete();
        Alert::success('Grupo de cuenta','eliminada con éxito.');
        return redirect("accountGroup");
    }
}
