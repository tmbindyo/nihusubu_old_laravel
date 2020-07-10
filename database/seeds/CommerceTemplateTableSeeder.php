<?php

use Illuminate\Database\Seeder;

class CommerceTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()    {
        // commerce template
        DB::table('commerce_templates')->insert([
            'id' => '42973742-531e-4854-8c32-b280d054e1d8',
            'name' => 'Amado',
            'base_url' => 'e_commerce/amado',
            'price' => '100',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'commerce_template_type_id' => '97b1b333-71b1-4064-b0b9-b2a6fd393114',
            'user_id' => 1,
            'created_at' => now()
        ]);

        // commerce template files
        DB::table('commerce_template_files')->insert([
            'id' => 'd8ebd4c5-205c-4d23-99ab-88c1e5796141',
            'name' => 'cart',
            'type' => 'cart',
            'view' => 'commerce.amado.cart',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'commerce_template_id' => '42973742-531e-4854-8c32-b280d054e1d8',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('commerce_template_files')->insert([
            'id' => 'fab4dca6-52ac-47e4-bfc1-bdb63232f5a6',
            'name' => 'checkout',
            'type' => 'checkout',
            'view' => 'commerce.amado.checkout',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'commerce_template_id' => '42973742-531e-4854-8c32-b280d054e1d8',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('commerce_template_files')->insert([
            'id' => '12f3f7ad-96da-4fa9-b3e0-2cc6be623350',
            'name' => 'index',
            'type' => 'index',
            'view' => 'commerce.amado.index',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'commerce_template_id' => '42973742-531e-4854-8c32-b280d054e1d8',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('commerce_template_files')->insert([
            'id' => '993144ba-83c8-4eef-a388-2a84a9d6a3f4',
            'name' => 'product-details',
            'type' => 'product-details',
            'view' => 'commerce.amado.product-details',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'commerce_template_id' => '42973742-531e-4854-8c32-b280d054e1d8',
            'user_id' => 1,
            'created_at' => now()
        ]);
        DB::table('commerce_template_files')->insert([
            'id' => '2c1bc117-ad0f-4abe-bbdc-80ecdbc58a5e',
            'name' => 'shop',
            'type' => 'shop',
            'view' => 'commerce.amado.shop',
            'status_id' => 'c670f7a2-b6d1-4669-8ab5-9c764a1e403e',
            'commerce_template_id' => '42973742-531e-4854-8c32-b280d054e1d8',
            'user_id' => 1,
            'created_at' => now()
        ]);
    }
}
