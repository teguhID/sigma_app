<?php

namespace Database\Seeders;

use App\Models\m_sub_program;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MSubProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subProgramList = [
            [
                'id_program' => 1,
                'name' => 'Saintek',
                'desc' => '',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 1,
                'name' => 'Soshum',
                'desc' => '',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 1,
                'name' => 'Campuran',
                'desc' => '',
                'created_by' => null,
                'updated_by' => null
            ],
        ];

        foreach ($subProgramList as $program) {
            m_sub_program::updateOrCreate(
                ['name' => $program['name']],
                $program
            );
        }

        $this->command->info('🏫 m_sub_program table seeded with default sub program entries.');
    }
}
