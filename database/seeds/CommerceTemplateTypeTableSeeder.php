<?php

use Illuminate\Database\Seeder;

class CommerceTemplateTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()    {
        DB::table('commerce_template_types')->insert([
            'id' => '42973742-531e-4854-8c32-b280d054e1d8',
            'name' => 'Service',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);

        DB::table('commerce_template_types')->insert([
            'id' => '97b1b333-71b1-4064-b0b9-b2a6fd393114',
            'name' => 'Sales',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'user_id' => 1,
            'created_at' => now()
        ]);

    }
}
