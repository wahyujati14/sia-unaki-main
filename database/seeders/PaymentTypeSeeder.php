<?php

namespace Database\Seeders;

use App\Models\PaymentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentType::insert([
            [
                'name' => 'XENDIT',
                'is_active' =>true
            ],
            [
                'name' => 'UPLOAD_BUKTI',
                'is_active' =>true
            ]
        ]);
    }
}
