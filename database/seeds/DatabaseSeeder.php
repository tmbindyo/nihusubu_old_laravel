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
        $this->call([AccountTableSeeder::class]);
        $this->call([AddressTypeTableSeeder::class]);
        $this->call([ContactTypeTableSeeder::class]);
        $this->call([CurrencyTableSeeder::class]);
        $this->call([CustomerTypeTableSeeder::class]);
        $this->call([ExpenseTypeTableSeeder::class]);
        $this->call([FiscalYearTableSeeder::class]);
        $this->call([InstitutionTableSeeder::class]);
        $this->call([PaymentTermTableSeeder::class]);
        $this->call([ReasonTableSeeder::class]);
        $this->call([RepeatTableSeeder::class]);
        $this->call([SaleTypeTableSeeder::class]);
        $this->call([SalutationTableSeeder::class]);
//        $this->call([SectorTableSeeder::class]);
        $this->call([ServiceTableSeeder::class]);
        $this->call([ServiceTypePricingTableSeeder::class]);
        $this->call([ServiceTypeTableSeeder::class]);
        $this->call([StatusTableSeeder::class]);
        $this->call([StatusTypeTableSeeder::class]);
        $this->call([TestEnvironmentSeeder::class]);
        $this->call([UploadTypeTableSeeder::class]);
        $this->call([UserTableSeeder::class]);
        $this->call([UserTypeTableSeeder::class]);
    }
}
