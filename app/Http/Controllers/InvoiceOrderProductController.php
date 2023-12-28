<?php

namespace App\Http\Controllers;

use App\Models\InvoiceOrderProduct;
use App\Http\Requests\StoreInvoiceOrderProductRequest;
use App\Http\Requests\UpdateInvoiceOrderProductRequest;
use App\Models\BranchProduct;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Environment;
use App\Models\Indicator;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\InvoiceResponse;
use App\Models\Product;
use App\Models\Resolution;
use App\Models\VoucherType;
use App\Traits\InventoryInvoices;
use App\Traits\KardexCreate;
use App\Traits\Taxes;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceOrderProductController extends Controller
{
    use InventoryInvoices, KardexCreate, Taxes;
    function __construct()
    {
        $this->middleware('permission:invoiceOrderProduct.store', ['only'=>['store']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreInvoiceOrderProductRequest $request)
    {
        //dd($request->all());
        $company = Company::findOrFail(current_user()->company_id);
        $environment = Environment::where('id', 11)->first();
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $resolutions = '';
        $resolut = $request->resolution_id;
        if ($resolut == null) {
            if ($indicator->dian == 'on') {
                $resolutions = Resolution::findOrFail(4);
            } else {
                $resolutions = Resolution::findOrFail(7);
            }
        } else {
            $resolutions = Resolution::findOrFail($request->resolution_id);
        }

        $typeDocument = 'invoice';
        $documentType = '';

        if ($indicator->pos == 'on' && $request->fe == 2) {
            $voucherType = 2;
            $documentType = 12;
        } else {
            $voucherType = 1;
            $documentType = 1;
        }

        $voucherTypes = VoucherType::findOrFail($voucherType);
        //Variables del request
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $branch = current_user()->branch_id;
        $total_pay = $request->total_pay;
        $paymentForm = $request->payment_form_id;

        if ($indicator->pos == 'on'  && $paymentForm == 1) {
            $totalpay = $request->total_pay;
        } else {
            $totalpay = $request->totalpay;
        }

        $retention = 0;
        //variables del request
        $quantityBag = $request->bags;
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }

        //$documentType = $request->document_type_id;
        $service = '';
        $errorMessages = '';
        $store = false;
        if ($documentType == 1 && $indicator->dian == 'on') {
            $data = invoiceSend($request);
            //dd($data);
            $requestResponse = sendDocuments($company, $environment, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }
        //Crea un registro de Ventas
        if ($store == true) {

            $invoice = new Invoice();
            $invoice->user_id = current_user()->id;
            $invoice->branch_id = current_user()->branch_id;
            $invoice->customer_id = $request->customer_id;
            $invoice->payment_form_id = $request->payment_form_id;
            $invoice->payment_method_id = $request->payment_method_id[0];
            $invoice->resolution_id = $resolutions->id;
            $invoice->document_type_id = $documentType;
            $invoice->document = $resolutions->prefix . '-' . $resolutions->consecutive;
            $invoice->voucher_type_id = $voucherType;
            $invoice->status = 'invoice';
            $invoice->generation_date = $request->generation_date;
            $invoice->due_date = $request->due_date;
            $invoice->retention = $retention;
            $invoice->total = $request->total;
            $invoice->total_tax = $request->total_tax;
            $invoice->total_pay = $total_pay;
            if ($totalpay > 0) {
                $invoice->pay = $totalpay;
            } else {
                $invoice->pay = 0;
            }
            $invoice->balance = $total_pay - $totalpay;
            $invoice->grand_total = $total_pay - $retention;
            $invoice->save();

            $voucherTypes->consecutive += 1;
            $voucherTypes->update();

            if ($indicator->pos == 'on') {
                //actualizar la caja
                    $cashRegister->invoice += $total_pay;
                    //$cashRegister->in_total += $totalpay;
                    $cashRegister->update();
            }
            $document = $invoice;

            //Ingresa los productos que vienen en el array
            for ($i=0; $i < count($product_id); $i++) {
                $id = $product_id[$i];

                //Metodo para registrar la relacion entre producto y compra
                $invoiceProduct = new InvoiceProduct();
                $invoiceProduct->invoice_id = $invoice->id;
                $invoiceProduct->product_id = $id;
                $invoiceProduct->quantity = $quantity[$i];
                $invoiceProduct->price = $price[$i];
                $invoiceProduct->tax_rate = $tax_rate[$i];
                $invoiceProduct->subtotal = $quantity[$i] * $price[$i];
                $invoiceProduct->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                $invoiceProduct->save();

                //selecciona el producto que viene del array
                $product = Product::findOrFail($id);
                //selecciona el producto de la sucursal que sea el mismo del array
                $branchProducts = BranchProduct::where('product_id', '=', $id)
                ->where('branch_id', '=', $branch)
                ->first();

                $quantityLocal = $quantity[$i];
                $this->inventoryInvoices($product, $branchProducts, $quantityLocal, $branch);//trait para actualizar inventario
                $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex

            }

            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            taxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);
            retentions($request, $document, $typeDocument);

            if ($totalpay > 0) {
                pays($request, $document, $typeDocument);
            }

            if ($documentType == 1 && $indicator->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];

                $invoiceResponse = new InvoiceResponse();
                $invoiceResponse->document = $invoice->document;
                $invoiceResponse->message = $service['message'];
                $invoiceResponse->valid = $valid;
                $invoiceResponse->code = $code;
                $invoiceResponse->description = $description;
                $invoiceResponse->status_message = $statusMessage;
                $invoiceResponse->cufe = $service['cufe'];
                $invoiceResponse->invoice_id = $invoice->id;
                $invoiceResponse->save();

                $environmentPdf = Environment::where('code', 'PDF')->first();

                $pdf = file_get_contents($environmentPdf->url . $company->nit ."/FES-" . $resolutions->prefix .
                $resolutions->consecutive .".pdf");
                Storage::disk('public')->put('files/graphical_representations/invoices/' .
                $resolutions->prefix . $resolutions->consecutive . '.pdf', $pdf);
            }
            $resolutions->consecutive += 1;
            $resolutions->update();

            $invoiceOrder->status = 'generated';

            session()->forget('invoice');
            session(['invoice' => $invoice->id]);
            toast('Venta Registrada satisfactoriamente.','success');
            return redirect('invoice');
        }
        toast($errorMessages,'danger');
        return redirect('invoice');
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceOrderProduct $invoiceOrderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceOrderProduct $invoiceOrderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceOrderProductRequest $request, InvoiceOrderProduct $invoiceOrderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceOrderProduct $invoiceOrderProduct)
    {
        //
    }
}
