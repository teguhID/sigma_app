<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\m_kelas;

class MKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kelasList = [
            ['name' => 'kelas 10', 'desc' => 'Kelas tingkat 10', 'created_by' => null, 'updated_by' => null],
            ['name' => 'kelas 11', 'desc' => 'Kelas tingkat 11', 'created_by' => null, 'updated_by' => null],
            ['name' => 'kelas 12', 'desc' => 'Kelas tingkat 12', 'created_by' => null, 'updated_by' => null],
            ['name' => 'gap year', 'desc' => 'Tahun jeda sebelum lanjut studi', 'created_by' => null, 'updated_by' => null],
        ];

        foreach ($kelasList as $kelas) {
            m_kelas::updateOrCreate(
                ['name' => $kelas['name']],
                $kelas
            );
        }

        $this->command->info('🏫 m_kelas table seeded with default kelas entries.');
    }
}
