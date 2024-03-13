<?php

namespace App\Http\Controllers;

use App\Models\EmployeeInvoiceProduct;
use App\Http\Requests\StoreEmployeeInvoiceProductRequest;
use App\Http\Requests\UpdateEmployeeInvoiceProductRequest;
use App\Models\Employee;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class EmployeeInvoiceProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . ' 00:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDate . ' 23:59:59');

                $employeeInvoiceProducts = EmployeeInvoiceProduct::whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            } else {
                $employeeInvoiceProducts = EmployeeInvoiceProduct::get();
            }

            return DataTables::of($employeeInvoiceProducts)
            ->addIndexColumn()
            ->addColumn('observations', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->invoiceProduct->invoice->note;
            })
            ->addColumn('document', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->invoiceProduct->invoice->document;
            })
            ->addColumn('employee', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->name;
            })
            ->addColumn('identification', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->identification;
            })
            ->addColumn('product', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->invoiceProduct->product->name;
            })
            ->addColumn('type', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                if ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'product') {
                    return $employeeInvoiceProduct->invoiceProduct->product->type_product == 'product' ? 'Producto' : 'Producto';
                } elseif ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'service') {
                    return $employeeInvoiceProduct->status == 'service' ? 'Servicio' : 'Servicio';
                } elseif ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'consumer') {
                    return $employeeInvoiceProduct->status == 'consumer' ? 'Consumo' : 'Consumo';
                }
            })
            ->addColumn('percentage', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->commission;
            })
            ->editColumn('generation_date', function(EmployeeInvoiceProduct $employeeInvoiceProduct){
                return $employeeInvoiceProduct->invoiceProduct->invoice->generation_date;
            })
            ->addColumn('status', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                if ($employeeInvoiceProduct->status == 'pendient') {
                    return $employeeInvoiceProduct->status == 'pendient' ? 'Pendiente' : 'Pendiente';
                } elseif ($employeeInvoiceProduct->status == 'canceled') {
                    return $employeeInvoiceProduct->status == 'canceled' ? 'Cancelado' : 'Cancelado';
                }
            })

            ->addColumn('btn', 'admin/employeeInvoiceProduct/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }
        return view('admin.employeeInvoiceProduct.index');
    }

    public function indexPendient(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . ' 00:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDate . ' 23:59:59');

                $employeeInvoiceProducts = EmployeeInvoiceProduct::where('status', 'pendient')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            } else {
                $employeeInvoiceProducts = EmployeeInvoiceProduct::where('status', 'pendient')->get();
            }

            return DataTables::of($employeeInvoiceProducts)
            ->addIndexColumn()
            ->addColumn('observations', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->invoiceProduct->invoice->note;
            })
            ->addColumn('document', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->invoiceProduct->invoice->document;
            })
            ->addColumn('employee', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->name;
            })
            ->addColumn('identification', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->identification;
            })
            ->addColumn('product', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->name;
            })
            ->addColumn('type', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                if ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'product') {
                    return $employeeInvoiceProduct->invoiceProduct->product->type_product == 'product' ? 'Producto' : 'Producto';
                } elseif ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'service') {
                    return $employeeInvoiceProduct->status == 'service' ? 'Servicio' : 'Servicio';
                } elseif ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'consumer') {
                    return $employeeInvoiceProduct->status == 'consumer' ? 'Consumo' : 'Consumo';
                }
            })
            ->addColumn('percentage', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->commission;
            })
            ->editColumn('generation_date', function(EmployeeInvoiceProduct $employeeInvoiceProduct){
                return $employeeInvoiceProduct->invoiceProduct->invoice->generation_date;
            })
            ->editColumn('created_at', function(EmployeeInvoiceProduct $employeeInvoiceProduct){
                return $employeeInvoiceProduct->created_at->format('yy-m-d');
            })
            ->addColumn('status', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                if ($employeeInvoiceProduct->status == 'pendient') {
                    return $employeeInvoiceProduct->status == 'pendient' ? 'Pendiente' : 'Pendiente';
                } elseif ($employeeInvoiceProduct->status == 'canceled') {
                    return $employeeInvoiceProduct->status == 'canceled' ? 'Cancelado' : 'Cancelado';
                }
            })
            ->make(true);
        }
        return view('admin.employeeInvoiceProduct.indexPendient');
    }

    public function indexCanceled(Request $request)
    {
        if ($request->ajax()) {
            $startDate = $request->get('start_date');
            $endDate = $request->get('end_date');
            if ($startDate && $endDate) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $startDate . ' 00:00:00');
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i:s', $endDate . ' 23:59:59');

                $employeeInvoiceProducts = EmployeeInvoiceProduct::where('status', 'canceled')->whereBetween('created_at', [$startDateTime, $endDateTime])->get();
            } else {
                $employeeInvoiceProducts = EmployeeInvoiceProduct::where('status', 'canceled')->get();
            }

            return DataTables::of($employeeInvoiceProducts)
            ->addIndexColumn()
            ->addColumn('observations', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->invoiceProduct->invoice->note;
            })
            ->addColumn('document', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->invoiceProduct->invoice->document;
            })
            ->addColumn('employee', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->name;
            })
            ->addColumn('identification', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->identification;
            })
            ->addColumn('product', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->invoiceProduct->product->name;
            })
            ->addColumn('type', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                if ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'product') {
                    return $employeeInvoiceProduct->invoiceProduct->product->type_product == 'product' ? 'Producto' : 'Producto';
                } elseif ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'service') {
                    return $employeeInvoiceProduct->status == 'service' ? 'Servicio' : 'Servicio';
                } elseif ($employeeInvoiceProduct->invoiceProduct->product->type_product == 'consumer') {
                    return $employeeInvoiceProduct->status == 'consumer' ? 'Consumo' : 'Consumo';
                }
            })
            ->addColumn('percentage', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                return $employeeInvoiceProduct->employee->commission;
            })
            ->editColumn('generation_date', function(EmployeeInvoiceProduct $employeeInvoiceProduct){
                return $employeeInvoiceProduct->invoiceProduct->invoice->generation_date;
            })
            ->editColumn('created_at', function(EmployeeInvoiceProduct $employeeInvoiceProduct){
                return $employeeInvoiceProduct->created_at->format('yy-m-d');
            })
            ->addColumn('status', function (EmployeeInvoiceProduct $employeeInvoiceProduct) {
                if ($employeeInvoiceProduct->status == 'pendient') {
                    return $employeeInvoiceProduct->status == 'pendient' ? 'Pendiente' : 'Pendiente';
                } elseif ($employeeInvoiceProduct->status == 'canceled') {
                    return $employeeInvoiceProduct->status == 'canceled' ? 'Cancelado' : 'Cancelado';
                }
            })
            ->make(true);
        }
        return view('admin.employeeInvoiceProduct.indexCanceled');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeInvoiceProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeInvoiceProduct $employeeInvoiceProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeInvoiceProduct $employeeInvoiceProduct)
    {
        //dd($employeeInvoiceProduct);
        $id = $employeeInvoiceProduct->invoiceProduct->invoice_id;
        $invoice = Invoice::findOrFail($id);
        $employees = Employee::get();
        return view('admin.employeeInvoiceProduct.edit', compact(
            'employeeInvoiceProduct',
            'invoice',
            'employees'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeInvoiceProductRequest $request, EmployeeInvoiceProduct $employeeInvoiceProduct)
    {
        $empled = $request->employee_id;
        $emp = explode("_", $empled);
        $employee = Employee::where('id', $emp)->first();
        //dd($request->all());
        $employeeInvoiceProduct->commission = $request->commission;
        $employeeInvoiceProduct->value_commission = $request->value_commission;
        $employeeInvoiceProduct->employee_id = $employee;
        $employeeInvoiceProduct->update();

        Alert::success('Pago Empleado','Realizado con exito.');
        return redirect("employee");
    }

    public function updateEmployee(UpdateEmployeeInvoiceProductRequest $request, EmployeeInvoiceProduct $employeeInvoiceProduct)
    {
        //dd($request->all());
        $id = $request->id;
        $employeeInvoiceProduct = EmployeeInvoiceProduct::findOrFail($id);
        $employeeInvoiceProduct->status = 'canceled';
        $employeeInvoiceProduct->update();

        Alert::success('Pago Empleado','Realizado con exito.');
        return redirect("employee");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeInvoiceProduct $employeeInvoiceProduct)
    {
        //
    }
}
