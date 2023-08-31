<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Region;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // for($i = 0; $i < 15; $i++) {
        //     $slug = Str::slug($faker->unique()->state);

        //     Region::create([
        //         "slug" => $slug,
        //         "title" => [
        //             "ru" => "$slug область",
        //             "oz" => "$slug вилояти",
        //             "en" => "$slug state",
        //             "uz" => "$slug viloyati"
        //         ],
        //     ]);
           
        // }
    }
}
