<?php

namespace Database\Seeders;

use App\Models\m_program_duration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MProgramDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programDurationList = [
            ['name' => 'Half Price', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'Full Price', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => '1 Bulan', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => '2 Bulan', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => '3 Bulan', 'desc' => '', 'created_by' => null, 'updated_by' => null],
        ];

        foreach ($programDurationList as $programDuration) {
            m_program_duration::updateOrCreate(
                ['name' => $programDuration['name']],
                $programDuration
            );
        }

        $this->command->info('🏫 m_program_duration table seeded with default program duration entries.');
    }
}
