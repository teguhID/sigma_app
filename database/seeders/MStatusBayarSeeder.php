<?php

namespace Database\Seeders;

use App\Models\m_status_bayar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MStatusBayarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programList = [
            ['name' => 'pending', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'paid', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'expired', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'failed', 'desc' => '', 'created_by' => null, 'updated_by' => null]
        ];

        foreach ($programList as $program) {
            m_status_bayar::updateOrCreate(
                ['name' => $program['name']],
                $program
            );
        }

        $this->command->info('🏫 m_status_bayar table seeded with default m_status_bayar entries.');
    }
}
