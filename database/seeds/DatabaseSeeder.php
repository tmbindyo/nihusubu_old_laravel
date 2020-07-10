<?php

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
        $this->call([AccountTypeTableSeeder::class]);
        $this->call([AddressTypeTableSeeder::class]);
        $this->call([CommerceTemplateTableSeeder::class]);
        $this->call([CommerceTemplateTypeTableSeeder::class]);
        $this->call([CurrencyTableSeeder::class]);
        $this->call([FiscalYearTableSeeder::class]);
        $this->call([InstitutionTableSeeder::class]);
        $this->call([LoanTypeTableSeeder::class]);
        $this->call([ModuleTableSeeder::class]);
        $this->call([PermissionTableSeeder::class]);
        $this->call([PlanTableSeeder::class]);
        $this->call([PlanTypeTableSeeder::class]);
        $this->call([ReasonTableSeeder::class]);
        $this->call([ServiceTableSeeder::class]);
        $this->call([ServiceTypePricingTableSeeder::class]);
        $this->call([ServiceTypeTableSeeder::class]);
        $this->call([StatusTableSeeder::class]);
        $this->call([StatusTypeTableSeeder::class]);
        $this->call([SubsctiptionPaymentTypeTableSeeder::class]);
        $this->call([TestEnvironmentSeeder::class]);
        $this->call([UploadTypeTableSeeder::class]);
        $this->call([UserTableSeeder::class]);
        $this->call([UserTypeTableSeeder::class]);
    }
}
