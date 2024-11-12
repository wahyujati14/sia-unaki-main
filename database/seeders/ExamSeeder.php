<?php

namespace Database\Seeders;

use Flynsarmy\CsvSeeder\CsvSeeder;

class ExamSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->table = 'exams';
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->filename = base_path().'/database/seeders/regions/exam.csv';
        $this->mapping = [
            0 => 'id',
            1 => 'name',
            2 => 'is_active',
            3 => 'duration',
            4 => 'schedule',
        ];
        $this->should_trim = true;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
		// DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		// DB::table($this->table)->truncate();

		parent::run();
    }
}
