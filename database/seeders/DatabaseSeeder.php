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
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory(30)->create();
        \App\Models\category::factory(10)->create();
        \App\Models\post::factory(300)->create();
        \App\Models\comment::factory(200)->Create();
    }
}
