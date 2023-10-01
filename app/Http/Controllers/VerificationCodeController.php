<?php

namespace App\Http\Controllers;

use App\Models\VerificationCode;
use App\Http\Requests\StoreVerificationCodeRequest;
use App\Http\Requests\UpdateVerificationCodeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class VerificationCodeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:verificationCode.index|verificationCode.create|verificationCode.show|verificationCode.edit|verificationCode.destroy', ['only'=>['index']]);
        $this->middleware('permission:verificationCode.create', ['only'=>['create','store']]);
        $this->middleware('permission:verificationCode.show', ['only'=>['show']]);
        $this->middleware('permission:verificationCode.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:verificationCode.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $verificationCodes = VerificationCode::whereRelation('user', 'status', 'active')->get();

            return DataTables::of($verificationCodes)
            ->addIndexColumn()

            ->addColumn('user', function (VerificationCode $verificationCode) {
                return $verificationCode->user->name;
            })
            ->addColumn('btn', 'admin/verificationCode/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }

        return view('admin.verificationCode.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('id', '!=', 1)->get();
        return view('admin.verificationCode.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVerificationCodeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVerificationCodeRequest $request)
    {
        $verificationCodes = VerificationCode::get();
        $id = $request->user_id;
        $cont = 0;
        foreach ($verificationCodes as $key) {
            if($key->user_id == $id)
            $cont ++;
        }
        if ($cont > 0) {
            return redirect('verificationCode')->with('warning', 'Este Usuario Ya tiene Asignado un Codigo');
        } else {
            $verificationCode = new verificationCode();
            $verificationCode->user_id = $request->user_id;
            $verificationCode->code = $request->code;
            $verificationCode->save();
        }
        Alert::success('Codigo','Autorizacion creada Satisfactoriamente.');
        return redirect('verificationCode');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function show(VerificationCode $verificationCode)
    {
        return view('admin.verificationCode.show', compact('verificationCode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function edit(VerificationCode $verificationCode)
    {
        $user = User::where('id', '=', $verificationCode->user_id)->first();
        $users = User::where('status', 'active')->get();
        return view('admin.verificationCode.edit', compact('verificationCode', 'user', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVerificationCodeRequest  $request
     * @param  \App\Models\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVerificationCodeRequest $request, VerificationCode $verificationCode)
    {
        $verificationCode->user_id = $request->user_id;
        $verificationCode->code = $request->code;
        $verificationCode->update();

        Alert::success('Autorizacion','Editada con exito.');
        return redirect('verificationCode');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificationCode $verificationCode)
    {
        $verificationCode->delete();
        toast('Autorizacion Eliminado con Exito.','success');
        return redirect('verificationCode');
    }
}
