<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(IndicatorsTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(MunicipalitiesTableSeeder::class);
        $this->call(PostalCodeSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(IdentificationTypesTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(LiabilitiesTableSeeder::class);
        $this->call(EnvironmentSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(RegimesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(IndicatorTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VerificationCodeTableSeeder::class);
        $this->call(TaxTypeSeeder::class);
        $this->call(PercentagesTableSeeder::class);
        $this->call(CompanyTaxSeeder::class);
        $this->call(MeasureUnitsTableSeeder::class);
        $this->call(DiscrepanciesTableSeeder::class);


        $this->call(ContratTypesTableSeeder::class);
        $this->call(ChargesTableSeeder::class);
        $this->call(EmployeeSubtypesTableSeeder::class);
        $this->call(EmployeeTypesTableSeeder::class);
        $this->call(PaymentFrecuenciesTableSeeder::class);

        $this->call(ProvidersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(BranchProductsTableSeeder::class);


        $this->call(GenerationTypeTableSeeder::class);
        $this->call(VoucherTypeTableSeeder::class);
        $this->call(ResolutionSeeder::class);
        $this->call(PaymentFormsTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);


        //$this->call(EmployeesTableSeeder::class);
        //$this->call(RestaurantTableSeeder::class);
        //$this->call(RawMaterialSeeder::class);
        //$this->call(ProductRawmaterialSeeder::class);
        //$this->call(BranchRawmaterialsTableSeeder::class);
        //$this->call(OvertimeTypeSeeder::class);
    }
}
