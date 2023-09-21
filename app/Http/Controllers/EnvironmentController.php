<?php

namespace App\Http\Controllers;

use App\Models\Environment;
use App\Http\Requests\StoreEnvironmentRequest;
use App\Http\Requests\UpdateEnvironmentRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:environment.index|environment.create|environment.show|environment.edit|environment.destroy', ['only'=>['index']]);
        $this->middleware('permission:environment.create', ['only'=>['create','store']]);
        $this->middleware('permission:environment.show', ['only'=>['show']]);
        $this->middleware('permission:environment.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:environment.destroy', ['only'=>['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $environmentss = Environment::get();

            return DataTables::of($environmentss)
                ->addColumn('edit', 'admin/environment/actions')
                ->rawColumns(['edit'])
                ->make(true);
        }

        return view('admin.environment.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.environment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnvironmentRequest $request)
    {
        $environment = new Environment();
        $environment->code = $request->code;
        $environment->name = $request->name;
        $environment->url = $request->url;
        $environment->save();

        Alert::success('Environment','Creado Satisfactoriamente.');
        return redirect('environment');
    }

    /**
     * Display the specified resource.
     */
    public function show(Environment $environment)
    {
        return view("admin.environment.show", compact('environment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Environment $environment)
    {
        return view("admin.environment.edit", compact('environment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnvironmentRequest $request, Environment $environment)
    {
        $environment->code = $request->code;
        $environment->name = $request->name;
        $environment->url = $request->url;
        $environment->update();

        Alert::success('Environment','Creado Satisfactoriamente.');
        return redirect('environment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Environment $environment)
    {
        $environment->delete();
        toast('Environment eliminado con éxito.','success');
        return redirect("environment");
    }
}
