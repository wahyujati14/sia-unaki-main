<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InformationService;

class InformationServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InformationService::create([
            'email' => 'cs@unaki.ac.id',
            'phone' => '(024) 3552 555',
            'whatsapp' =>'081 829 0000'
        ]);
    }
}
