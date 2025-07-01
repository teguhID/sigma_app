<?php

namespace Database\Seeders;

use App\Models\m_role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programList = [
            ['name' => 'Admin', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'Student', 'desc' => '', 'created_by' => null, 'updated_by' => null],
            ['name' => 'Teacher', 'desc' => '', 'created_by' => null, 'updated_by' => null],
        ];

        foreach ($programList as $program) {
            m_role::updateOrCreate(
                ['name' => $program['name']],
                $program
            );
        }

        $this->command->info('🏫 m_status_bayar table seeded with default m_status_bayar entries.');
    }
}
