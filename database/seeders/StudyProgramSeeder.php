<?php

namespace Database\Seeders;

use App\Models\Faculties;
use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'Teknik dan Informatika',
                'study_program' => [
                    'Teknik Informatika',
                    'Sistem Informasi'
                ],
            ],[
                'Ekonomika dan Bisnis',
                'study_program' => [
                    'Manajemen',
                    'Akuntansi',
                    'Perpajakan',  
                ],
            ],[
                'Bahasa dan Budaya',
                'study_program' => [
                    'Sastra Inggris',
                ],
            ],[
                'Psikologi',
                'study_program' => [
                    'Psikologi',
                ],
            ]
        ];
        DB::beginTransaction();
        try {

            foreach ($data as $key => $fakultas) {
                $fakultass = Faculties::create([
                    'name' => $fakultas[0]
                ]);
                foreach ($fakultas['study_program'] as $key => $value) {
                    StudyProgram::create([
                        'name' => $value,
                        'faculty_id' => $fakultass->id
                    ]);
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }
    }
}
