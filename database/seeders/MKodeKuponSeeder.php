<?php

namespace Database\Seeders;

use App\Models\m_kode_kupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MKodeKuponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programDurationList = [
            [
                'name' => 'Diskon 30 Orang Pertama',
                'kode' => 'SIGMA30',
                'persentase_diskon' => 21,
                'desc' => '',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'name' => 'Diskon Reguler',
                'kode' => 'SIGMAREG',
                'persentase_diskon' => 4,
                'desc' => '',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'name' => 'Diskon Marketing',
                'kode' => 'MARKT001',
                'persentase_diskon' => 7,
                'desc' => '',
                'created_by' => null,
                'updated_by' => null
            ],
        ];

        foreach ($programDurationList as $programDuration) {
            m_kode_kupon::updateOrCreate(
                ['name' => $programDuration['name']],
                $programDuration
            );
        }

        $this->command->info('🏫 m_program_duration table seeded with default program duration entries.');
    }
}
