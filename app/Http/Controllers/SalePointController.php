<?php

namespace App\Http\Controllers;

use App\Models\SalePoint;
use App\Http\Requests\StoreSalePointRequest;
use App\Http\Requests\UpdateSalePointRequest;
use App\Models\Branch;
use App\Models\CashRegister;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SalePointController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $salePoints = SalePoint::get();

            return DataTables::of($salePoints)
            ->addIndexColumn()
            ->addColumn('branch', function (SalePoint $salePoint) {
                return $salePoint->branch->name;
            })

            ->addColumn('edit', 'admin/salePoint/actions')
            ->rawColumns(['edit'])
            ->make(true);
        }

        return view('admin.salePoint.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branchs = Branch::get();
        return view('admin.salePoint.create', compact('branchs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSalePointRequest $request)
    {
        $salePoint = new SalePoint();
        $salePoint->branch_id = $request->branch_id;
        $salePoint->plate_number = $request->plate_number;
        $salePoint->location = $request->location;
        $salePoint->cash_type = $request->cash_type;
        $salePoint->save();
        return redirect("salePoint");
    }

    /**
     * Display the specified resource.
     */
    public function show(SalePoint $salePoint)
    {
        $branchs = Branch::get();
        return view('admin.salePoint.show', compact('salePoint', 'branchs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalePoint $salePoint)
    {
        $branchs = Branch::get();
        return view('admin.salePoint.edit', compact('salePoint', 'branchs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalePointRequest $request, SalePoint $salePoint)
    {
        $salePoint->branch_id = $request->branch_id;
        $salePoint->plate_number = $request->plate_number;
        $salePoint->location = $request->location;
        $salePoint->cash_type = $request->cash_type;
        $salePoint->save();
        return redirect("salePoint");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalePoint $salePoint)
    {
        $cashRegister = CashRegister::where('sale_point_id', $salePoint->id)->get();
        $countCR = count($cashRegister);
        if ($countCR > 0) {
            toast('No es posible eliminar este punto de venta contiene movimientos.','success');
        } else {
            $salePoint->delete();
        toast('Punto de venta Eliminado con Exito.','success');
        }
        return redirect("salePoint");
    }
}
