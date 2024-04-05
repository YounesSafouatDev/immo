<?php

namespace Database\Seeders;


use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Villa','Maison','Appartement','Bureau','Local Commercial','Terrain'];
        for($i = 0 ; $i < count($categories) ; $i++){
            Category::create([
                'name'=>$categories[$i],
            ]);
        }
    }
}
