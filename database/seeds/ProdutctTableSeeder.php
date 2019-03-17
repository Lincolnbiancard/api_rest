<?php

use Illuminate\Database\Seeder;

class ProdutctTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Cria 10 produtos baseado no array do ProductFactory 
        factory(\App\Product::class, 10)->create(); 
    }
}
