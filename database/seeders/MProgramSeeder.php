<?php

namespace Database\Seeders;

use App\Models\m_program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programList = [
            ['name' => 'TKA Kelas 12', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'Reguler UTBK', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'Intensif UTBK', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'Super Intensif UTBK', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'Math Focus', 'desc' => '', 'created_by' => null, 'updated_by' => null],
        ];

        foreach ($programList as $program) {
            m_program::updateOrCreate(
                ['name' => $program['name']],
                $program
            );
        }

        $this->command->info('🏫 m_program table seeded with default program entries.');
    }
}
