<?php

namespace App\Http\Controllers;

use App\Helpers\Pdfs\PdfDocuments;
use App\Helpers\Tickets\Ticket;
use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Advance;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Card;
use App\Models\Company;
use App\Models\Department;
use App\Models\ExpenseProduct;
use App\Models\IdentificationType;
use App\Models\Indicator;
use App\Models\Kardex;
use App\Models\Liability;
use App\Models\Municipality;
use App\Models\Organization;
use App\Models\Pay;
use App\Models\PaymentForm;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Regime;
use App\Models\VoucherType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use App\Traits\InventoryPurchases;
use App\Traits\KardexCreate;
use App\Traits\Reverse;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Picqer\Barcode\BarcodeGeneratorPNG;

use function App\Helpers\Tickets\formatText;
use function App\Helpers\Tickets\ticketHeight;

class ExpenseController extends Controller
{
    use InventoryPurchases, KardexCreate, Reverse;
    function __construct()
    {
        $this->middleware('permission:expense.index|expense.create|expense.show|expense.edit', ['only'=>['index']]);
        $this->middleware('permission:expense.create', ['only'=>['create','store']]);
        $this->middleware('permission:expense.show', ['only'=>['show']]);
        $this->middleware('permission:expense.edit', ['only'=>['edit','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $typeDocument = '';
        $expense = '';
        $indicator = Indicator::findOrFail(1);
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Muestra todas las compras de la empresa
                $expenses = Expense::get();
            } else {
                //Muestra todas las compras de la empresa por usuario
                $expenses = Expense::where('user_id', $users->id)->get();
            }
            return DataTables::of($expenses)
            ->addIndexColumn()

            ->addColumn('provider', function (Expense $expense) {
                return $expense->third->name;
            })
            ->addColumn('branch', function (Expense $expense) {
                return $expense->branch->name;
            })
            ->addColumn('role', function (Expense $expense) {
                return $expense->user->roles[0]->name;
            })
            ->editColumn('created_at', function(Expense $expense){
                return $expense->created_at->format('Y-m-d: h:m');
            })
            ->addColumn('btn', 'admin/expense/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.expense.index', compact('expense', 'typeDocument'));
    }

    public function indexExpense(Request $request)
    {
        $typeDocument = session('typeDocument');
        $expense = session('expense');
        $indicator = Indicator::findOrFail(1);
        if ($request->ajax()) {
            $users = Auth::user();
            $user = $users->Roles[0]->name;
            if ($user == 'superAdmin' ||$user == 'admin') {
                //Muestra todas las compras de la empresa
                $expenses = Expense::get();
            } else {
                //Muestra todas las compras de la empresa por usuario
                $expenses = Expense::where('user_id', $users->id)->get();
            }
            return DataTables::of($expenses)
            ->addIndexColumn()

            ->addColumn('provider', function (Expense $expense) {
                return $expense->third->name;
            })
            ->addColumn('branch', function (Expense $expense) {
                return $expense->branch->name;
            })
            ->addColumn('role', function (Expense $expense) {
                return $expense->user->roles[0]->name;
            })
            ->editColumn('created_at', function(Expense $expense){
                return $expense->created_at->format('Y-m-d: h:m');
            })
            ->addColumn('btn', 'admin/expense/actions')
            ->rawColumns(['btn'])
            ->make(true);
        }
        return view('admin.expense.index', compact('expense', 'indicator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $indicator = Indicator::findOrFail(1);
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $departments = Department::get();
        $municipalities = Municipality::get();
        $identificationTypes = IdentificationType::get();
        $liabilities = Liability::get();
        $organizations = Organization::get();
        $providers = Provider::get();
        $regimes = Regime::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $advances = Advance::get();
        $products = Product::where('status', 'active')->where('type_product', 'service')->get();

        return view('admin.expense.create',
        compact(
            'departments',
            'municipalities',
            'identificationTypes',
            'liabilities',
            'organizations',
            'providers',
            'regimes',
            'paymentForms',
            'paymentMethods',
            'banks',
            'cards',
            'branchs',
            'advances',
            'products',
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreExpenseRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreExpenseRequest $request)
    {
        //dd($request->all());
        $company = Company::findOrFail(current_user()->company_id);
        $indicator = Indicator::findOrFail(1);
        $cashRegister = cashRegisterComprobation();
        $voucherTypes = VoucherType::findOrFail(20);
        $typeDocument = 'expense';
        //$voucherType = 20;

        //Variables del request
        $product_id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        //$tax_rate = $request->tax_rate;
        $branch = current_user()->branch_id;//variable de la sucursal de destino
        //$total_pay = $request->total_pay;
        $totalpay = $request->totalpay;
        $total = $request->total;

        //Crea un registro de compras
        $expense = new Expense();
        $expense->user_id = current_user()->id;
        $expense->branch_id = $branch;
        $expense->provider_id = $request->provider_id;
        $expense->payment_form_id = $request->payment_form_id;
        $expense->payment_method_id = $request->payment_method_id[0];
        $expense->document = $voucherTypes->code . '-' . $voucherTypes->consecutive;
        $expense->voucher_type_id = $voucherTypes->id;
        $expense->cash_register_id = $cashRegister->id;
        $expense->generation_date = $request->generation_date;
        $expense->total = $total;
        $expense->total_tax = 0;
        $expense->total_pay = $total;
        if ($totalpay > 0) {
            $expense->pay = $totalpay;
        } else {
            $expense->pay = 0;
        }
        $expense->balance = $total - $totalpay;
        $expense->grand_total = $total;
        $expense->save();

        $voucherTypes->consecutive += 1;
        $voucherTypes->update();

        if ($indicator->pos == 'on') {
            //actualizar la caja
            $cashRegister->expense += $expense->total;
            //$cashRegister->out_total += $totalpay;
            $cashRegister->update();
        }
        //Toma el Request del array
        //Ingresa los productos que vienen en el array
        $document = $expense;
        for ($i=0; $i < count($product_id); $i++) {
            $id = $product_id[$i];
            //Metodo para registrar la relacion entre producto y compra
            $expenseProduct = new ExpenseProduct();
            $expenseProduct->expense_id = $expense->id;
            $expenseProduct->product_id = $id;
            $expenseProduct->quantity = $quantity[$i];
            $expenseProduct->price = $price[$i];
            $expenseProduct->tax_rate = 0;
            $expenseProduct->subtotal = $quantity[$i] * $price[$i];
            $expenseProduct->tax_subtotal =0;
            $expenseProduct->save();
            //selecciona el producto que viene del array
            $product = Product::findOrFail($id);

            //selecciona el producto de la sucursal que sea el mismo del array
            $branchProducts = BranchProduct::where('product_id', '=', $id)
            ->where('branch_id', '=', $branch)
            ->first();

            $quantityLocal = $quantity[$i];
            $priceLocal = $price[$i];
            $voucherType = 20;
            $salePriceLocal = $product->sale_price;
            $this->inventoryPurchases(
                $product,
                $branchProducts,
                $quantityLocal,
                $priceLocal,
                $branch,
                $salePriceLocal);//trait para actualizar inventario
            $this->kardexCreate($product, $branch, $voucherType, $document, $quantityLocal, $typeDocument);//trait crear Kardex
        }
        //variables necesarias

        if ($totalpay > 0) {
            Pays($request, $document, $typeDocument);
        }

        $typeDocument = $request->type_document;
        session()->forget('expense');
        session()->forget('typeDocument');
        session(['expense' => $expense->id]);
        session(['typeDocument' => $typeDocument]);
        toast('Gasto Registrad0 satisfactoriamente.','success');
        return redirect('indexExpense');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        $voucher = VoucherType::findOrFail(20);

        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->where('quantity', '>', 0)->get();
        return view('admin.expense.show', compact(
            'expense',
            'expenseProducts'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $providers = Provider::get();
        $paymentForms = PaymentForm::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        $cards = Card::get();
        $branchs = Branch::get();
        $advances = Advance::where('status', '!=', 'aplicado')->get();
        $products = Product::where('status', 'active')->where('type_product', 'service')->get();
        $expenseProducts = ExpenseProduct::from('expense_products as pp')
        ->join('products as pro', 'pp.product_id', 'pro.id')
        ->select('pp.id', 'pro.id as idP', 'pro.name', 'pro.stock', 'pp.quantity', 'pp.price', 'pp.tax_rate', 'pp.subtotal')
        ->where('expense_id', $expense->id)
        ->get();
        $payExpenses = Pay::where('type', 'expense')->where('payable_id', $expense->id)->sum('pay');
        return view('admin.expense.edit',
        compact(
            'expense',
            'providers',
            'paymentForms',
            'paymentMethods',
            'banks',
            'cards',
            'branchs',
            'advances',
            'products',
            'expenseProducts',
            'payExpenses'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpenseRequest  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        //llamado de todos los pagos y pago nuevo para la diferencia
        $payOld = Pay::where('type', 'expense')->where('payable_id', $expense->id)->sum('pay');
        $indicator = Indicator::findOrFail(1);
        $date1 = Carbon::now()->toDateString();
        $date2 = Expense::find($expense->id)->created_at->toDateString();
        $typeDocument = 'expense';

        //Variables del request expense
        $product_id = $request->product_id;
        $quantity   = $request->quantity;
        $price      = $request->price;
        $total = $request->total;
        $reverse = $request->reverse;

        //gran total de la compra
        $totalold = $expense->total;
        $advancePay = $expense->pay - $total;
        $document = $expense;
        $documentOrigin = $expense;

        if ($advancePay > 0) {
            $this->reverse($reverse, $advancePay, $indicator, $documentOrigin, $typeDocument, $document, $date1, $date2);

            $expense->balance = 0;
            $expense->pay = $total;
            $expense->update();
        }

        //Actualizando un registro de compras

        $expense->provider_id = $request->provider_id;
        $expense->total = $request->total;
        $expense->total_tax = 0;
        $expense->total_pay = $total;
        $expense->update();

        if ($indicator->pos == 'on') {
            //actualizar la caja
            if ($date1 == $date2) {
                cashRegisterComprobation()->expense -= $totalold;
                cashRegisterComprobation()->expense += $total;
                cashRegisterComprobation()->update();
            }
        }

        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->get();
        foreach ($expenseProducts as $key => $expenseProduct) {
            //selecciona el producto que viene del array
            $quantityActual = $expenseProduct->qiantity;

            //$product = Product::findOrFail($id);
            if ($indicator->inventory == 'on') {
                $products = Product::where('id', $expenseProduct->product_id)->first();
                $products->stock -= $quantityActual;
                $products->update();

                //selecciona el producto de la sucursal que sea el mismo del array
                $branchProducts = BranchProduct::where('product_id', '=', $expenseProduct->product_id)
                ->where('branch_id',  current_user()->branch_id)
                ->first();

                $branchProducts->stock -= $quantityActual;
                $branchProducts->update();
            }

            //Actualiza la tabla del Kardex
            $kardex = Kardex::where('voucher_type_id', $expense->voucher_type_id)->where('document', $expense->document)->first();
            $kardex->quantity -= $quantityActual;
            $kardex->stock -= $quantityActual;
            $kardex->save();

            $expenseProduct->quantity = 0;
            $expenseProduct->price = 0;
            $expenseProduct->tax_rate = 0;
            $expenseProduct->subtotal = 0;
            $expenseProduct->tax_subtotal = 0;
            $expenseProduct->update();

        }

        //Toma el Request del array
        //Ingresa los productos que vienen en el array
        for ($i=0; $i < count($product_id); $i++) {

            $expenseProduct = ExpenseProduct::where('expense_id', $expense->id)
            ->where('product_id', $product_id[$i])->first();

            $subtotal = $quantity[$i] * $price[$i];
            if (is_null($expenseProduct)) {
                $expenseProduct = new ExpenseProduct();
                $expenseProduct->expense_id = $expense->id;
                $expenseProduct->product_id = $product_id[$i];
                $expenseProduct->quantity = $quantity[$i];
                $expenseProduct->price = $price[$i];
                $expenseProduct->tax_rate = 0;
                $expenseProduct->subtotal = $subtotal;
                $expenseProduct->tax_subtotal = 0;
                $expenseProduct->save();
            } else {
                if ($quantity[$i] > 0) {
                    $expenseProduct->quantity = $quantity[$i];
                    $expenseProduct->price = $price[$i];
                    $expenseProduct->tax_rate = 0;
                    $expenseProduct->subtotal = $subtotal;
                    $expenseProduct->tax_subtotal = 0;
                    $expenseProduct->update();
                }
            }
        }
        if ($advancePay > 0) {
            Alert::success('Gasto','Editado Satisfactoriamente. Con creacion de anticipo de Proveedor oingreso de efectivo a caja');
            return redirect('expense');

        } else {
            return redirect("expense")->with('success', 'Compra Editada Satisfactoriamente');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }

    public function expensePay($id)
    {
        $cashRegister = cashRegisterComprobation();
        if ($cashRegister == null) {
            return redirect('branch');
        }
        $document = Expense::findOrFail($id);
        $banks = Bank::get();
        $paymentMethods = PaymentMethod::get();
        $cards = Card::get();
        $advances = Advance::where('status', '!=', 'applied')->where('advanceable_id', $document->third->id)->get();
        $tipeDocument = 'Gasto';

        return view('admin.pay.create', compact(
            'document',
            'banks',
            'paymentMethods',
            'cards',
            'advances',
            'tipeDocument'
        ));
    }
    /*
    public function expensePdf(Request $request, $id)
   {
        $expense = Expense::findOrFail($id);
        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $indicator = Indicator::findOrFail(1);
        $expensepdf = "COMP-". $expense->document;
        $logo = './imagenes/logos'.$company->logo;

        $view = \view('admin.expense.pdf', compact(
            'expense',
            'expenseProducts',
            'indicator',
            'company',
            'logo'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$expensepdf.pdf");
   }*/
   /*
   public function pdfExpense(Request $request)
   {
        $expenses = session('expense');
        $expense = Expense::findOrFail($expenses);
        $indicator = Indicator::findOrFail(1);
        session()->forget('expense');
        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->where('quantity', '>', 0)->get();
        $company = Company::findOrFail(1);
        $expensepdf = "COMP-". $expense->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.expense.pdf', compact(
            'expense',
            'expenseProducts',
            'company',
            'indicator',
            'logo'
        ));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        //$pdf->setPaper ( 'A7' , 'landscape' );

        return $pdf->stream('vista-pdf', "$expensepdf.pdf");
   }*/
   /*
   public function expensePos($id)
   {
        $expense = Expense::where('id', $id)->first();
        $expenseProducts = ExpenseProduct::where('expense_id', $id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $expensepdf = "FACT-". $expense->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.expense.pos', compact(
            'expense',
            'expenseProducts',
            'company',
            'indicator',
            'logo'
        ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,297.64,1246.53), 'portrait');

        return $pdf->stream('vista-pdf', "$expensepdf.pdf");
   }*/
   /*
   public function posExpense(Request $request)
   {
        $expenses = session('expense');
        $expense = Expense::findOrFail($expenses);
        session()->forget('expense');
        $expenseProducts = ExpenseProduct::where('expense_id', $expense->id)->where('quantity', '>', 0)->get();
        $company = Company::where('id', 1)->first();
        $indicator = Indicator::findOrFail(1);
        $expensepdf = "FACT-". $expense->document;
        $logo = './imagenes/logos'.$company->logo;
        $view = \view('admin.expense.pos', compact(
            'expense',
            'expenseProducts',
            'company',
            'indicator',
            'logo'
            ))->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper (array(0,0,297.64,1246.53), 'portrait');

        return $pdf->stream('vista-pdf', "$expensepdf.pdf");
   }*/

   public function posPdfExpense(Request $request, Expense $expense)
    {
        $document = $expense;
        $typeDocument = 'expense';
        $title = 'COMPROBANTE DE GASTO';
        $consecutive = $document->document;

        $thirdPartyType = 'provider';
        $logoHeight = 26;

        if (indicator()->logo == 'on') {
            $logo = storage_path('app/public/images/logos/' . company()->imageName);

            $image = list($width, $height, $type, $attr) = getimagesize($logo);
            $multiplier = $image[0]/$image[1];
            $height = 26;
            $width = $height * $multiplier;
            if ($width > 60) {
                $width = 60;
                $height = 60/$multiplier;
            }
        }

        $pdfHeight = ticketHeight($logoHeight, company(), $expense, $typeDocument);

        $pdf = new Ticket('P', 'mm', array(70, $pdfHeight), true, 'UTF-8');
        $pdf->SetMargins(2, 10, 6);
        $pdf->SetTitle($expense->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();



        if (indicator()->logo == 'on') {
            if (file_exists($logo)) {
                $pdf->generateLogo($logo, $width, $height);
            }
        }
        $pdf->generateTitle($title, $consecutive);
        $pdf->generateCompanyInformation();

        $barcodeGenerator = new BarcodeGeneratorPNG();
        $barcodeCode = $barcodeGenerator->getBarcode($expense->id, $barcodeGenerator::TYPE_CODE_128);
        $barcode = "data:image/png;base64," . base64_encode($barcodeCode);

        $pdf->generateBarcode($barcode);
        $pdf->generateBranchInformation($document);
        $pdf->generateThirdPartyInformation($expense->third, $thirdPartyType);
        $pdf->generateProductsTable($document, $typeDocument);
        $pdf->generateSummaryInformation($document, $typeDocument);


        $refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        $pdf->generateDisclaimerInformation($refund);

        $pdf->footer();

        $pdf->Output("I", $expense->document . ".pdf", true);
        exit;
    }

    public function pdfExpense(Request $request, Expense $expense)
    {
        $document = $expense;
        $typeDocument = 'expense';
        $title = 'COMPROBANTE DE GASTO';
        
        $thirdPartyType = 'provider';
        $logoHeight = 26;
        $logo = '';
        $width = 0;
        $height = 0;
        if (indicator()->logo == 'on') {
            $logo = storage_path('app/public/images/logos/' . company()->imageName);

            $image = list($width, $height, $type, $attr) = getimagesize($logo);
            $multiplier = $image[0] / $image[1];
            $height = 26;
            $width = $height * $multiplier;
            if ($width > 60) {
                $width = 60;
                $height = 60 / $multiplier;
            }
        }
        
        //$pdfHeight = ticketHeight($logoHeight, company(), $invoice, "invoice");

        $pdf = new PdfDocuments('P', 'mm', 'Letter', true, 'UTF-8');
        $pdf->SetMargins(10, 10, 6);
        $pdf->SetTitle($document->document);
        $pdf->SetAutoPageBreak(false);
        $pdf->addPage();
        
        //$pdf->generateInvoiceInformation($document);
        $cufe =  '00';
        $url = '#';
        $data = [
            'NumFac' => $document->document,
            'FecFac' => $document->created_at->format('Y-m-d'),
            'NitFac' => company()->nit,
            'DocAdq' => $document->third->identification,
            'ValFac' => $document->total,
            'ValIva' => $document->total_tax,
            'ValOtroIm' => '0.00',
            'ValTotal' => $document->total_pay,
            'CUFE' => $cufe,
            //'URL' => $url . $cufe,
        ];
        
        $writer = new PngWriter();
        $qrCode = new QrCode(implode("\n", $data));
        $qrCode->setSize(300);
        $qrCode->setMargin(10);
        $result = $writer->write($qrCode);

        $qrCodeImage = $result->getString();
        $qrImage = "data:image/png;base64," . base64_encode($qrCodeImage);
        //$pdf->generateQr($qrImage);
        
        
        $pdf->generateHeaderOrders($logo, $width, $height, $title, $document);
        $pdf->generateInformation($document->third, $thirdPartyType, $document, $qrImage);
        $pdf->generateTablePdf($document, $typeDocument);
        $pdf->generateTotals($document, $typeDocument);
        

        $pdf->footer($document, $cufe);
        $pdf->documentInformation($document, $cufe);
        $pdf->footer();
        //$pdf->generateHeader($logo, $width, $height);
        //$refund = formatText("*** Para realizar un reclamo o devolución debe de presentar este ticket ***");
        //$pdf->generateDisclaimerInformation($refund);

        $pdf->Output("I", $document->document . ".pdf", true);
        exit;
    }

   //Metodo para obtener el municipio de acuerdo al departamento
   public function getMunicipalities(Request $request, $id)
   {
       if($request)
       {
           $municipalities = Municipality::where('department_id', '=', $id)->get();

           return response()->json($municipalities);
       }
   }
}
