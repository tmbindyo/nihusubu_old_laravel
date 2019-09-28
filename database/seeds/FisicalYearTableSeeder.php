<?php

use Illuminate\Database\Seeder;

class FisicalYearTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()    {
        DB::table('fiscal_years')->insert([
            'id' => '4be20a9a-aee3-414c-b8ba-dcacf859cc9c',
            'name' => 'January to December',
            'description' => 'January to December ...',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('fiscal_years')->insert([
            'id' => 'b2004522-e7aa-41dd-b033-7252d0a642b7',
            'name' => 'July to June',
            'description' => 'July to June ...',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
