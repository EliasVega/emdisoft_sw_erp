<?php

namespace App\Http\Controllers;

use App\Models\Kardex;
use App\Http\Requests\StoreKardexRequest;
use App\Http\Requests\UpdateKardexRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class KardexController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:kardex.index', ['only'=>['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . ' 00:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDate . ' 23:59:59');

                $kardexes = Kardex::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            } else {
                $kardexes = Kardex::get();
            }
            return DataTables::of($kardexes)
            ->addIndexColumn()
            ->addColumn('branch', function (Kardex $kardex) {
                return $kardex->branch->name;
            })
            ->addColumn('operation', function (Kardex $kardex) {
                if ($kardex->movement == 'purchase') {
                    return $kardex->movement == 'purchase' ? 'Compra' : 'Compra';
                } elseif ($kardex->movement == 'expense') {
                    return $kardex->movement == 'expense' ? 'Gasto' : 'Gasto';
                }elseif ($kardex->movement == 'ndpurchase') {
                    return $kardex->movement == 'ndpurchase' ? 'ND compra' : 'ND compra';
                } elseif ($kardex->movement == 'ncpurchase'){
                    return $kardex->movement == 'ncpurchase' ? 'Nc compra' : 'Nc compra';
                } elseif ($kardex->movement == 'invoice') {
                    return $kardex->movement == 'invoice' ? 'Venta' : 'Venta';
                }elseif ($kardex->movement == 'ndinvoice') {
                    return $kardex->movement == 'ndinvoice' ? 'ND venta' : 'ND venta';
                } elseif ($kardex->movement == 'ncinvoice'){
                    return $kardex->movement == 'ncinvoice' ? 'Nc venta' : 'Nc venta';
                }
            })

            ->addColumn('product_id', function (Kardex $kardex) {
                return $kardex->kardexable->id;
            })
            ->addColumn('product', function (Kardex $kardex) {
                return $kardex->kardexable->name;
            })
            ->editColumn('created_at', function(Kardex $kardex){
                return $kardex->created_at->format('Y-m-d');
            })
            ->addColumn('edit', 'admin/kardex/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        }
        return view('admin.kardex.index');
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
     * @param  \App\Http\Requests\StoreKardexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKardexRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function show(Kardex $kardex)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function edit(Kardex $kardex)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKardexRequest  $request
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKardexRequest $request, Kardex $kardex)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kardex $kardex)
    {
        //
    }

    public function kardexRawMaterial(Request $request, $id)
    {
        //if ($request->ajax()) {
            if (!empty($request->end)) {
                $kardexes = Kardex::where('kardexable_id', $id)->whereBetween('created_at', [$request->start, $request->end])->get();
            } else {
                $kardexes = Kardex::where('kardexable_id', $id)->get();
            }
            return DataTables::of($kardexes)
            ->addIndexColumn()
            ->addColumn('branch', function (Kardex $kardex) {
                return $kardex->branch->name;
            })
            ->addColumn('operation', function (Kardex $kardex) {
                if ($kardex->movement == 'purchase') {
                    return $kardex->movement == 'purchase' ? 'Compra' : 'Compra';
                } elseif ($kardex->movement == 'expense') {
                    return $kardex->movement == 'expense' ? 'Gasto' : 'Gasto';
                }elseif ($kardex->movement == 'ndpurchase') {
                    return $kardex->movement == 'ndpurchase' ? 'ND compra' : 'ND compra';
                } elseif ($kardex->movement == 'ncpurchase'){
                    return $kardex->movement == 'ncpurchase' ? 'Nc compra' : 'Nc compra';
                } elseif ($kardex->movement == 'invoice') {
                    return $kardex->movement == 'invoice' ? 'Venta' : 'Venta';
                }elseif ($kardex->movement == 'ndinvoice') {
                    return $kardex->movement == 'ndinvoice' ? 'ND venta' : 'ND venta';
                } elseif ($kardex->movement == 'ncinvoice'){
                    return $kardex->movement == 'ncinvoice' ? 'Nc venta' : 'Nc venta';
                }
            })

            ->addColumn('product_id', function (Kardex $kardex) {
                return $kardex->kardexable->id;
            })
            ->addColumn('product', function (Kardex $kardex) {
                return $kardex->kardexable->name;
            })
            ->editColumn('created_at', function(Kardex $kardex){
                return $kardex->created_at->format('yy-m-d');
            })
            ->addColumn('edit', 'admin/kardex/actions')
            ->rawcolumns(['edit'])
            ->toJson();
        //}

        return view('admin.rawMaterial.kardexRawMaterial');
    }
}
