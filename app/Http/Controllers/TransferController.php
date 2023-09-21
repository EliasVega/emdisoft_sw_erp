<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Http\Requests\StoreTransferRequest;
use App\Http\Requests\UpdateTransferRequest;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\ProductBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class TransferController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:transfer.index|transfer.create|transfer.show', ['only'=>['index']]);
        $this->middleware('permission:transfer.create', ['only'=>['create','store']]);
        $this->middleware('permission:transfer.show', ['only'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Muestra todas las compras de la empresa
                $transfers = Transfer::get();
            } else {
                //Muestra todas las compras de la empresa por usuario
                $transfers = Transfer::where('user_id', $users->id)->get();
            }
            return DataTables::of($transfers)
            ->addIndexColumn()
            ->addColumn('user', function (Transfer $transfer) {
                return $transfer->user->name;
            })
            ->addColumn('branch', function (Transfer $transfer) {
                return $transfer->branch->name;
            })
            ->addColumn('originBranch', function (Transfer $transfer) {
                return $transfer->originBranch->name;
            })

            ->editColumn('created_at', function(Transfer $transfer){
                return $transfer->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/transfer/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }
        return view('admin.transfer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = Auth::user();

        $branch = Branch::findOrFail($request->session()->get('branch'))->first();
        $branches = Branch::select('id', 'name')->where('id', '!=', $user->branch_id)->get();
        $branchProducts = BranchProduct::where('branch_id', $branch->id)->where('stock', '>', 0)->get();

        return view("admin.transfer.create", compact('branches', 'branchProducts', 'branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransferRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransferRequest $request)
    {
        try{
            DB::beginTransaction();
            //Obteniendo variables
            $user = Auth::user()->id;
            $br = Auth::user()->branch_id;

            $branch = Branch::select('id')->where('id', $br)->first();
            $branch_id = $request->branch_id[0];
            $product_id = $request->idP;
            $quantity = $request->quantity;
            $cont = 0;
            //metodo para registro de traslado de productos
            $transfer = new Transfer();
            $transfer->user_id = $user;
            $transfer->branch_id = $request->branch_id[0];
            $transfer->origin_branch_id = $branch->id;
            $transfer->save();

            //metodo de control
            while($cont < count($product_id)){
                //Methodo para asignar productos a la sucursal
                $productBranch = new ProductBranch();
                $productBranch->user_id = $user;
                $productBranch->branch_id = $branch_id;
                $productBranch->transfer_id = $transfer->id;
                $productBranch->product_id = $product_id[$cont];
                $productBranch->quantity = $quantity[$cont];
                $productBranch->origin_branch_id = $branch->id;
                $productBranch->save();

                //Metodo para registrar producto en determinada sucursal
                $branchProducts = BranchProduct::where('product_id', '=', $productBranch->product_id)
                ->where('branch_id', '=', $productBranch->branch_id)
                ->first();

                if (isset($branchProducts)) {
                    //methodo para actualizar el stock de la sucursal si existe el producto
                    $id = $branchProducts->id;
                    $branchProduct = BranchProduct::findOrFail($id);
                    $branchProduct->stock += $quantity[$cont];
                    $branchProduct->update();
                } else {
                    //metodo para crear el producto en la sucursal y asignar stock
                    $branchProduct = new BranchProduct();
                    $branchProduct->branch_id = $productBranch->branch_id;
                    $branchProduct->product_id = $productBranch->product_id;
                    $branchProduct->stock = $quantity[$cont];
                    $branchProduct->order_product = 0;
                    $branchProduct->save();
                }

                //Metodo para descontar los productos que salieron de determinada sucursal
                $branchPro = BranchProduct::where('product_id', '=', $productBranch->product_id)
                ->where('branch_id', '=', $productBranch->origin_branch_id)
                ->first();

                $ids = $branchPro->id;
                $stock = $branchPro->stock - $productBranch->quantity;

                $branchProduct = BranchProduct::findOrFail($ids);
                $branchProduct->stock -= $quantity[$cont];
                $branchProduct->update();

                $cont++;
            }
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
        }
        Alert::success('Traslado','Realizado Satisfactoriamente.');
        return redirect('transfer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function show(Transfer $transfer)
    {

            $productBranches = ProductBranch::where('transfer_id', $transfer->id)->get();

            return view('admin.transfer.show', compact('productBranches', 'transfer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function edit(Transfer $transfer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransferRequest  $request
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransferRequest $request, Transfer $transfer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transfer  $transfer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transfer $transfer)
    {
        //
    }
}
