<?php

namespace App\Http\Controllers;

use App\Models\Puc;
use App\Http\Requests\StorePucRequest;
use App\Http\Requests\UpdatePucRequest;
use App\Models\Account;
use App\Models\AccountClass;
use App\Models\AccountGroup;
use App\Models\AuxiliaryAccount;
use App\Models\Bank;
use App\Models\Category;
use App\Models\CompanyTax;
use App\Models\PaymentMethod;
use App\Models\Subaccount;
use App\Models\Trigger;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PucController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pucs = Puc::get();

            return DataTables::of($pucs)
            ->addIndexColumn()
            ->addColumn('account_code', function (Puc $puc) {
                return $puc->accountable->code;
            })
            ->addColumn('account_name', function (Puc $puc) {
                return $puc->accountable->name;
            })
            ->addColumn('trigger', function (Puc $puc) {
                if ($puc->trigger == 'payment_method') {
                    return 'Método de pago';
                } elseif ($puc->trigger == 'category') {
                    if ($puc->movement == 'inventory') {
                        return 'Categoría - Inventarios';
                    } elseif ($puc->movement == 'cost') {
                        return 'Categoría - Costos de venta';
                    } elseif ($puc->movement == 'refund') {
                        return 'Categoría - Devoluciones';
                    } elseif ($puc->movement == 'entry') {
                        return 'Categoría - Ingresos';
                    }
                } elseif ($puc->trigger == 'companyTax') {
                    return 'Impuestos';
                } elseif ($puc->trigger == 'expense') {
                    return 'Cuentas por pagar';
                } elseif ($puc->trigger == 'income') {
                    return 'Cuentas por cobrar';
                } elseif ($puc->trigger == 'discount') {
                    return 'Descuentos';
                } elseif ($puc->trigger == 'advance') {
                    return 'Anticipos';
                } elseif ($puc->trigger == 'other') {
                    return 'Otros';
                }
            })
            ->addColumn('type', function (Puc $puc) {
                if ($puc->type == 'multiple') {
                    return 'Multiple';
                } elseif ($puc->type == 'purchases') {
                    return 'Compras';
                } elseif ($puc->type == 'sales') {
                    return 'Ventas';
                }
            })
            ->addColumn('bank', function (Puc $puc) {
                return $puc->bank != null ? $puc->bank->name : 'No aplica';
            })
            ->addColumn('bank_account', function (Puc $puc) {
                return $puc->bank_account != null ? $puc->bank_account : 'No aplica';
            })
            ->addColumn('actions', 'admin/puc/actions')
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('admin.puc.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $accountClasses = AccountClass::all();
        $accountGroups = AccountGroup::all();
        $accounts = Account::all();
        $subaccounts = Subaccount::all();
        $paymentMethods = PaymentMethod::get();
        $categories = Category::get();
        $companyTaxes = CompanyTax::get();
        $banks = Bank::get();

        return view('admin.puc.create', compact(
            'accountClasses',
            'accountGroups',
            'accounts',
            'subaccounts',
            'paymentMethods',
            'categories',
            'companyTaxes',
            'banks'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePucRequest $request)
    {
        $action = $request->get('action');
        $accountId = $request->get('account_id');
        $accountType = $request->get('account_type');

        if ($accountType == 'Subcuenta') {
            $account = SubAccount::findOrFail($accountId);
        } elseif ($accountType == 'Cuenta auxiliar') {
            $account = AuxiliaryAccount::findOrFail($accountId);
        } elseif ($accountType == 'Cuenta') {
            $account = Account::findOrFail($accountId);
        }

        if ($action == 'delete') {
            if (($account->puc ?? '') != null) {
                $account->puc()->delete();
            }
            $account->delete();

            return redirect()->route('pucs.create')->with('success_message', $accountType.' eliminada con éxito.');
        } elseif ($action == 'enable') {
            $puc = new Puc();
            $puc->trigger = $request->get('trigger');
            if ($request->get('trigger') == 'payment_method') {
                $puc->bank_account = $request->get('bank_account');
                $puc->bank_id = $request->get('bank_id');
            } elseif ($request->get('trigger') == 'percentage') {
                $puc->type = $request->get('type');
            } elseif ($request->get('trigger') == 'category') {
                $puc->movement = $request->get('movement');
            } elseif ($request->get('trigger') == 'advance') {
                $puc->type = $request->get('type');
            }
            $account->puc()->save($puc);

            $account->state = 'active';
            $account->update();

            $triggers = $request->get('triggers');

            if ($triggers != null) {
                foreach ($triggers as $value) {
                    if ($value != '') {
                        if ($request->get('trigger') == 'payment_method') {
                            $activator = PaymentMethod::findOrFail($value);
                            $trigger = new Trigger();
                            $trigger->puc_id = $puc->id;
                            $activator->trigger()->save($trigger);
                        } elseif ($request->get('trigger') == 'category') {
                            $activator = Category::findOrFail($value);
                            $trigger = new Trigger();
                            $trigger->puc_id = $puc->id;
                            $activator->triggers()->save($trigger);
                        } elseif ($request->get('trigger') == 'percentage') {
                            $activator = CompanyTax::findOrFail($value);
                            $trigger = new Trigger();
                            $trigger->puc_id = $puc->id;
                            $activator->triggers()->save($trigger);
                        }
                    }
                }
            }

            return redirect()->route('pucs.create')->with('success_message', $accountType.' activada con éxito.');
        } elseif ($action == 'disable') {
            $account->puc()->delete();

            $account->state = 'inactive';
            $account->update();

            return redirect()->route('pucs.create')->with('success_message', $accountType.' desactivada con éxito.');
        }
        return redirect()->route('pucs.create')->with('error_message', 'Acción no procesada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Puc $puc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Puc $puc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePucRequest $request, Puc $puc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Puc $puc)
    {
        //
    }
}
