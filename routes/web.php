<?php

use App\Http\Controllers\AdvanceController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BranchProductController;
use App\Http\Controllers\BranchRawmaterialController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CashInflowController;
use App\Http\Controllers\CashOutflowController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChargeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyTaxController;
use App\Http\Controllers\ContratTypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DiscrepancyController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeSubtypeController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IdentificationTypeController;
use App\Http\Controllers\IndicatorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceOrderController;
use App\Http\Controllers\InvoiceOrderProductController;
use App\Http\Controllers\InvoiceResponseController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\LiabilityController;
use App\Http\Controllers\MeasureUnitController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\NcinvoiceController;
use App\Http\Controllers\NcinvoiceResponseController;
use App\Http\Controllers\NcpurchaseController;
use App\Http\Controllers\NdinvoiceController;
use App\Http\Controllers\NdinvoiceResponseController;
use App\Http\Controllers\NdpurchaseController;
use App\Http\Controllers\NsdResponseController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\OvertimeTypeController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentFormController;
use App\Http\Controllers\PaymentFrecuencyController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentReturnController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PercentageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\ProductBranchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductRestaurantOrderController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderProductController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\RegimeController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ResolutionController;
use App\Http\Controllers\RestaurantOrderController;
use App\Http\Controllers\RestaurantTableController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SupportDocumentResponseController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\TaxTypeController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationCodeController;
use App\Http\Controllers\VoucherTypeController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('advance', AdvanceController::class);
Route::resource('bank', BankController::class);
Route::resource('branch', BranchController::class);
Route::resource('branchProduct', BranchProductController::class);
Route::resource('branchRawmaterial', BranchRawmaterialController::class);
Route::resource('card', CardController::class);
Route::resource('cashInflow', CashInflowController::class);
Route::resource('cashOutflow', CashOutflowController::class);
Route::resource('cashRegister', CashRegisterController::class);
Route::resource('category', CategoryController::class);
Route::resource('charge', ChargeController::class);
Route::resource('company', CompanyController::class);
Route::resource('companyTax', CompanyTaxController::class);
Route::resource('contratType', ContratTypeController::class);
Route::resource('customer', CustomerController::class);
Route::resource('dashboardGraphic', DashboardController::class);
Route::resource('department', DepartmentController::class);
Route::resource('discrepancy', DiscrepancyController::class);
Route::resource('documentType', DocumentTypeController::class);
Route::resource('employee', EmployeeController::class);
Route::resource('employeeSubtype', EmployeeSubtypeController::class);
Route::resource('employeeType', EmployeeTypeController::class);
Route::resource('environment', EnvironmentController::class);
Route::resource('expense', ExpenseController::class);
Route::resource('kardex', KardexController::class);
Route::resource('identificationType', IdentificationTypeController::class);
Route::resource('indicator', IndicatorController::class);
Route::resource('invoice', InvoiceController::class);
Route::resource('invoiceOrder', InvoiceOrderController::class);
Route::resource('invoiceOrderProduct', InvoiceOrderProductController::class);
Route::resource('invoiceResponse', InvoiceResponseController::class);
Route::resource('liability', LiabilityController::class);
Route::resource('measureUnit', MeasureUnitController::class);
Route::resource('municipality', MunicipalityController::class);
Route::resource('ncinvoice', NcinvoiceController::class);
Route::resource('ncinvoiceResponse', NcinvoiceResponseController::class);
Route::resource('ncpurchase', NcpurchaseController::class);
Route::resource('ndinvoice', NdinvoiceController::class);
Route::resource('ndinvoiceResponse', NdinvoiceResponseController::class);
Route::resource('ndpurchase', NdpurchaseController::class);
Route::resource('nsdResponse', NsdResponseController::class);
Route::resource('organization', OrganizationController::class);
Route::resource('overtime', OvertimeController::class);
Route::resource('overtimeType', OvertimeTypeController::class);
Route::resource('pay', PayController::class);
Route::resource('payment', PaymentController::class);
Route::resource('paymentForm', PaymentFormController::class);
Route::resource('paymentFrecuency', PaymentFrecuencyController::class);
Route::resource('paymentMethod', PaymentMethodController::class);
Route::resource('paymentReturn', PaymentReturnController::class);
Route::resource('payroll', PayrollController::class);
Route::resource('percentage', PercentageController::class);
Route::resource('permission', PermissionController::class);
Route::resource('postalCode', PostalCodeController::class);
Route::resource('purchaseOrder', PurchaseOrderController::class);
Route::resource('purchaseOrderProduct', PurchaseOrderProductController::class);
Route::resource('product', ProductController::class);
Route::resource('productBranch', ProductBranchController::class);
Route::resource('productRestaurantOrder', ProductRestaurantOrderController::class);
Route::resource('provider', ProviderController::class);
Route::resource('purchase', PurchaseController::class);
Route::resource('rawMaterial', RawMaterialController::class);
Route::resource('regime', RegimeController::class);
Route::resource('resolution', ResolutionController::class);
Route::resource('restaurantOrder', RestaurantOrderController::class);
Route::resource('restaurantTable', RestaurantTableController::class);
Route::resource('roles', RolController::class);
Route::resource('supportDocumentResponse', SupportDocumentResponseController::class);
Route::resource('tax', TaxController::class);
Route::resource('taxType', TaxTypeController::class);
Route::resource('transfer', TransferController::class);
Route::resource('user', UserController::class);
Route::resource('verificationCode', VerificationCodeController::class);
Route::resource('voucherType', VoucherTypeController::class);


Route::get('advance/advancePdf/{id}', [AdvanceController::class, 'advancePdf'])->name('advancePdf');

Route::get('branch/create/{id}', [BranchController::class, 'getMunicipalities']);
Route::post('branch/logout', [BranchController::class, 'logout'])->name('logout_branch');
Route::get('branch/transfer/{id}', [BranchController::class, 'transfer'])->name('show_transfer');
Route::get('branch/product/{id}', [BranchController::class, 'product'])->name('show_product');

Route::get('cashRegister/show_cashOutflow/{id}', [CashRegisterController::class, 'show_cashOutflow'])->name('show_cashOutflow');
Route::get('cashRegister/show_cashInflow/{id}', [CashRegisterController::class, 'show_cashInflow'])->name('show_cashInflow');
Route::get('cashRegister/cashRegisterPos/{id}', [CashRegisterController::class, 'cashRegisterPos'])->name('cashRegisterPos');
Route::get('cashRegister/casRegisterClose/{id}', [CashRegisterController::class, 'cashRegisterClose'])->name('cashRegisterClose');

Route::get('category/status/{id}', [CategoryController::class, 'status'])->name('categoryStatus');
Route::get('categoryInactive', [CategoryController::class, 'inactive'])->name('categoryInactive');
Route::get('categoryImport', [CategoryController::class, 'createImport'])->name('categoryImport');
Route::post('storeCategory', [CategoryController::class, 'storeCategory'])->name('storeCategory');

Route::get('company/create/{id}', [CompanyController::class, 'getMunicipalities']);
Route::post('company/logout', [CompanyController::class, 'logout'])->name('logout_company');
Route::get('company/status/{id}', [CompanyController::class, 'status'])->name('companyStatus');

Route::get('customer/status/{id}', [CustomerController::class, 'status'])->name('customerStatus');
Route::get('customer/create/{id}', [CustomerController::class, 'getMunicipalities']);
Route::get('cuatomer/customerPay/{id}', [CustomerController::class, 'customerPay'])->name('customerPay');

Route::get('employee/status/{id}', [EmployeeController::class, 'status'])->name('employeeStatus');
Route::get('employee/create/{id}', [EmployeeController::class, 'getMunicipalities']);

Route::get('expense/create/{id}', [ExpenseController::class, 'getMunicipalities']);
Route::get('expense/expensePay/{id}', [ExpenseController::class, 'expensePay'])->name('expensePay');
Route::get('expense/expensePdf/{id}', [ExpenseController::class, 'expensePdf'])->name('expensePdf');
Route::get('expense/expensePos/{id}', [ExpenseController::class, 'expensePos'])->name('expensePos');
Route::get('pdfExpense', [ExpenseController::class, 'pdfExpense'])->name('pdfExpense');
Route::get('posExpense', [ExpenseController::class, 'posExpense'])->name('posExpense');

Route::get('indicator/dianStatus/{id}', [IndicatorController::class, 'dianStatus'])->name('dianStatus');
Route::get('indicator/posStatus/{id}', [IndicatorController::class, 'posStatus'])->name('posStatus');
Route::get('indicator/logoStatus/{id}', [IndicatorController::class, 'logoStatus'])->name('logoStatus');
Route::get('indicator/payrollStatus/{id}', [IndicatorController::class, 'payrollStatus'])->name('payrollStatus');
Route::get('indicator/accountingStatus/{id}', [IndicatorController::class, 'accountingStatus'])->name('accountingStatus');
Route::get('indicator/inventoryStatus/{id}', [IndicatorController::class, 'inventoryStatus'])->name('inventoryStatus');
Route::get('indicator/productPrice/{id}', [IndicatorController::class, 'productPrice'])->name('productPrice');
Route::get('indicator/materialStatus/{id}', [IndicatorController::class, 'materialStatus'])->name('materialStatus');
Route::get('indicator/restaurantStatus/{id}', [IndicatorController::class, 'restaurantStatus'])->name('restaurantStatus');
Route::get('indicator/barcodeStatus/{id}', [IndicatorController::class, 'barcodeStatus'])->name('barcodeStatus');

Route::get('invoice/create/{id}', [InvoiceController::class, 'getMunicipalities']);
Route::get('getProductInvoice', [InvoiceController::class, 'getProductInvoice'])->name('getProductInvoice');
Route::get('invoice/InvoicePay/{id}', [InvoiceController::class, 'invoicePay'])->name('invoicePay');
Route::get('invoice/InvoicePdf/{id}', [InvoiceController::class, 'invoicePdf'])->name('invoicePdf');
Route::get('invoice/InvoicePos/{id}', [InvoiceController::class, 'invoicePos'])->name('invoicePos');
Route::get('invoice/creditNoteInvoice/{id}', [InvoiceController::class, 'creditNote'])->name('creditNoteInvoice');
Route::get('invoice/debitNoteInvoice/{id}', [InvoiceController::class, 'debitNote'])->name('debitNoteInvoice');
Route::get('pdfInvoice', [InvoiceController::class, 'pdfInvoice'])->name('pdfInvoice');
Route::get('posInvoice', [InvoiceController::class, 'posInvoice'])->name('posInvoice');

Route::get('invoiceOrder/invoice/{id}', [InvoiceOrderController::class, 'invoice'])->name('invoiceOrderInvoice');
Route::get('invoiceOrder/pdf/{id}', [InvoiceOrderController::class, 'invoiceOrderPdf'])->name('invoiceOrderPdf');
Route::get('invoiceOrder/pos/{id}', [InvoiceOrderController::class, 'invoiceOrderPos'])->name('invoiceOrderPos');
Route::get('pdfInvoiceOrder', [InvoiceOrderController::class, 'pdfInvoiceOrder'])->name('pdfInvoiceOrder');
Route::get('posInvoiceOrder', [InvoiceOrderController::class, 'posInvoiceOrder'])->name('posInvoiceOrder');

//Route::get('rawMaterial/kardexRawMaterial/{id}', [KardexController::class, 'kardexRawMaterial'])->name('kardexRawMaterial');

Route::get('ncinvoice/ncinvoicePdf/{id}', [NcinvoiceController::class, 'ncinvoicePdf'])->name('ncinvoicePdf');
Route::get('pdfNcinvoice', [NcinvoiceController::class, 'pdfNcinvoice'])->name('pdfNcinvoice');

Route::get('ncpurchase/ncpurchasePdf/{id}', [NcpurchaseController::class, 'ncpurchasePdf'])->name('ncpurchasePdf');
Route::get('pdfNcpurchase', [NcpurchaseController::class, 'pdfNcpurchase'])->name('pdfNcpurchase');

Route::get('ndinvoice/ndinvoicePdf/{id}', [NdinvoiceController::class, 'ndinvoicePdf'])->name('ndinvoicePdf');
Route::get('pdfNdinvoice', [NdinvoiceController::class, 'pdfNdinvoice'])->name('pdfNdinvoice');

Route::get('ndpurchase/ndpurchasePdf/{id}', [NdpurchaseController::class, 'ndpurchasePdf'])->name('ndpurchasePdf');
Route::get('pdfNdpurchase', [NdpurchaseController::class, 'pdfNdpurchase'])->name('pdfNdpurchase');

Route::get('pay/pdf/{id}', [PayController::class, 'payPdf'])->name('payPdf');

Route::get('payment/paymentPdf/{id}', [PaymentController::class, 'paymentPdf'])->name('paymentPdf');

Route::get('paymentMethod/status/{id}', [PaymentMethodController::class, 'status'])->name('paymentMethodStatus');

Route::get('percentage/status/{id}', [PercentageController::class, 'status'])->name('percentageStatus');

Route::get('permission/status/{id}', [PermissionController::class, 'status'])->name('permissionStatus');

Route::get('postalCode/municipality/{id}', [PostalCodeController::class, 'getMunicipalities']);

Route::get('indexMin', [ProductController::class, 'indexMin'])->name('indexMin');
Route::get('getProduct', [ProductController::class, 'getProduct'])->name('getProduct');
Route::get('product/status/{id}', [ProductController::class, 'status'])->name('productStatus');
Route::get('productImport', [ProductController::class, 'productImport'])->name('productImport');
Route::post('productStore', [ProductController::class, 'productStore'])->name('productStore');

Route::get('provider/create/{id}', [ProviderController::class, 'getMunicipalities']);
Route::get('provider/postalCode/{id}', [ProviderController::class, 'getPostalCode']);
Route::get('provider/advance/{id}', [ProviderController::class, 'advance'])->name('advanceProvider');
Route::get('provider/status/{id}', [ProviderController::class, 'status'])->name('providerStatus');
Route::get('provider/providerPay/{id}', [ProviderController::class, 'providerPay'])->name('providerPay');
Route::get('provider/expensePay/{id}', [ProviderController::class, 'expensePay'])->name('expensePay');

Route::get('getProductPurchaseOrder', [PurchaseOrderController::class, 'getProductPurchaseOrder'])->name('getProductPurchaseOrder');
Route::get('purchaseOrder/invoice/{id}', [PurchaseOrderController::class, 'invoice'])->name('purchaseOrderInvoice');
Route::get('purchaseOrder/pdf/{id}', [PurchaseOrderController::class, 'purchaseOrderPdf'])->name('purchaseOrderPdf');
Route::get('purchaseOrder/pos/{id}', [PurchaseOrderController::class, 'purchaseOrderPos'])->name('purchaseOrderPos');
Route::get('pdfPurchaseOrder', [PurchaseOrderController::class, 'pdfPurchaseOrder'])->name('pdfPurchaseOrder');
Route::get('posPurchaseOrder', [PurchaseOrderController::class, 'posPurchaseOrder'])->name('posPurchaseOrder');

Route::get('getProductPurchase', [PurchaseController::class, 'getProductPurchase'])->name('getProductPurchase');
Route::get('purchase/create/{id}', [PurchaseController::class, 'getMunicipalities']);
Route::get('purchase/purchase_pay/{id}', [PurchaseController::class, 'purchase_pay'])->name('purchase_pay');
Route::get('purchase/purchasePdf/{id}', [PurchaseController::class, 'purchasePdf'])->name('purchasePdf');
Route::get('purchase/purchasePos/{id}', [PurchaseController::class, 'purchasePos'])->name('purchasePos');
Route::get('purchase/creditNotePurchase/{id}', [PurchaseController::class, 'creditNote'])->name('creditNotePurchase');
Route::get('purchase/debitNotePurchase/{id}', [PurchaseController::class, 'debitNote'])->name('debitNotePurchase');
Route::get('pdfPurchase', [PurchaseController::class, 'pdfPurchase'])->name('pdfPurchase');
Route::get('posPurchase', [PurchaseController::class, 'posPurchase'])->name('posPurchase');
Route::get('createRawmaterial', [PurchaseController::class, 'createRawmaterial'])->name('createRawmaterial');

Route::get('rawMaterial/status/{id}', [RawMaterialController::class, 'status'])->name('rawMaterialStatus');
Route::get('rawMaterial/kardexRawMaterial/{id}', [RawMaterialController::class, 'kardexRawMaterial'])->name('kardexRawMaterial');

Route::get('reportInvoice', [ReportsController::class, 'reportInvoice'])->name('reportInvoice');
Route::get('reportPurchase', [ReportsController::class, 'reportPurchase'])->name('reportPurchase');
Route::get('reportRestaurantOrder', [ReportsController::class, 'reportRestaurantOrder'])->name('reportRestaurantOrder');
Route::get('reportInventory', [ReportsController::class, 'reportInventory'])->name('reportInventory');

Route::get('restaurantOrder/generateInvoice/{id}', [RestaurantOrderController::class, 'generateInvoice'])->name('generateInvoice');
Route::get('restaurantOrder/restaurantOrderPdf/{id}', [RestaurantOrderController::class, 'restaurantOrderPdf'])->name('restaurantOrderPdf');
Route::get('restaurantOrder/restaurantOrderPos/{id}', [RestaurantOrderController::class, 'restaurantOrderPos'])->name('restaurantOrderPos');
Route::get('posRestaurantOrder', [RestaurantOrderController::class, 'posRestaurantOrder'])->name('posRestaurantOrder');
Route::get('transfer/product/{id}', [TransferController::class, 'getProducts']);
Route::get('restaurantOrder/getRawMaterial/{id}', [RestaurantOrderController::class, 'getRawMaterial'])->name('getRawMaterial');

Route::get('user/status/{id}', [UserController::class, 'status'])->name('status');
Route::get('inactive', [UserController::class, 'inactive'])->name('inactive');
Route::patch('user/logout', [UserController::class, 'logout'])->name('logout_user');

