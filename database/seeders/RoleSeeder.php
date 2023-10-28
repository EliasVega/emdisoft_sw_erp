<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'superAdmin']);
        $admin = Role::create(['name' => 'admin']);
        $operatings = Role::create(['name' => 'operatings']);
        $purchases = Role::create(['name' => 'purchases']);
        $sales = Role::create(['name' => 'sales']);

        Permission::create(['name' => 'superAdmin', 'description' => 'derechos solo superadministrador', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'advance.index', 'description' => 'Listado de Anticipo clientes', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $sales]);
        Permission::create(['name' => 'advance.create', 'description' => 'Crear anticipo clientes', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $sales]);
        Permission::create(['name' => 'advance.show', 'description' => 'Ver anticipo clientes', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $sales]);

        Permission::create(['name' => 'bank.index', 'description' => 'Listado de bancos', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'bank.create', 'description' => 'Crear banco', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'bank.show', 'description' => 'Ver banco', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'bank.edit', 'description' => 'Editar banco', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'bank.destroy', 'description' => 'Eliminar banco', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'branch.index', 'description' => 'Listado de sucursales', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'branch.create', 'description' => 'Crear bsucursal', 'status' => 'locked'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'branch.show', 'description' => 'Ver sucursal', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings]);
        Permission::create(['name' => 'branch.edit', 'description' => 'Editar sucursal', 'status' => 'locked'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'branch.destroy', 'description' => 'Eliminar sucursal', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'branchProduct.index', 'description' => 'Listado Productos sucursal', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'branchRawmaterial.index', 'description' => 'Listado Materias Prima sucursal', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'card.index', 'description' => 'Listado Tarjetas', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'card.create', 'description' => 'Crear Tarjetas', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'card.show', 'description' => 'Ver Tarjetas', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'card.edit', 'description' => 'Editar Tarjetas', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'card.destroy', 'description' => 'Eliminar Tarjetas', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'cashInflow.index', 'description' => 'Listado Entrada de efectivo', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashInflow.store', 'description' => 'Crear Entradas de efectivo', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'cashOutflow.index', 'description' => 'Listado Salida de efectivo', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashOutflow.store', 'description' => 'crear Salida de efectivo', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'cashRegister.index', 'description' => 'Listado Cajas', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashRegister.create', 'description' => 'Crear Caja', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashRegister.show', 'description' => 'Ver Caja', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashRegister.edit', 'description' => 'Cerrar caja', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);

        Permission::create(['name' => 'category.index', 'description' => 'Listado categorias', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'category.create', 'description' => 'Crear categoria', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'category.show', 'description' => 'Ver categoria', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'category.edit', 'description' => 'Editar categoria', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);
        Permission::create(['name' => 'category.destroy', 'description' => 'Eliminar categoria', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'category.categoryStatus', 'description' => 'Estado categoria', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'category.categoryInactive', 'description' => 'Categorias inactivas', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);

        Permission::create(['name' => 'charge.index', 'description' => 'Listado Cargos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'charge.create', 'description' => 'Crear Cargo', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'charge.show', 'description' => 'Ver Cargo', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'charge.edit', 'description' => 'Editar Cargo', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'charge.destroy', 'description' => 'Eliminar Cargo', 'status' => 'active'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'company.index', 'description' => 'Listado Compañias', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'company.create', 'description' => 'Crear Compañia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'company.show', 'description' => 'Ver Compañia', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'company.edit', 'description' => 'Editar Compañia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'company.destroy', 'description' => 'Eliminar Compañia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'company.companyStatus', 'description' => 'Estado Compañia', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'companyTax.index', 'description' => 'Listado impuestos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'companyTax.create', 'description' => 'Crear impuestos %', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'companyTax.show', 'description' => 'Ver impuestos %', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'companyTax.edit', 'description' => 'Editar impuestos %', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'companyTax.destroy', 'description' => 'Eliminar impuestos %', 'status' => 'active'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'contratType.index', 'description' => 'Listado tipo de contratos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'contratType.create', 'description' => 'Crear tipo de contrato', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'contratType.show', 'description' => 'Ver tipo de contrato', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'contratType.edit', 'description' => 'Editar tipo de contrato', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'contratType.destroy', 'description' => 'Eliminar tipo de contrato', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'customer.index', 'description' => 'Listado Clientes', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'customer.create', 'description' => 'Crear Cliente', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $sales]);
        Permission::create(['name' => 'customer.show', 'description' => 'Ver Cliente', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $sales]);
        Permission::create(['name' => 'customer.edit', 'description' => 'Editar Cliente', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $sales]);
        Permission::create(['name' => 'customer.destroy', 'description' => 'Eliminar Cliente', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'customer.customerStatus', 'description' => 'Estado cliente', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);

        Permission::create(['name' => 'dashboard.index', 'description' => 'Dashboard', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);

        Permission::create(['name' => 'department.index', 'description' => 'Listado Departamentos', 'status' => 'active'])->assignRole($superAdmin, $admin, $operatings, $purchases, $sales);
        Permission::create(['name' => 'department.create', 'description' => 'Crear Departamento', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'department.show', 'description' => 'Ver Departamento', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'department.edit', 'description' => 'Editar Departamento', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'department.destroy', 'description' => 'Eliminar Departamento', 'status' => 'locked'])->assignRole($superAdmin);

        Permission::create(['name' => 'discrepancy.index', 'description' => 'Listado discrepancias', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'discrepancy.create', 'description' => 'Crear discrepancia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'discrepancy.show', 'description' => 'Ver discrepancia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'discrepancy.edit', 'description' => 'Editar discrepancia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'discrepancy.destroy', 'description' => 'Eliminar discrepancia', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'documentType.index', 'description' => 'Listado tipo de documento', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'documentType.create', 'description' => 'Crear tipo de documento', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'documentType.show', 'description' => 'Ver tipo de documento', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'documentType.edit', 'description' => 'Editar tipo de documento', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'documentType.destroy', 'description' => 'Eliminar tipo de documento', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'employee.index', 'description' => 'Listado empleados', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);
        Permission::create(['name' => 'employee.create', 'description' => 'Crear empleado', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'employee.show', 'description' => 'Ver empleado', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'employee.edit', 'description' => 'Editar empleado', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'employee.destroy', 'description' => 'Eliminar empleado', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'employee.employeeStatus', 'description' => 'Estado Empleado', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);

        Permission::create(['name' => 'employeeSubtype.index', 'description' => 'Listado subtipo de empleados', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);
        Permission::create(['name' => 'employeeSubtype.create', 'description' => 'Crear subtipo de empleado', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'employeeSubtype.show', 'description' => 'Ver subtipo de empleado', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'employeeSubtype.edit', 'description' => 'Editar subtipo de empleado', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'employeeSubtype.destroy', 'description' => 'Eliminar subtipo de empleado', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'employeeType.index', 'description' => 'Listado tipo de empleados', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'employeeType.create', 'description' => 'Crear tipo de empleado', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'employeeType.show', 'description' => 'Ver tipo de empleado', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'employeeType.edit', 'description' => 'Editar tipo de empleado', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'employeeType.destroy', 'description' => 'Eliminar tipo de empleado', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'environment.index', 'description' => 'Listado Urls', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'environment.create', 'description' => 'Crear Url', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'environment.show', 'description' => 'Ver Url', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'environment.edit', 'description' => 'Editar Url', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'environment.destroy', 'description' => 'Eliminar Url', 'status' => 'active'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'expense.index', 'description' => 'Listado gastos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'expense.create', 'description' => 'Crear gasto', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'expense.show', 'description' => 'Ver gasto', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'expense.edit', 'description' => 'Ver gasto', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);

        Permission::create(['name' => 'identificationType.index', 'description' => 'Listado tipo de identificacion', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'identificationType.create', 'description' => 'Crear tipo de identificacion', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'identificationType.show', 'description' => 'Ver tipo de identificacion', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'identificationType.edit', 'description' => 'Editar tipo de identificacion', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'identificationType.destroy', 'description' => 'Eliminar tipo de identificacion', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'indicator.index', 'description' => 'Indicador', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'indicator.edit', 'description' => 'Editar Indicador', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.dianStatus', 'description' => 'Activa documentos electronicos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.posStatus', 'description' => 'Activar Post', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.logoStatus', 'description' => 'Activar Logo', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.payrollStatus', 'description' => 'Activar Nomina', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.accountingStatus', 'description' => 'Activar contabilidad', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.inventoryStatus', 'description' => 'Manejo inventario', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.productPrice', 'description' => 'Manejo Precio Producto', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.materialStatus', 'description' => 'activar Materias primas', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.restaurantStatus', 'description' => 'activar Restaurantes', 'status' => 'locked'])->syncRoles([$superAdmin]);


        Permission::create(['name' => 'invoice.index', 'description' => 'Listado Invoice', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'invoice.create', 'description' => 'CrearInvoice', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'invoice.show', 'description' => 'VerInvoice', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'invoice.edit', 'description' => 'EditarInvoice', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);

        Permission::create(['name' => 'invoiceResponse.index', 'description' => 'Listado respuestas fv', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'invoiceResponse.create', 'description' => 'Crear respuesta fv', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'invoiceResponse.show', 'description' => 'Ver respuesta fv', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'invoiceResponse.edit', 'description' => 'Editar respuesta fv', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'invoiceResponse.destroy', 'description' => 'Eliminar respuesta fv', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'kardex.index', 'description' => 'Listado kardex', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);
        Permission::create(['name' => 'kardex.kardexProduct', 'description' => 'Listado kardex producto', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);

        Permission::create(['name' => 'liability.index', 'description' => 'Listado responsabilidad fiscal', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'liability.create', 'description' => 'Crear responsabilidad fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'liability.show', 'description' => 'Ver responsabilidad fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'liability.edit', 'description' => 'Editar responsabilidad fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'liability.destroy', 'description' => 'Eliminar responsabilidad fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'measureUnit.index', 'description' => 'Listado unidades de medida', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'measureUnit.create', 'description' => 'Crear unidades de medida', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'measureUnit.show', 'description' => 'Ver unidades de medida', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'measureUnit.edit', 'description' => 'Editar unidades de medida', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'measureUnit.destroy', 'description' => 'Eliminar unidades de medida', 'status' => 'active'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'municipality.index', 'description' => 'Listado municipios', 'status' => 'active'])->assignRole($superAdmin, $admin, $operatings, $purchases, $sales);
        Permission::create(['name' => 'municipality.create', 'description' => 'Crear municipio', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'municipality.show', 'description' => 'Ver municipio', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'municipality.edit', 'description' => 'Editar municipio', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'municipality.destroy', 'description' => 'Eliminar municipio', 'status' => 'locked'])->assignRole($superAdmin);

        Permission::create(['name' => 'ncinvoice.index', 'description' => 'Listado NC venta', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'ncinvoice.store', 'description' => 'Crear NC venta', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'ncinvoice.show', 'description' => 'Ver NC venta', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);

        Permission::create(['name' => 'ncinvoiceResponse.index', 'description' => 'Listado respuestas NC', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'ncinvoiceResponse.create', 'description' => 'Crear respuesta NC', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'ncinvoiceResponse.show', 'description' => 'Ver respuesta NC', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'ncinvoiceResponse.edit', 'description' => 'Editar respuesta NC', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'ncinvoiceResponse.destroy', 'description' => 'Eliminar respuesta NC', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'ncpurchase.index', 'description' => 'Listado NC compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'ncpurchase.store', 'description' => 'Crear NC compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'ncpurchase.show', 'description' => 'Ver NC compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);

        Permission::create(['name' => 'ndinvoice.index', 'description' => 'Listado ND venta', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'ndinvoice.store', 'description' => 'Crear ND venta', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings,$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'ndinvoice.show', 'description' => 'Ver ND venta', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings,$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'ndinvoiceResponse.index', 'description' => 'Listado respuestas ND', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'ndinvoiceResponse.create', 'description' => 'Crear respuesta ND', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'ndinvoiceResponse.show', 'description' => 'Ver respuesta ND', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'ndinvoiceResponse.edit', 'description' => 'Editar respuesta ND', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'ndinvoiceResponse.destroy', 'description' => 'Eliminar respuesta ND', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'ndpurchase.index', 'description' => 'Listado ND compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'ndpurchase.store', 'description' => 'Crear ND compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings,$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'ndpurchase.show', 'description' => 'Ver ND compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings,$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'nsdResponse.index', 'description' => 'Listado respuestas nds', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'nsdResponse.create', 'description' => 'Crear respuesta nds', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'nsdResponse.show', 'description' => 'Ver respuesta nds', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'nsdResponse.edit', 'description' => 'Editar respuesta nds', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'nsdResponse.destroy', 'description' => 'Eliminar respuesta nds', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'organization.index', 'description' => 'Listado organizacion fiscal', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'organization.create', 'description' => 'Crear organizacion fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'organization.show', 'description' => 'Ver organizacion fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'organization.edit', 'description' => 'Editar organizacion fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'organization.destroy', 'description' => 'Eliminar organizacion fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'pay.index', 'description' => 'Listado Pago y abonos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'pay.create', 'description' => 'Crear Pago y abonos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'pay.show', 'description' => 'Ver Pago y abonos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'paymentForm.index', 'description' => 'Listado formas de pago', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'paymentForm.create', 'description' => 'Crear formas de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentForm.show', 'description' => 'Ver formas de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentForm.edit', 'description' => 'Editar formas de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentForm.destroy', 'description' => 'Eliminar formas de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'paymentFrecuency.index', 'description' => 'Listado frecuencia de pago', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'paymentFrecuency.create', 'description' => 'Crear frecuencia de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentFrecuency.show', 'description' => 'Ver frecuencia de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentFrecuency.edit', 'description' => 'Editar frecuencia de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentFrecuency.destroy', 'description' => 'Eliminar frecuencia de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'paymentMethod.index', 'description' => 'Listado metodos de pago', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'paymentMethod.create', 'description' => 'Crear metodos de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentMethod.show', 'description' => 'Ver metodos de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentMethod.edit', 'description' => 'Editar metodos de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentMethod.destroy', 'description' => 'Eliminar metodos de pago', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'paymentMethod.paymentMethodStatus', 'description' => 'Metodos de pago estado', 'status' => 'active'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'percentage.index', 'description' => 'Listado porcentages', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'percentage.create', 'description' => 'Crear porcentages', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'percentage.show', 'description' => 'Ver porcentages', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'percentage.edit', 'description' => 'Editar porcentages', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'percentage.destroy', 'description' => 'Eliminar porcentages', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'percentage.percentageStatus', 'description' => 'Activar Porcentage', 'status' => 'active'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'permission.index', 'description' => 'Listado permisos', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'permission.create', 'description' => 'Crear permisos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'permission.show', 'description' => 'Ver permisos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'permission.edit', 'description' => 'Editar permisos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'permission.destroy', 'description' => 'Eliminar permisos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'permission.permissionStatus', 'description' => 'Permiso estado', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'postalCode.index', 'description' => 'Listado codigos Postales', 'status' => 'active'])->assignRole($superAdmin, $admin, $operatings, $purchases, $sales);
        Permission::create(['name' => 'postalCode.create', 'description' => 'Crear codigo Postal', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'postalCode.show', 'description' => 'Ver codigo Postal', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'postalCode.edit', 'description' => 'Editar codigo Postal', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'postalCode.destroy', 'description' => 'Eliminar codigo Postal', 'status' => 'locked'])->assignRole($superAdmin);

        Permission::create(['name' => 'purchaseOrder.index', 'description' => 'Listado orden de compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'purchaseOrder.create', 'description' => 'Crear orden de compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'purchaseOrder.show', 'description' => 'Ver orden de compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'purchaseOrder.edit', 'description' => 'Editar orden de compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);

        Permission::create(['name' => 'purchaseOrderProduct.store', 'description' => 'Facturar orden de compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);

        Permission::create(['name' => 'productBranch.index', 'description' => 'Listado movimientos productos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'product.index', 'description' => 'Listado productos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'product.create', 'description' => 'Crear productos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'product.show', 'description' => 'Ver productos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'product.edit', 'description' => 'Editar productos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'product.destroy', 'description' => 'Eliminar productos', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'product.productStatus', 'description' => 'Estado Producto', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);

        Permission::create(['name' => 'productRestaurantOrder.create', 'description' => 'Facturar Comanda', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $sales]);

        Permission::create(['name' => 'provider.index', 'description' => 'Listado proveedores', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'provider.create', 'description' => 'Crear proveedores', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'provider.show', 'description' => 'Ver proveedores', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'provider.edit', 'description' => 'Editar proveedores', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'provider.destroy', 'description' => 'Eliminar proveedores', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'provider.providerStatus', 'description' => 'Editar estado proveedores', 'status' => 'active'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'purchase.index', 'description' => 'Listado Compras', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'purchase.create', 'description' => 'Crear compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'purchase.show', 'description' => 'Ver compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'purchase.edit', 'description' => 'Editar compra', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);

        Permission::create(['name' => 'rawMaterial.index', 'description' => 'Listado Materia Prima', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'rawMaterial.create', 'description' => 'Crear Materia Prima', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'rawMaterial.show', 'description' => 'Ver Materia Prima', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'rawMaterial.edit', 'description' => 'Editar Materia Prima', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'rawMaterial.destroy', 'description' => 'Eliminar Materia Prima', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'rawMaterial.rawMaterialStatus', 'description' => 'Estado Materia Prima', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);

        Permission::create(['name' => 'regime.index', 'description' => 'Listado regimen fiscal', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'regime.create', 'description' => 'Crear regimen fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'regime.show', 'description' => 'Ver regimen fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'regime.edit', 'description' => 'Editar regimen fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'regime.destroy', 'description' => 'Eliminar regimen fiscal', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'resolution.index', 'description' => 'Listado resoluciones', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'resolution.create', 'description' => 'Crear resolucion', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'resolution.show', 'description' => 'Ver resolucion', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'resolution.edit', 'description' => 'Editar resolucion', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'resolution.destroy', 'description' => 'Eliminar resolucion', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'restaurantOrder.index', 'description' => 'Listado comandas', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'restaurantOrder.create', 'description' => 'Crear comanda', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'restaurantOrder.show', 'description' => 'Ver comanda', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'restaurantOrder.edit', 'description' => 'Editar comanda', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'restaurantOrder.destroy', 'description' => 'Eliminar comanda', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'restaurantTable.index', 'description' => 'Listado comandas', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'restaurantTable.create', 'description' => 'Crear comanda', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings]);
        Permission::create(['name' => 'restaurantTable.show', 'description' => 'Ver comanda', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings]);
        Permission::create(['name' => 'restaurantTable.edit', 'description' => 'Editar comanda', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings]);
        Permission::create(['name' => 'restaurantTable.destroy', 'description' => 'Eliminar comanda', 'status' => 'locked'])->syncRoles([$superAdmin, $admin, $operatings]);

        Permission::create(['name' => 'rol.index', 'description' => 'Listado roles', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'rol.create', 'description' => 'Crear rol', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'rol.show', 'description' => 'Ver rol', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'rol.edit', 'description' => 'Editar rol', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'rol.destroy', 'description' => 'Eliminar rol', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'supportDocumentResponse.index', 'description' => 'Listado respuestas ds', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'supportDocumentResponse.create', 'description' => 'Crear respuesta ds', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'supportDocumentResponse.show', 'description' => 'Ver respuesta ds', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'supportDocumentResponse.edit', 'description' => 'Editar respuesta ds', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'supportDocumentResponse.destroy', 'description' => 'Eliminar respuesta ds', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'tax.index', 'description' => 'Listado impuestos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'tax.create', 'description' => 'Crear impuestos %', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'tax.show', 'description' => 'Ver impuestos %', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'tax.edit', 'description' => 'Editar impuestos %', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'tax.destroy', 'description' => 'Eliminar impuestos %', 'status' => 'active'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'taxType.index', 'description' => 'Listado impuestos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'taxType.create', 'description' => 'Crear impuestos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'taxType.show', 'description' => 'Ver impuestos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'taxType.edit', 'description' => 'Editar impuestos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'taxType.destroy', 'description' => 'Eliminar impuestos', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'transfer.index', 'description' => 'Listado tranferencia de productos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'transfer.create', 'description' => 'Crear tranferencias productos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);
        Permission::create(['name' => 'transfer.show', 'description' => 'Ver tranferencias productos', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases]);

        Permission::create(['name' => 'user.index', 'description' => 'Listado usuarios', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.create', 'description' => 'Crear usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.show', 'description' => 'Ver usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.edit', 'description' => 'Editar usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.destroy', 'description' => 'Eliminar usuario', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'user.status', 'description' => 'Estado usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.locked', 'description' => 'Desactivar usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);

        Permission::create(['name' => 'verificationCode.index', 'description' => 'Listado codigos de verificacion', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'verificationCode.create', 'description' => 'Crear codigos de verificacion', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'verificationCode.show', 'description' => 'Ver codigos de verificacion', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'verificationCode.edit', 'description' => 'Editar codigos de verificacion', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'verificationCode.destroy', 'description' => 'Eliminar codigos de verificacion', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);

        Permission::create(['name' => 'voucherType.index', 'description' => 'Listado tipos de comprobantes', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'voucherType.create', 'description' => 'Crear tipos de comprobantes', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'voucherType.show', 'description' => 'Ver tipos de comprobantes', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'voucherType.edit', 'description' => 'Editar tipos de comprobantes', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'voucherType.destroy', 'description' => 'Eliminar tipos de comprobantes', 'status' => 'active'])->syncRoles([$superAdmin]);
    }
}
