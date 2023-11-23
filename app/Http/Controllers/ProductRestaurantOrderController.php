<?php

namespace App\Http\Controllers;

use App\Models\ProductRestaurantOrder;
use App\Http\Requests\StoreProductRestaurantOrderRequest;
use App\Http\Requests\UpdateProductRestaurantOrderRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Card;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\CompanyTax;
use App\Models\Customer;
use App\Models\Environment;
use App\Models\HomeOrder;
use App\Models\Indicator;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\InvoiceResponse;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\RawMaterial;
use App\Models\RawmaterialRestaurantorder;
use App\Models\Resolution;
use App\Models\RestaurantOrder;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\KardexCreate;
use App\Traits\InventoryInvoices;
use App\Traits\Taxes;

class ProductRestaurantOrderController extends Controller
{
    use KardexCreate, InventoryInvoices, Taxes;

    function __construct()
    {
        $this->middleware('permission:productRestaurantOrder.create', ['only'=>['create','store']]);
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

     public function create(Request $request)
    {

        $restaurantOrder = RestaurantOrder::where('id', $request->session()->get('restaurantOrder'))->first();
        $homeOrder = HomeOrder::where('restaurant_order_id', $restaurantOrder->id)->first();
        $typeService = $restaurantOrder->restaurant_table_id;
        $indicator = Indicator::findOrFail(1);
        $customers = Customer::get();
        $resolutions = Resolution::where('document_type_id', 1)->where('status', 'active')->get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $uvtmax = $indicator->uvt * 5;
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $date = Carbon::now();
        $productRestaurantOrders = ProductRestaurantOrder::from('product_restaurant_orders as pr')
        ->join('products as pro', 'pr.product_id', 'pro.id')
        ->join('categories as cat', 'pro.category_id', 'cat.id')
        ->join('company_taxes as ct', 'cat.company_tax_id', 'ct.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('restaurant_orders as ro', 'pr.restaurant_order_id', 'ro.id')
        ->select('pro.id', 'pro.name', 'pr.quantity', 'pr.price', 'pr.tax_rate', 'pr.subtotal')
        ->where('restaurant_order_id', $restaurantOrder->id)
        ->get();

        $companyTaxes = CompanyTax::from('company_taxes', 'ct')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->join('percentages as per', 'ct.percentage_id', 'per.id')
        ->select('ct.id', 'ct.name', 'tt.id as ttId', 'tt.type_tax', 'per.percentage', 'per.base')
        ->where('tt.type_tax', 'retention')->get();
        return view('admin.productRestaurantOrder.create',
        compact(
            'restaurantOrder',
            'homeOrder',
            'typeService',
            'customers',
            'resolutions',
            'paymentForms',
            'paymentMethods',
            'banks',
            'cards',
            'branchs',
            'advances',
            'productRestaurantOrders',
            'date',
            'companyTaxes',
            'uvtmax',
            'indicator'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRestaurantOrderRequest $request)
    {
        //dd($request->all());
        $company = Company::findOrFail(current_user()->company_id);
        $environment = Environment::where('id', 11)->first();
        $indicator = Indicator::findOrFail(1);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $resolutions = '';
        $resolut = $request->resolution_id;

        if ($resolut == null) {
            $resolutions = Resolution::findOrFail(4);

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
        $branch = current_user()->branch_id;
        $restaurant_order_id = $request->restaurant_order_id;
        $restaurantOrder = RestaurantOrder::findOrFail($restaurant_order_id);
        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $tax_rate = $request->tax_rate;
        $total_pay = $restaurantOrder->total_pay;
        $totalpay = $request->totalpay;
        $retention = 0;
        //dd($restaurantOrder);
        $restaurantService = $restaurantOrder->restaurant_table_id;
        if ($restaurantService == 1) {
            $date = Carbon::now();
            $homeOrder = HomeOrder::where('restaurant_order_id', $restaurantOrder->id)->first();
            $homeOrder->domiciliary = $request->domiciliary;
            $homeOrder->domicile_value = $request->domicile_value;
            $homeOrder->time_sent = $date->toTimeString();
            $homeOrder->update();
        }
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
            $invoice->generation_date = $restaurantOrder->created_at;
            $invoice->due_date = $restaurantOrder->created_at;
            $invoice->retention = $retention;
            $invoice->total = $restaurantOrder->total;
            $invoice->total_tax = $restaurantOrder->total_tax;
            $invoice->total_pay = $restaurantOrder->total_pay;
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
                /*
                $productRawmaterials = ProductRawmaterial::where('product_id', $product_id[$i])->get();
                if ($productRawmaterials) {
                    foreach ($productRawmaterials as $key => $productRawmaterial) {
                        $productRawmaterialQuantity = $productRawmaterial->quantity;
                        $quantityTotal = $productRawmaterialQuantity * $quantity[$i];
                        $rawMaterial = RawMaterial::findOrFail($productRawmaterial->raw_material_id);
                        $rawMaterial->stock -= $quantityTotal;
                        $rawMaterial->update();

                        $product = $rawMaterial;
                        $quantityLocal = $quantity[$i];
                        $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
                    }
                }*/


                //selecciona el producto que viene del array
                $product = Product::findOrFail($id);
                //selecciona el producto de la sucursal que sea el mismo del array
                $branchProducts = BranchProduct::where('branch_id', '=', $branch)->where('product_id', '=', $id)->first();

                $quantityLocal = $quantity[$i];
                $this->inventoryInvoices($product, $branchProducts, $quantityLocal, $branch);//trait para actualizar inventario
                $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex

            }
            $rawmaterialRestaurantorders = RawmaterialRestaurantorder::where('restaurant_order_id', $restaurantOrder->id)->where('quantity', '>', 0)->get();
                if ($rawmaterialRestaurantorders) {
                    foreach ($rawmaterialRestaurantorders as $key => $rawmaterialRestaurantorder) {
                        $quantityLocal = $rawmaterialRestaurantorder->total_quantity;
                        $rawMaterial = RawMaterial::findOrFail($rawmaterialRestaurantorder->raw_material_id);
                        $rawMaterial->stock -= $quantityLocal;
                        $rawMaterial->update();

                        $product = $rawMaterial;
                        //$quantityLocal = $quantityrm;
                        $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
                    }
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

            $restaurantOrder->invoice_id = $invoice->id;
            $restaurantOrder->status = 'generated';
            $restaurantOrder->update();

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
    public function show(ProductRestaurantOrder $productRestaurantOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductRestaurantOrder $productRestaurantOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRestaurantOrderRequest $request, ProductRestaurantOrder $productRestaurantOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductRestaurantOrder $productRestaurantOrder)
    {
        //
    }
}
