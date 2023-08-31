<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 100; $i++){
            $slug = Str::slug($faker->unique()->city);
            $region = Region::inRandomOrder()->first();

            City::create([
                "slug" => $slug,
                "region_id" => $region->id,
                "title" => [
                    "ru" => "Город: $slug",
                    "en" => "$slug city",
                    "uz" => "$slug shahri",
                    "oz" => "$slug шахри",
                ],
            ]);
        }
    }
}
