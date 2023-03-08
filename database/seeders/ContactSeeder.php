<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::create([
            'description' => 'This is your contact descriptions of theme your website or motto for website and ilustration over specific',
            'address' => 'Jl. M.Yamin Samarinda - Kalimantan Timur',
            'email' => 'imajora@example.com',
            'phone' => '(+62 821 4872 2747)',
        ]);
    }
}