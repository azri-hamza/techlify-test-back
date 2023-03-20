<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class charactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = 'database/seeders/sql/characters.sql';
        $sql = file_get_contents($path);
        DB::unprepared($sql);
        $this->command->info('Characters table seeded!');
    }
}
