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
                'sku' => 'WER324',
                'unit' => 'KG',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sugar',
                'sku' => 'HJS987',
                'unit' => 'KG',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}