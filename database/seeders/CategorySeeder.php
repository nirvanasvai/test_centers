<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nubs\RandomNameGenerator\All;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i< 5;$i ++){
            $category_id = [
                'title'=>All::create(),
                'category_id'=>rand(1,5)
            ];
            Category::query()->create($category_id);
        }

    }
}
