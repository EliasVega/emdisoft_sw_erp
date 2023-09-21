<?php

namespace App\Http\Controllers;

use App\Models\Retention;
use App\Http\Requests\StoreRetentionRequest;
use App\Http\Requests\UpdateRetentionRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RetentionController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:retention.index|percentage.create|percentage.show|percentage.edit|percentage.destroy', ['only'=>['index']]);
        $this->middleware('permission:retention.create', ['only'=>['create','store']]);
        $this->middleware('permission:retention.show', ['only'=>['show']]);
        $this->middleware('permission:retention.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:retention.destroy', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $retentions = Retention::get();

            return DataTables::of($retentions)
            ->addColumn('edit', 'admin/retention/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.retention.index');
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
     * @param  \App\Http\Requests\StoreRetentionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRetentionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Retention  $retention
     * @return \Illuminate\Http\Response
     */
    public function show(Retention $retention)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Retention  $retention
     * @return \Illuminate\Http\Response
     */
    public function edit(Retention $retention)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRetentionRequest  $request
     * @param  \App\Models\Retention  $retention
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRetentionRequest $request, Retention $retention)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Retention  $retention
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retention $retention)
    {
        //
    }
}
