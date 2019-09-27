<?php

use Illuminate\Database\Seeder;

class BusinessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businesses')->insert([
            'id' => 'fab52a50-ef83-4cdc-8086-376afee6a0eb',
            'institution_id' => 'Nihusubu',
            'status_id' => 6,
            'created_at' => now(),
            'updated_at' => now()
        ]);


    }
}
