<?php

use Illuminate\Database\Seeder;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('institutions')->insert([
            'id' => 'ce8a6a8a-03a2-4c97-9cd7-863c7fc48c68',
            'name' => 'Fluidtech Global',
            'portal' => 'fluidtech',
            'has_custom_payment_terms' => 0,
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
        ]);

    }
}
