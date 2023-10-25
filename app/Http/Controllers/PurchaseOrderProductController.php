<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrderProduct;
use App\Http\Requests\StorePurchaseOrderProductRequest;
use App\Http\Requests\UpdatePurchaseOrderProductRequest;
use App\Models\BranchProduct;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Environment;
use App\Models\Indicator;
use App\Models\Product;
use App\Models\ProductPurchase;
use App\Models\Purchase;
use App\Models\PurchaseOrder;
use App\Models\Resolution;
use App\Models\SupportDocumentResponse;
use App\Models\VoucherType;
use App\Traits\InventoryPurchases;
use App\Traits\KardexCreate;
use App\Traits\Taxes;
use Illuminate\Support\Facades\Storage;

class PurchaseOrderProductController extends Controller
{
    use InventoryPurchases, KardexCreate, Taxes;
    function __construct()
    {
        $this->middleware('permission:purchaseOrderProduct.store', ['only'=>['store']]);
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
    public function store(StorePurchaseOrderProductRequest $request)
    {
        //dd($request->all());
        $company = Company::findOrFail(current_user()->company_id);
        $environment = Environment::where('code', 'SD')->first();
        $indicator = Indicator::findOrFail(1);
        $purchaseOrder = PurchaseOrder::findOrFail($request->purchaseOrder);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $typeDocument = 'purchase';
        $voucherType = 7;

        //Variables del request

        $product_id = $request->product_id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $branch = $purchaseOrder->branch_id;//variable de la sucursal de destino
        $total_pay = $request->total_pay;
        $totalpay = $request->totalpay;
        $retention = 0;
        //variables del request
        $quantityBag = 0;
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }


        $documentType = $request->document_type_id;
        $store = false;
        if ($documentType == 11 && $indicator->dian == 'on') {
            $data = supportDocumentSend($request);
            $requestResponse = sendDocuments($company, $environment, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }
        //Crea un registro de compras

        if ($store == true) {

            $purchase = new Purchase();
            $purchase->user_id = current_user()->id;
            $purchase->branch_id = current_user()->branch_id;
            $purchase->provider_id = $purchaseOrder->provider_id;
            $purchase->payment_form_id = $request->payment_form_id;
            $purchase->payment_method_id = $request->payment_method_id[0];
            $purchase->resolution_id = $request->resolution_id;
            $purchase->generation_type_id = $request->generation_type_id;
            $purchase->document_type_id = $documentType;
            if ($documentType == 11) {
                $resolutions = Resolution::findOrFail($request->resolution_id);
                $voucherTypes = VoucherType::findOrFail(12);
                $purchase->document = $resolutions->prefix . '-' . $resolutions->consecutive;
                $purchase->invoice_code = $voucherTypes->code . '-' . $voucherTypes->consecutive;
                $purchase->voucher_type_id = 12;
                $purchase->status = 'support_document';
                $voucherTypes->consecutive += 1;
                $voucherTypes->update();
            } else {
                $voucherTypes = VoucherType::findOrFail(7);
                $purchase->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
                $purchase->invoice_code = $request->invoice_code;
                $purchase->voucher_type_id = 7;
                $purchase->status = 'purchase';
                $voucherTypes->consecutive += 1;
                $voucherTypes->update();
            }
            $purchase->generation_date = $request->generation_date;
            $purchase->due_date = $request->due_date;
            $purchase->retention = $retention;
            $purchase->total = $request->total;
            $purchase->total_tax = $request->total_tax;
            $purchase->total_pay = $total_pay;

            if ($totalpay > 0) {
                $purchase->pay = $totalpay;
            } else {
                $purchase->pay = 0;
            }
            $purchase->balance = $total_pay;
            $purchase->grand_total = $total_pay - $retention;
            $purchase->start_date = $request->start_date;
            $purchase->save();

            $voucher = VoucherType::findOrFail(19);
            $voucher->consecutive = $purchase->id;
            $voucher->update();

            if ($indicator->pos == 'on') {
                //actualizar la caja
                    $cashRegister->purchase += $total_pay;
                    $cashRegister->out_total += $totalpay;
                    $cashRegister->update();
            }
            $document = $purchase;
            //Ingresa los productos que vienen en el array
            for ($i=0; $i < count($product_id); $i++) {
                $id = $product_id[$i];
                //Metodo para registrar la relacion entre producto y compra
                $productPurchase = new ProductPurchase();
                $productPurchase->purchase_id = $purchase->id;
                $productPurchase->product_id = $id;
                $productPurchase->quantity = $quantity[$i];
                $productPurchase->price = $price[$i];
                $productPurchase->tax_rate = $tax_rate[$i];
                $productPurchase->subtotal = $quantity[$i] * $price[$i];
                $productPurchase->tax_subtotal =($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                $productPurchase->save();

                //selecciona el producto que viene del array
                $product = Product::findOrFail($id);
                //selecciona el producto de la sucursal que sea el mismo del array
                $branchProducts = BranchProduct::where('product_id', '=', $id)
                ->where('branch_id', '=', $branch)
                ->first();

                $quantityLocal = $quantity[$i];
                $priceLocal = $price[$i];
                $this->inventoryPurchases($product, $branchProducts, $quantityLocal, $priceLocal, $branch);//trait para actualizar inventario
                $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex

            }

            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            //taxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);
            retentions($request, $document, $typeDocument);


            if ($totalpay > 0) {
                pays($request, $document, $typeDocument);
            }
            if ($documentType == 11 && $indicator->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];

                $supportDocumentResponse = new SupportDocumentResponse();
                $supportDocumentResponse->document = $purchase->document;
                $supportDocumentResponse->message = $service['message'];
                $supportDocumentResponse->valid = $valid;
                $supportDocumentResponse->code = $code;
                $supportDocumentResponse->description = $description;
                $supportDocumentResponse->status_message = $statusMessage;
                $supportDocumentResponse->cuds = $service['cuds'];
                $supportDocumentResponse->purchase_id = $purchase->id;
                $supportDocumentResponse->save();

                $environmentPdf = Environment::where('code', 'PDF')->first();

                $pdf = file_get_contents($environmentPdf->url . $company->nit ."/DSS-" . $resolutions->prefix .
                $resolutions->consecutive .".pdf");
                Storage::disk('public')->put('files/graphical_representations/support_documents/' .
                $resolutions->prefix . $resolutions->consecutive . '.pdf', $pdf);

                $resolutions->consecutive += 1;
                $resolutions->update();
            }
            $purchase->balance -= ($totalpay + $retention);
            $purchase-> update();

            $purchaseOrder->status = 'generated';
            $purchaseOrder->update();

            session()->forget('purchase');
            session()->forget('purchaseOrder');
            session(['purchase' => $purchase->id]);
            toast('Compra Registrada satisfactoriamente.','success');
            return redirect('purchase');
        }
        return redirect('purchases')->with('error_message', $errorMessages);
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseOrderProduct $purchaseOrderProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PurchaseOrderProduct $purchaseOrderProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PurchaseOrderProduct $purchaseOrderProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PurchaseOrderProduct $purchaseOrderProduct)
    {
        //
    }
}
