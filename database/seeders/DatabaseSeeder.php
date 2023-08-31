<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        App\Models\User::create([
            "name" => "shavkat",
            "email" => "shavkat@namozvaqti.uz",
            "password" => bcrypt("1554477s"),
            'email_verified_at' => now(),

        ]);
        
        $this->call([
            RegionSeeder::class,
            CitySeeder::class
        ]);
    }
}
