<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::create([
            'title' => 'desktop',
            'slug' => 'desktop',
        ]);
        Device::create([
            'title' => 'mobile',
            'slug' => 'mobile',
        ]);
    }
}
