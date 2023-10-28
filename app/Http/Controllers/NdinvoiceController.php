<?php

namespace App\Http\Controllers;

use App\Models\Ndinvoice;
use App\Http\Requests\StoreNdinvoiceRequest;
use App\Http\Requests\UpdateNdinvoiceRequest;
use App\Models\BranchProduct;
use App\Models\CashRegister;
use App\Models\Company;
use App\Models\Environment;
use App\Models\Indicator;
use App\Models\Invoice;
use App\Models\NdinvoiceProduct;
use App\Models\NdinvoiceResponse;
use App\Models\Pay;
use App\Models\Product;
use App\Models\Resolution;
use App\Models\Tax;
use App\Models\VoucherType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryInvoices;
use App\Traits\KardexCreate;
use App\Traits\Taxes;

class NdinvoiceController extends Controller
{
    use InventoryInvoices, KardexCreate, Taxes;
    function __construct()
    {
        $this->middleware('permission:ndinvoice.index|ndinvoice.store|ndinvoice.show', ['only'=>['index']]);
        $this->middleware('permission:ndinvoice.store', ['only'=>['create','store']]);
        $this->middleware('permission:ndinvoice.show', ['only'=>['show']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $ndinvoice = session('ndinvoice');
        if ($request->ajax()) {
            $users = current_user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Consulta para mostrar todas las notas debito a admin y superadmin
                $ndinvoices = Ndinvoice::get();
            } else {
                //Consulta para mostrar notas debito de los demas roles
                $ndinvoices = Ndinvoice::where('user_id', $user->id)->get();
            }
            return DataTables::of($ndinvoices)
            ->addIndexColumn()
            ->addColumn('branch', function (ndinvoice $ndinvoice) {
                return $ndinvoice->branch->name;
            })
            ->addColumn('customer', function (ndinvoice $ndinvoice) {
                return $ndinvoice->third->name;
            })
            ->addColumn('document', function (ndinvoice $ndinvoice) {
                return $ndinvoice->invoice->document;
            })

            ->addColumn('user', function (ndinvoice $ndinvoice) {
                return $ndinvoice->user->name;
            })

            ->editColumn('created_at', function(ndinvoice $ndinvoice){
                return $ndinvoice->created_at->format('yy-m-d: h:m');
            })
            ->addColumn('btn', 'admin/ndinvoice/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.ndinvoice.index', compact('ndinvoice'));
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
    public function store(StoreNdinvoiceRequest $request)
    {
        //dd($request->all());
        $company = Company::findOrFail(current_user()->company_id);
        $invoice = Invoice::findOrFail($request->invoice_id);//encontrando la factura
        $environment = Environment::where('id', 13)->first();//Url nota de ajuste documento soporte
        $pay = Pay::where('type', 'invoice')->where('payable_id', $invoice->id)->get();//pagos hechos a esta factura
        //$resolution = Resolution::findOrFail(7);
        $indicator = Indicator::findOrFail(1);
        $voucherTypes = VoucherType::findOrFail(6);
        $cashRegister = CashRegister::where('user_id', '=', current_user()->id)->where('status', '=', 'open')->first();
        $resolution = '';
        if ($invoice->document_type_id == 1) {
            $resolution = Resolution::findOrFail(9);
            $voucherTypes = VoucherType::findOrFail(6);
        } else {
            $resolution = Resolution::findOrFail(6);
            $voucherTypes = VoucherType::findOrFail(22);
        }

        $typeDocument = 'ndinvoice';
        $quantity = $request->quantity;
        $price = $request->price;
        $total_pay = $request->total_pay;
        $product_id = $request->product_id;
        $discrepancy = $request->discrepancy_id;
        $tax_rate = $request->tax_rate;
        $retention = 0;
        //variables del request
        if ($request->total_retention != null) {
            $retention = $request->total_retention;
        }

        //gran total de la compra
        $grandTotalold = $invoice->grand_total;
        $grandTotalNd = $total_pay - $retention;
        $newGrandTotal = $grandTotalold + $grandTotalNd;
        $newBalance = $newGrandTotal - $invoice->pay;

        $branch = $invoice->branch_id;

        //Registrar tabla Nota Credito
        $ndinvoice = new Ndinvoice();
        $ndinvoice->document = $resolution->prefix . '-' . $resolution->consecutive;
        $ndinvoice->user_id = current_user()->id;
        $ndinvoice->branch_id = current_user()->branch_id;
        $ndinvoice->invoice_id = $invoice->id;
        $ndinvoice->customer_id = $invoice->customer_id;
        $ndinvoice->resolution_id = $resolution->id;
        $ndinvoice->discrepancy_id = $discrepancy;
        $ndinvoice->voucher_type_id = $voucherTypes->id;
        $ndinvoice->retention = $retention;
        $ndinvoice->total = $request->total;
        $ndinvoice->total_tax = $request->total_tax;
        $ndinvoice->total_pay = $request->total_pay;
        $ndinvoice->save();

        if ($indicator->pos == 'on') {
            //actualizar la caja
            $cashRegister->ndinvoice += $total_pay;
            $cashRegister->update();
        }

        $service = '';
        $errorMessages = '';
        $store = false;
        if ($indicator->dian == 'off') {
            $data = ndinvoiceSend($request, $invoice);
            $requestResponse = sendDocuments($company, $environment, $data);
            $store = $requestResponse['store'];
            $service = $requestResponse['response'];
            $errorMessages = $requestResponse['errorMessages'];
        } else {
            $store = true;
        }
        if ($store == true) {
            switch($discrepancy) {
                case(7):
                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0.','warning');
                        return redirect("invoice");
                    }
                    for ($i=0; $i < count($product_id); $i++) {
                        $id = $product_id[$i];
                        //selecciona el producto que viene del array
                        $product = Product::findOrFail($id);

                        $branchProducts = BranchProduct::where('product_id', '=', $id)
                        ->where('branch_id', '=', $branch)
                        ->first();

                        //registrando nota debito productos
                        $ndinvoiceProduct = new NdinvoiceProduct();
                        $ndinvoiceProduct->ndinvoice_id = $ndinvoice->id;
                        $ndinvoiceProduct->product_id = $id;
                        $ndinvoiceProduct->quantity = $quantity[$i];
                        $ndinvoiceProduct->price = $price[$i];
                        $ndinvoiceProduct->tax_rate = $tax_rate[$i];
                        $ndinvoiceProduct->subtotal = $quantity[$i] * $price[$i];
                        $ndinvoiceProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ndinvoiceProduct->save();

                        $quantityLocal = $quantity[$i];
                        $priceLocal = $price[$i];
                        //dd($branch);
                        $this->inventoryInvoices($product, $branchProducts, $quantityLocal, $priceLocal, $branch);//trait para actualizar inventario
                    }
                break;
                case(8):

                    if ($total_pay <= 0) {
                        toast(' Nota debito no debe ser menor o igual a 0 en ningun item.','warning');
                        return redirect("invoice");
                    }
                    for ($i=0; $i < count($product_id); $i++) {
                        $id = $product_id[$i];

                        $product = Product::findOrFail($id);
                        //registrando nota debito productos
                        $ndinvoiceProduct = new NdinvoiceProduct();
                        $ndinvoiceProduct->ndinvoice_id = $ndinvoice->id;
                        $ndinvoiceProduct->product_id = $id;
                        $ndinvoiceProduct->quantity = $quantity[$i];
                        $ndinvoiceProduct->price = $price[$i];
                        $ndinvoiceProduct->tax_rate = $tax_rate[$i];
                        $ndinvoiceProduct->subtotal = $quantity[$i] * $price[$i];
                        $ndinvoiceProduct->tax_subtotal = ($quantity[$i] * $price[$i] * $tax_rate[$i])/100;
                        $ndinvoiceProduct->save();

                        //selecciona el impuesto que tiene la categoria IVA o INC
                    }
                break;
            }

            $document = $ndinvoice;
            $quantityBag = 0;
            $taxes = $this->getTaxesLine($request);//selecciona el impuesto que tiene la categoria IVA o INC
            taxesGlobals($document, $quantityBag, $typeDocument);
            taxesLines($document, $taxes, $typeDocument);//Helper para impuestos de linea
            retentions($request, $document, $typeDocument);//Helper para retenciones

            $voucherTypes->consecutive += 1;
            $voucherTypes->update();

            $invoice->grand_total = $newGrandTotal;
            $invoice->balance = $newBalance;
            if ($invoice->status == 'invoice') {
                $invoice->status = 'debit_note';
            } elseif ($invoice->status == 'credit_note') {
                $invoice->status = 'complete';
            }
            $invoice->update();

            if ($indicator->dian == 'on') {
                $valid = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['IsValid'];
                $code = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusCode'];
                $description = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusDescription'];
                $statusMessage = $service['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']
                    ['SendBillSyncResult']['StatusMessage'];

                $ndinvoiceResponse = new NdinvoiceResponse();
                $ndinvoiceResponse->document = $invoice->document;
                $ndinvoiceResponse->message = $service['message'];
                $ndinvoiceResponse->valid = $valid;
                $ndinvoiceResponse->code = $code;
                $ndinvoiceResponse->description = $description;
                $ndinvoiceResponse->status_message = $statusMessage;
                $ndinvoiceResponse->cude = $service['cude'];
                $ndinvoiceResponse->ncinvoice_id = $ndinvoice->id;
                $ndinvoiceResponse->save();

                $environmentPdf = Environment::where('code', 'PDF')->first();

                $pdf = file_get_contents($environmentPdf->url . $company->nit ."/NDS-" . $resolution->prefix .
                $resolution->consecutive .".pdf");
                Storage::disk('public')->put('files/graphical_representations/ndinvoice/' .
                $resolution->prefix . $resolution->consecutive . '.pdf', $pdf);


            }
            $resolution->consecutive += 1;
            $resolution->update();

            session()->forget('ndinvoice');
            session(['ndinvoice' => $ndinvoice->id]);

            toast('Nota Debito Registrada satisfactoriamente.','success');
            return redirect('ndinvoice');
        } else {
            toast($errorMessages,'Danger');
            return redirect('ndinvoice');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Ndinvoice $ndinvoice)
    {
        $ndinvoiceProducts = NdinvoiceProduct::where('ndinvoice_id', $ndinvoice->id)->where('quantity', '>', 0)->get();
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->get();

       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');
        return view('admin.ndinvoice.show', compact(
            'ndinvoice',
            'ndinvoiceProducts',
            'retentions',
            'retentionsum'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ndinvoice $ndinvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNdinvoiceRequest $request, Ndinvoice $ndinvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ndinvoice $ndinvoice)
    {
        //
    }

    public function ndinvoicePdf(Request $request, $id)
    {
       $ndinvoice = ndinvoice::findOrFail($id);
       $ndinvoiceProducts = ndinvoiceProduct::where('ndinvoice_id', $id)->where('quantity', '>', 0)->get();
       $company = Company::findOrFail(1);
       $indicator = Indicator::findOrFail(1);
       $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

       $ndinvoicepdf = $ndinvoice->document;
       $logo = './imagenes/logos'.$company->logo;
       $view = \view('admin.ndinvoice.pdf', compact(
            'ndinvoice',
            'ndinvoiceProducts',
            'company',
            'indicator',
            'logo',
            'retentions',
            'retentionsum'
        ));
       $pdf = App::make('dompdf.wrapper');
       $pdf->loadHTML($view);
       //$pdf->setPaper ( 'A7' , 'landscape' );

       return $pdf->stream('vista-pdf', "$ndinvoicepdf.pdf");
       //return $pdf->download("$invoicepdf.pdf");*/
    }

    public function pdfNdinvoice(Request $request)
    {
        $ndinvoices = session('ndinvoice');
        $ndinvoice = Ndinvoice::findOrFail($ndinvoices);
        session()->forget('ndinvoice');
        $ndinvoiceProducts = ndinvoiceProduct::where('ndinvoice_id', $ndinvoice->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $retentions = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->get();
       $retentionsum = Tax::from('taxes as tax')
        ->join('company_taxes as ct', 'tax.company_tax_id', 'ct.id')
        ->join('tax_types as tt', 'ct.tax_type_id', 'tt.id')
        ->select('tax.tax_value', 'ct.name')
        ->where('tax.type', 'ndinvoice')
        ->where('tax.taxable_id', $ndinvoice->id)
        ->where('tt.type_tax', 'retention')->sum('tax_value');

        $ndinvoicepdf = $ndinvoice->document;
        $view = \view('admin.ndinvoice.pdf', compact(
            'ndinvoice',
            'ndinvoiceProducts',
            'company',
            'indicator',
            'retentions',
            'retentionsum'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('vista-pdf', "$ndinvoicepdf.pdf");
    }
}
