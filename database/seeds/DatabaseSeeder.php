<?php

use App\Models\Guest;
use App\Models\Visit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Guest::class, 10000)->create();
        factory(Visit::class, 10000)->create();
    }
}
