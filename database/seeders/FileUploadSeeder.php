<?php

namespace Database\Seeders;

use App\Models\FileUpload;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileUploadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        FileUpload::insert([
            [
                'name' => 'Transkrip Nilai Semester 5',
                'size' => '2',
                'type' => json_encode(['jpg','jpeg','gif','png','pdf',]),
            ],
            [
                'name' => 'Scan KIP',
                'size' => '2',
                'type' => json_encode(['jpg','jpeg','gif','png','pdf',]),
            ],
            [
                'name' => 'Piagam Terbaik',
                'size' => '2',
                'type' => json_encode(['jpg','jpeg','gif','png','pdf',]),
            ],
            [
                'name' => 'Scan Bukti Pembayaran',
                'size' => '2',
                'type' => json_encode(['jpg','jpeg','gif','png','pdf',]),
            ],
            [
                'name' => 'KHS (Kartu Hasil Study)',
                'size' => '2',
                'type' => json_encode(['jpg','jpeg','gif','png','pdf',]),
            ],
        ]);
    }
}
