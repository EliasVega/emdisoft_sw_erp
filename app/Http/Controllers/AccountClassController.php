<?php

namespace App\Http\Controllers;

use App\Models\AccountClass;
use App\Http\Requests\StoreAccountClassRequest;
use App\Http\Requests\UpdateAccountClassRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Termwind\Components\Dd;
use Yajra\DataTables\DataTables;

class AccountClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $accountClass = AccountClass::get();

            return DataTables::of($accountClass)
                ->addColumn('edit', 'admin/accountClass/actions')
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.accountClass.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accountClass.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountClassRequest $request)
    {
        $accountClass = new AccountClass();
        $accountClass->code = $request->code;
        $accountClass->name = $request->name;
        $accountClass->total_amount = 0;
        $accountClass->save();

        return redirect('accountClass');
    }

    /**
     * Display the specified resource.
     */
    public function show(AccountClass $accountClass)
    {
        return view("admin.accountClass.show", compact('accountClass'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AccountClass $accountClass)
    {
        return view("admin.accountClass.edit", compact('accountClass'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountClassRequest $request, AccountClass $accountClass)
    {
        $accountClass->code = $request->code;
        $accountClass->name = $request->name;
        $accountClass->total_amount = 0;
        $accountClass->update();

        return redirect('accountClass');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AccountClass $accountClass)
    {
        $accountClass->delete();
        Alert::success('Clase de cuenta','eliminada con éxito.');
        return redirect("accountClass");

    }
}
