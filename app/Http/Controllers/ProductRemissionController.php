<?php

namespace App\Http\Controllers;

use App\Models\ProductRemission;
use App\Http\Requests\StoreProductRemissionRequest;
use App\Http\Requests\UpdateProductRemissionRequest;
use App\Models\ApiResponse;
use App\Models\Configuration;
use App\Models\Employee;
use App\Models\EmployeeInvoiceProduct;
use App\Models\Environment;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\InvoiceResponse;
use App\Models\Pay;
use App\Models\PaymentReturn;
use App\Models\PayPaymentMethod;
use App\Models\Product;
use App\Models\Remission;
use App\Models\Resolution;
use App\Models\VoucherType;
use Illuminate\Support\Facades\Storage;
use App\Traits\GetTaxesLine;

class ProductRemissionController extends Controller
{
    use GetTaxesLine;
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
    public function store(StoreProductRemissionRequest $request)
    {
        //dd($request->all());
        $remissionId = $request->remission_id;
        $remission = Remission::findOrFail($remissionId);
        $configuration = Configuration::findOrFail(company()->id);
        $cashRegister = cashRegisterComprobation();
        //$indicator = Indicator::findOrFail(1);
        $resolutions = '';
        //$resolut = $request->resolution_id;

        $typeDocument = $request->typeDocument;
        $documentType = '';


        //Metodo si los envios a la dian es si trae resolucion
        //asignacion del vaucher y document type
        if (indicator()->dian == 'on') {
            $resolutions = Resolution::findOrFail($request->resolution_id);
            if ($typeDocument == 'invoice') {
                $voucherType = 1;
                $documentType = 1;
            } else {
                $voucherType = 2;
                $documentType = 15;
            }
        } else {
            if ($typeDocument == 'invoice') {
                $resolutions = Resolution::findOrFail(13);
                $voucherType = 1;
                $documentType = 1;
            } else {
                $resolutions = Resolution::findOrFail(4);
                $voucherType = 24;
                $documentType = 104;
            }
        }

        $voucherTypes = VoucherType::findOrFail($voucherType);
        //Variables del request
        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $total_pay = $request->total_pay;
        $employee_id = $request->employee_id;
        $paymentForm = $request->payment_form_id;
        $payment = $request->total_pay;
        $totalpay = $request->totalpay;

        if (isset($payment)) {
            $totalpay = $request->totalpay;
        } else {
            if (indicator()->pos == 'on'  && $paymentForm == 1) {
                $totalpay = $request->total_pay;
            } else if(indicator()->pos == 'on'  && $paymentForm == 2){
                $totalpay = 0;
            }
        }

        if (isset($employee_id)) {
            $employee_id = $request->employee_id;
        } else {
            $employee_id = "null";
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
        if (indicator()->dian == 'on') {
            if ($typeDocument == 'invoice') {
                $data = invoiceData($request);
                $environment = Environment::where('id', 11)->first();

                $url = $environment->protocol . $configuration->ip . $environment->url;
            } else {
                $data = equiDocPosData($request);
                $environment = Environment::where('id', 21)->first();
                $url = $environment->protocol . $configuration->ip . $environment->url;
            }
            //dd($url);
            $requestResponse = sendDocuments($url, $data);
            //dd($requestResponse);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
            $responseApi = json_encode($service);

            $apiResponse = new ApiResponse();
            $apiResponse->document = $resolutions->prefix . $resolutions->consecutive;
            $apiResponse->response_api = $responseApi;
            $apiResponse->save();
        } else {
            $store = true;
        }
        //dd($service);
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
            $invoice->document = $resolutions->prefix . $resolutions->consecutive;
            $invoice->voucher_type_id = $voucherType;
            $invoice->cash_register_id = cashRegisterComprobation()->id;
            $invoice->status = 'invoice';
            $invoice->note = $request->note;
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
            $invoice->balance = $remission->balance - $totalpay;
            $invoice->grand_total = $total_pay - $retention;
            $invoice->save();

            $voucherTypes->consecutive += 1;
            $voucherTypes->update();
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

                $product = Product::findOrFail($id);

                if (indicator()->work_labor == 'on') {
                    //metodo para comisiones de empleados
                    if ($employee_id[$i] != "null") {
                        $employee = Employee::findOrFail($employee_id[$i]);
                        $subtotal = $quantity[$i] * $price[$i];
                        if (indicator()->cmep == 'employee') {
                            $commission = $employee->commission;
                        } else {
                            $commission = $product->commission;
                        }
                        $valueCommission = ($subtotal/100) * $commission;

                        $employeeInvoiceProduct = new EmployeeInvoiceProduct();
                        $employeeInvoiceProduct->invoice_product_id = $invoiceProduct->id;
                        $employeeInvoiceProduct->employee_id = $employee_id[$i];
                        $employeeInvoiceProduct->generation_date = $request->generation_date;
                        $employeeInvoiceProduct->quantity = $quantity[$i];
                        $employeeInvoiceProduct->price = $price[$i];
                        $employeeInvoiceProduct->subtotal = $subtotal;
                        $employeeInvoiceProduct->commission = $commission;
                        $employeeInvoiceProduct->value_commission = $valueCommission;
                        $employeeInvoiceProduct->status = 'pendient';
                        $employeeInvoiceProduct->save();
                    }
                }
            }

            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            taxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);
            retentions($request, $document, $typeDocument);

            if (indicator()->pos == 'on' && $typeDocument == 'pos') {
                $return = 0;
                if ($totalpay > 0) {
                    $paymentMethod = $request->payment_method_id;
                    $bank = 1;
                    $card = 1;
                    $advance_id = null;
                    $payment = $request->pay;
                    $transaction = 00;
                    $payAdvance = 0;
                    $return = $payment - $totalpay;
                        //Metodo para crear un nuevo pago y su realcion polimorfica dependiendo del tipo de documento
                    $pay = new Pay();
                    $pay->user_id = current_user()->id;
                    $pay->branch_id = current_user()->branch_id;
                    $pay->pay = $totalpay;
                    $pay->balance = $document->balance;
                    $pay->type = 'invoice';

                    $invoice = $document;
                    $invoice->pays()->save($pay);

                    //Metodo para registrar la relacion entre pago y metodo de pago
                    $pay_paymentMethod = new PayPaymentMethod();
                    $pay_paymentMethod->pay_id = $pay->id;
                    $pay_paymentMethod->payment_method_id = $paymentMethod;
                    $pay_paymentMethod->bank_id = $bank;
                    $pay_paymentMethod->card_id = $card;
                    $pay_paymentMethod->pay = $payment;
                    $pay_paymentMethod->transaction = $transaction;
                    $pay_paymentMethod->save();

                    //metodo para actualizar la caja
                    $cashRegister->in_invoice_cash += $totalpay;
                    $cashRegister->cash_in_total += $totalpay;

                    $cashRegister->in_invoice += $totalpay;
                    $cashRegister->in_total += $totalpay;
                    $cashRegister->update();
                }
                $paymentReturn = new PaymentReturn();
                $paymentReturn->payment = $request->pay;
                $paymentReturn->return = $return;
                $paymentReturn->invoice_id = $invoice->id;
                $paymentReturn->save();
            } else {
                if ($totalpay > 0) {
                    pays($request, $document, $typeDocument);
                }
            }

            if ($documentType == 1 && indicator()->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];

                $invoiceResponse = new InvoiceResponse();
                $invoiceResponse->invoice_id = $invoice->id;
                $invoiceResponse->document = $invoice->document;
                $invoiceResponse->message = $service['message'];
                $invoiceResponse->valid = $valid;
                $invoiceResponse->code = $code;
                $invoiceResponse->description = $description;
                $invoiceResponse->status_message = $statusMessage;
                $invoiceResponse->cufe = $service['cufe'];
                $invoiceResponse->response_api = $responseApi;
                $invoiceResponse->save();

                $environmentPdf = Environment::where('code', 'PDF')->first();
                $urlpdf = $environmentPdf->protocol . $configuration->ip . $environmentPdf->url;

                $pdf = file_get_contents($urlpdf . company()->nit ."/FES-" . $invoice->document .".pdf");
                Storage::disk('public')->put('files/graphical_representations/invoices/' .
                $invoice->document . '.pdf', $pdf);
            }
            $resolutions->consecutive += 1;
            $resolutions->update();

            $remission->invoice_id = $invoice->id;
            $remission->status = 'generated';
            $remission->update();

            session()->forget('invoice');
            session()->forget('typeDocument');
            session(['invoice' => $invoice->id]);
            session(['typeDocument' => $typeDocument]);
            toast('Venta Registrada satisfactoriamente.','success');
            return redirect('invoice');
        }
        toast($errorMessages,'danger');
        return redirect('invoice');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductRemission $productRemission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductRemission $productRemission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRemissionRequest $request, ProductRemission $productRemission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductRemission $productRemission)
    {
        //
    }
}
