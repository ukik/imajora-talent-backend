<?php

namespace Database\Seeders;

use App\Models\Contest;
use Database\Factories\ContestFactory;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contest::factory()
            ->count(500)
            ->create();
    }
}
