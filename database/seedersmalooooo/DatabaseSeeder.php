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

        $this->call(RoleSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(MunicipalitiesTableSeeder::class);
        $this->call(PostalCodesTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(CardsTableSeeder::class);
        $this->call(IdentificationTypesTableSeeder::class);
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(LiabilitiesTableSeeder::class);
        $this->call(EnvironmentsTableSeeder::class);
        $this->call(OrganizationsTableSeeder::class);
        $this->call(RegimesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(IndicatorsTableSeeder::class);
        $this->call(BranchesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(VerificationCodesTableSeeder::class);
        $this->call(TaxTypesTableSeeder::class);
        $this->call(PercentagesTableSeeder::class);
        $this->call(CompanyTaxesTableSeeder::class);
        $this->call(MeasureUnitsTableSeeder::class);
        $this->call(DiscrepanciesTableSeeder::class);
        $this->call(ContratTypesTableSeeder::class);
        $this->call(ChargesTableSeeder::class);
        $this->call(EmployeeSubtypesTableSeeder::class);
        $this->call(EmployeeTypesTableSeeder::class);
        $this->call(PaymentFrecuenciesTableSeeder::class);
        $this->call(GenerationTypesTableSeeder::class);
        $this->call(ProvidersTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(VoucherTypesTableSeeder::class);
        $this->call(ResolutionsTableSeeder::class);
        $this->call(PaymentFormsTableSeeder::class);
        $this->call(PaymentMethodsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(RestaurantTablesTableSeeder::class);
        $this->call(RawMaterialsTableSeeder::class);
        $this->call(ProductRawmaterialsTableSeeder::class);
    }
}
