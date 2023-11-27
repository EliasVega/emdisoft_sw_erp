<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Bank;
use App\Models\Branch;
use App\Models\charge;
use App\Models\ContratType;
use App\Models\Department;
use App\Models\EmployeeSubtype;
use App\Models\EmployeeType;
use App\Models\IdentificationType;
use App\Models\Municipality;
use App\Models\PaymentFrecuency;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee.index|employee.create|employee.show|employee.edit|employee.destroy|employee.employeeStatus', ['only'=>['index']]);
        $this->middleware('permission:employee.create', ['only'=>['create','store']]);
        $this->middleware('permission:employee.show', ['only'=>['show']]);
        $this->middleware('permission:employee.edit', ['only'=>['edit', 'update']]);
        $this->middleware('permission:employee.destroy', ['only'=>['destroy']]);
        $this->middleware('permission:employee.employeeStatus', ['only'=>['status']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::get();

            return DataTables::of($employees)
            ->addIndexColumn()
            ->addColumn('identificationType', function (Employee $employee) {
                return $employee->identificationType->initial;
            })
            ->editColumn('created_at', function(Employee $employee){
                return $employee->created_at->format('yy-m-d');
            })

            ->addColumn('btn', 'admin/employee/actions')
            ->rawcolumns(['btn'])
            ->make(true);
        }
        return view('admin.employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $branchs = Branch::get();
        $departments = Department::get();
        $municipalities = Municipality::get();
        $identificationTypes = IdentificationType::get();
        $employeeTypes = EmployeeType::get();
        $employeeSubtypes = EmployeeSubtype::get();
        $paymentFrecuencies = PaymentFrecuency::where('id', '>', 2)->get();
        $contratTypes = ContratType::get();
        $charges = charge::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        return view('admin.employee.create', compact(
            'branchs',
            'departments',
            'municipalities',
            'identificationTypes',
            'employeeTypes',
            'employeeSubtypes',
            'paymentFrecuencies',
            'contratTypes',
            'charges',
            'paymentMethods',
            'banks'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = new Employee();
        $employee->branch_id = $request->branch_id;
        $employee->department_id = $request->department_id;
        $employee->municipality_id = $request->municipality_id;
        $employee->identification_type_id = $request->identification_type_id;
        $employee->employee_type_id = $request->employee_type_id;
        $employee->employee_subtype_id = $request->employee_subtype_id;
        $employee->payment_frecuency_id = $request->payment_frecuency_id;
        $employee->contrat_type_id = $request->contrat_type_id;
        $employee->charge_id = $request->charge_id;
        $employee->payment_method_id = $request->payment_method_id;
        $employee->bank_id = $request->bank_id;
        $employee->name = $request->name;
        $employee->identification = $request->identification;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->code = $request->code;
        $employee->salary = $request->salary;
        $employee->admission_date = $request->admission_date;
        $employee->account_type = $request->account_type;
        $employee->account_number = $request->account_number;
        $employee->status = $request->status;
        $employee->save();

        Alert::success('Empleado','Creado Satisfactoriamente.');
        return redirect("employee");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('admin.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $branchs = Branch::get();
        $departments = Department::get();
        $municipalities = Municipality::get();
        $identificationTypes = IdentificationType::get();
        $employeeTypes = EmployeeType::get();
        $employeeSubtypes = EmployeeSubtype::get();
        $paymentFrecuencies = PaymentFrecuency::get();
        $contratTypes = ContratType::get();
        $charges = charge::get();
        $paymentMethods = PaymentMethod::get();
        $banks = Bank::get();
        return view('admin.employee.edit', compact(
            'employee',
            'branchs',
            'departments',
            'municipalities',
            'identificationTypes',
            'employeeTypes',
            'employeeSubtypes',
            'paymentFrecuencies',
            'contratTypes',
            'charges',
            'paymentMethods',
            'banks'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->branch_id = $request->branch_id;
        $employee->department_id = $request->department_id;
        $employee->municipality_id = $request->municipality_id;
        $employee->identification_type_id = $request->identification_type_id;
        $employee->employee_type_id = $request->employee_type_id;
        $employee->employee_subtype_id = $request->employee_subtype_id;
        $employee->payment_frecuency_id = $request->payment_frecuency_id;
        $employee->contrat_type_id = $request->contrat_type_id;
        $employee->charge_id = $request->charge_id;
        $employee->payment_method_id = $request->payment_method_id;
        $employee->bank_id = $request->bank_id;
        $employee->name = $request->name;
        $employee->identification = $request->identification;
        $employee->address = $request->address;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->code = $request->code;
        $employee->salary = $request->salary;
        $employee->admission_date = $request->admission_date;
        $employee->account_type = $request->account_type;
        $employee->account_number = $request->account_number;
        $employee->status = $request->status;
        $employee->update();

        Alert::success('Empleado','Editado Satisfactoriamente.');
        return redirect("employee");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        toast('Empleado eliminado con éxito.','success');
        return redirect('employee');
    }

    public function status($id)
    {
        $employee = Employee::findOrFail($id);

        if ($employee->status == 'active') {
            $employee->status = 'inactive';
        } else {
            $employee->status = 'active';
        }
        $employee->update();

        return redirect('employee');
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
}
