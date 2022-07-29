<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('products')->delete();

        \DB::table('products')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Rice',
                'barcode' => 'WER324',
                'unit' => 'KG',
                'unit_price' => '100',
                'weight' => '15',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Sugar',
                'barcode' => 'HJS987',
                'unit' => 'KG',
                'unit_price' => '80',
                'weight' => '10',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));


    }
}
