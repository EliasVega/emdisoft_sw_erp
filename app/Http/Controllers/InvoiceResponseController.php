<?php

namespace App\Http\Controllers;

use App\Models\InvoiceResponse;
use App\Http\Requests\StoreInvoiceResponseRequest;
use App\Http\Requests\UpdateInvoiceResponseRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InvoiceResponseController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:invoiceResponse.index|invoiceResponse.create|invoiceResponse.show|invoiceResponse.edit', ['only'=>['index']]);
        $this->middleware('permission:invoiceResponse.create', ['only'=>['create','store']]);
        $this->middleware('permission:invoiceResponse.show', ['only'=>['show']]);
        $this->middleware('permission:invoiceResponse.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $responses = InvoiceResponse::get();

            return DataTables::of($responses)
            ->addIndexColumn()
                ->addColumn('customer', function (InvoiceResponse $response) {
                    return $response->invoice->third->name;
                })
                ->editColumn('created_at', function(InvoiceResponse $response) {
                    return $response->created_at->format('yy-m-d');
                })

            ->addColumn('edit', 'admin/invoiceResponse/actions')
            ->rawcolumns(['edit'])
            ->make(true);
        }
        return view('admin.invoiceResponse.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.invoiceResponse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceResponseRequest $request)
    {
        $invoiceResponse = new InvoiceResponse();
        $invoiceResponse->document = $request->document;
        $invoiceResponse->cufe = $request->cufe;
        $invoiceResponse->message = $request->message;
        $invoiceResponse->valid = $request->valid;
        $invoiceResponse->code = $request->code;
        $invoiceResponse->description = $request->description;
        $invoiceResponse->status_message = $request->status_message;
        $invoiceResponse->invoice_id = $request->invoice_id;
        $invoiceResponse->save();

        return redirect('invoiceResponse');
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceResponse $invoiceResponse)
    {
        return view('admin.invoiceResponse.chow', compact('invoiceResponse'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceResponse $invoiceResponse)
    {
        return view('admin.invoiceResponse.edit', compact('invoiceResponse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceResponseRequest $request, InvoiceResponse $invoiceResponse)
    {
        $invoiceResponse->document = $request->document;
        $invoiceResponse->cufe = $request->cufe;
        $invoiceResponse->message = $request->message;
        $invoiceResponse->valid = $request->valid;
        $invoiceResponse->code = $request->code;
        $invoiceResponse->description = $request->description;
        $invoiceResponse->status_message = $request->status_message;
        $invoiceResponse->invoice_id = $request->invoice_id;
        $invoiceResponse->update();

        toast('Response Factura de venta Editada satisfactoriamente.','success');
        return redirect('invoiceResponse');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceResponse $invoiceResponse)
    {
        //
    }
}
