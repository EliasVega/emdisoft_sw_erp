<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Models\Bank;
use App\Models\Card;
use App\Models\Department;
use App\Models\IdentificationType;
use App\Models\Liability;
use App\Models\Municipality;
use App\Models\Organization;
use App\Models\PaymentMethod;
use App\Models\PostalCode;
use App\Models\Regime;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class ProviderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:provider.index|provider.create|provider.show|provider.edit|provider.destroy|provider.providerStatus', ['only'=>['index']]);
        $this->middleware('permission:provider.create', ['only'=>['create','store']]);
        $this->middleware('permission:provider.show', ['only'=>['show']]);
        $this->middleware('permission:provider.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:provider.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:provider.providerStatus', ['only'=>['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $providers = Provider::get();

            return DataTables::of($providers)
            ->addIndexColumn()
            ->addColumn('identificationType', function (Provider $provider) {
                return $provider->identificationType->initial;
            })
            ->addColumn('department', function (Provider $provider) {
                $departments = $provider->municipality;
                if ($departments == null) {
                    return null;
                } else {
                    return $provider->municipality->department->name;
                }
            })
            ->addColumn('municipality', function (Provider $provider) {
                $municipalities = $provider->municipality;
                if ($municipalities == null) {
                    return null;
                } else {
                    return $provider->municipality->name;
                }
            })
            ->addColumn('postal_code', function (Provider $provider) {
                $postalCode = $provider->postalCode;
                if ($postalCode == null) {
                    return null;
                } else {
                    return $provider->postalCode->postal_code;
                }
            })

            ->addColumn('liability', function (Provider $provider) {
                $liabilities = $provider->liability;
                if ($liabilities == null) {
                    return null;
                } else {
                    return $provider->liability->name;
                }
            })
            ->addColumn('organization', function (Provider $provider) {
                $organizations = $provider->organization;
                if ($organizations == null) {
                    return null;
                } else {
                    return $provider->organization->name;
                }
            })
            ->addColumn('regime', function (Provider $provider) {
                $regimes = $provider->regime;
                if ($regimes == null) {
                    return null;
                } else {
                    return $provider->regime->name;
                }
            })
            ->editColumn('created_at', function(Provider $provider) {
                return $provider->created_at->format('Y-m-d');
            })

            ->addColumn('edit', 'admin/provider/actions')
            ->rawcolumns(['edit'])
            ->make(true);
        }
        return view('admin.provider.index');

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
        $postalCodes = PostalCode::get();
        return view('admin.provider.create', compact(
            'departments',
            'municipalities',
            'identificationTypes',
            'liabilities',
            'organizations',
            'regimes',
            'postalCodes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProviderRequest $request)
    {

        $provider = new Provider();
        $provider->department_id = $request->department_id;
        $provider->municipality_id = $request->municipality_id;
        $provider->identification_type_id = $request->identification_type_id;
        $provider->liability_id = $request->liability_id;
        $provider->organization_id = $request->organization_id;
        $provider->regime_id = $request->regime_id;
        $provider->postal_code_id = $request->postal_code_id;
        $provider->name = $request->name;
        $provider->identification = $request->identification;
        $provider->dv = $request->dv;
        $provider->address = $request->address;
        $provider->phone = $request->phone;
        $provider->email = $request->email;
        $provider->merchant_registration = $request->merchant_registration;
        $provider->contact = $request->contact;
        $provider->phone_contact = $request->phone_contact;
        $provider->save();
        Alert::success('Proveedor','Creado Satisfactoriamente.');
        return redirect('provider');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return view('admin.provider.show', compact('provider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $departments = Department::get();
        $municipalities = Municipality::get();
        $identificationTypes = IdentificationType::get();
        $liabilities = Liability::get();
        $organizations = Organization::get();
        $regimes = Regime::get();
        $postalCodes = PostalCode::get();
        return view('admin.provider.edit', compact(
            'provider',
            'departments',
            'municipalities',
            'identificationTypes',
            'liabilities',
            'organizations',
            'regimes',
            'postalCodes'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProviderRequest  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider->department_id = $request->department_id;
        $provider->municipality_id = $request->municipality_id;
        $provider->identification_type_id = $request->identification_type_id;
        $provider->liability_id = $request->liability_id;
        $provider->organization_id = $request->organization_id;
        $provider->regime_id = $request->regime_id;
        $provider->postal_code_id = $request->postal_code_id;
        $provider->name = $request->name;
        $provider->identification = $request->identification;
        $provider->dv = $request->dv;
        $provider->address = $request->address;
        $provider->phone = $request->phone;
        $provider->email = $request->email;
        $provider->merchant_registration = $request->merchant_registration;
        $provider->contact = $request->contact;
        $provider->phone_contact = $request->phone_contact;
        $provider->update();

        Alert::success('Proveedor','Editado con exito.');
        return redirect('provider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        toast('Proveedor eliminado con éxito.','success');
        return redirect('provider');
    }

    //Metodo para obtener el municipio dependiendo del departamento
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

        $provider = Provider::findOrFail($id);
        if ($provider->status == 'active') {
            $provider->status = 'inactive';
        } else {
            $provider->status = 'active';
        }
        $provider->update();

        return redirect('provider');
    }

    //Methodo para realizar un anticipo de proveedores
    public function advance($id)
    {
        $provider = Provider::findOrFail($id);
        \Session()->put('provider', $provider->id, 60 * 24 * 365);
        \Session()->put('name', $provider->name, 60 * 24 * 365);

        $banks = Bank::get();
        $paymentMethods = PaymentMethod::where('status', 'active')->get();
        $cards = Card::get();
        $providers = Provider::findOrFail($id);

        return view('admin.advance.create', compact(
            'providers',
            'banks',
            'paymentMethods',
            'cards'
        ));
    }

    //Metodo para obtener el codigo postal dependeiento del municipio
    public function getPostalCode(Request $request, $id)
    {
        if($request)
        {
            $postalCodes = PostalCode::where('municipality_id', '=', $id)->get();

            return response()->json($postalCodes);
        }
    }
}
