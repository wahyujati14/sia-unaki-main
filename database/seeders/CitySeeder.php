<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class CitySeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->table = 'cities';
        $this->csv_delimiter = ',';
        $this->offset_rows = 1;
        $this->filename = base_path().'/database/seeders/regions/city.csv';
        $this->mapping = [
            1 => 'name',
            2 => 'provincy_id'
        ];
        $this->should_trim = true;
    }

    public function run()
    {
        // Recommended when importing larger CSVs
        // DB::disableQueryLog();

        // Uncomment the below to wipe the table clean before populating
        // DB::table($this->table)->truncate();

        parent::run();
    }
}
