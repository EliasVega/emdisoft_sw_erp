<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Department;
use App\Models\IdentificationType;
use App\Models\Liability;
use App\Models\Municipality;
use App\Models\Organization;
use App\Models\Regime;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer.index|customer.create|customer.show|customer.edit|customer.destroy|customer.customerStatus', ['only'=>['index']]);
        $this->middleware('permission:customer.create', ['only'=>['create','store']]);
        $this->middleware('permission:customer.show', ['only'=>['show']]);
        $this->middleware('permission:customer.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:customer.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:customer.customerStatus', ['only'=>['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customers = Customer::get();

            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('identificationType', function (Customer $customer) {
                    return $customer->identificationType->initial;
                })
                ->addColumn('department', function (Customer $customer) {
                    $departments = $customer->municipality;
                    if ($departments == null) {
                        return null;
                    } else {
                        return $customer->municipality->department->name;
                    }
                })
                ->addColumn('municipality', function (Customer $customer) {
                    $municipalities = $customer->municipality;
                    if ($municipalities == null) {
                        return null;
                    } else {
                        return $customer->municipality->name;
                    }
                })

                ->addColumn('liability', function (Customer $customer) {
                    $liabilities = $customer->liability;
                    if ($liabilities == null) {
                        return null;
                    } else {
                        return $customer->liability->name;
                    }
                })
                ->addColumn('organization', function (Customer $customer) {
                    $organizations = $customer->organization;
                    if ($organizations == null) {
                        return null;
                    } else {
                        return $customer->organization->name;
                    }
                })
                ->addColumn('regime', function (Customer $customer) {
                    $regimes = $customer->regime;
                    if ($regimes == null) {
                        return null;
                    } else {
                        return $customer->regime->name;
                    }
                })
                ->editColumn('created_at', function(Customer $customer) {
                    return $customer->created_at->format('yy-m-d');
                })

                ->addColumn('edit', 'admin/customer/actions')
                ->rawcolumns(['edit'])
                ->make(true);
        }
        return view('admin.customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $identificationTypes = IdentificationType::get();
        $liabilities = Liability::get();
        $organizations = Organization::get();
        $regimes = Regime::get();
        return view('admin.customer.create', compact(
            'departments',
            'municipalities',
            'identificationTypes',
            'liabilities',
            'organizations',
            'regimes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $liability = $request->liability_id;
        $organization = $request->organization_id;
        $regime = $request->regime_id;
        $department = $request->department_id;
        $municipality = $request->municipality_id;
        $creditLimit = $request->credit_limit;
        if ($liability == null) {
            $liability = 117;
        }
        if ($organization == null) {
            $organization = 2;
        }
        if ($regime == null) {
            $regime = 2;
        }
        if ($department == null) {
            $department = 21;
        }
        if ($municipality == null) {
            $municipality = 846;
        }
        if ($creditLimit == null) {
            $creditLimit = 0;
        }

        $customer = new Customer();
        $customer->department_id = $department;
        $customer->municipality_id = $municipality;
        $customer->identification_type_id = $request->identification_type_id;
        $customer->liability_id = $liability;
        $customer->organization_id = $organization;
        $customer->regime_id = $regime;
        $customer->name = $request->name;
        $customer->identification = $request->identification;
        $customer->dv = $request->dv;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->merchant_registration = $request->merchant_registration;
        $customer->credit_limit = $request->credit_limit;
        $customer->used = 0;
        $customer->available = $request->credit_limit;
        $customer->save();

        Alert::success('Cliente','Creado Satisfactoriamente.');
        return redirect("customer");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('admin.customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $identificationTypes = IdentificationType::get();
        $liabilities = Liability::get();
        $organizations = Organization::get();
        $regimes = Regime::get();
        return view('admin.customer.edit', compact(
            'customer',
            'departments',
            'municipalities',
            'identificationTypes',
            'liabilities',
            'organizations',
            'regimes'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->department_id = $request->department_id;
        $customer->municipality_id = $request->municipality_id;
        $customer->identification_type_id = $request->identification_type_id;
        $customer->liability_id = $request->liability_id;
        $customer->organization_id = $request->organization_id;
        $customer->regime_id = $request->regime_id;
        $customer->name = $request->name;
        $customer->identification = $request->identification;
        $customer->dv = $request->dv;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->merchant_registration = $request->merchant_registration;
        $customer->credit_limit = $request->credit_limit;
        $customer->used = 0;
        $customer->available = $request->credit_limit;
        $customer->update();

        Alert::success('Cliente','Editado Satisfactoriamente.');
        return redirect("customer");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        toast('Cliente eliminado con éxito.','success');
        return redirect('customer');
    }

    //Metodo para obtener el municipio dependeiento del departamento
    public function getMunicipalities(Request $request, $id)
    {
        if($request)
        {
            $municipalities = Municipality::where('department_id', '=', $id)->get();

            return response()->json($municipalities);
        }
    }

    public function status($id)
    {

        $customer = Customer::findOrFail($id);
        if ($customer->status == 'active') {
            $customer->status = 'inactive';
        } else {
            $customer->status = 'active';
        }
        $customer->update();

        return redirect('customer');
    }
}
