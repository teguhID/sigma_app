<?php

namespace Database\Seeders;

use App\Models\m_config_program_duration;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MConfigProgramDurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_config_program_duration')->truncate();

        $configProgramDurationList = [
            // PROGRAM 1
            [
                'id_program' => 1,
                'id_sub_program' => 1,
                'id_program_duration' => 1,
                'harga' => 399000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 1,
                'id_sub_program' => 1,
                'id_program_duration' => 2,
                'harga' => 599000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 1,
                'id_sub_program' => 2,
                'id_program_duration' => 1,
                'harga' => 399000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 1,
                'id_sub_program' => 2,
                'id_program_duration' => 2,
                'harga' => 599000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 1,
                'id_sub_program' => 3,
                'id_program_duration' => 1,
                'harga' => 599000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 1,
                'id_sub_program' => 3,
                'id_program_duration' => 2,
                'harga' => 899000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],

            // PROGRAM 2
            [
                'id_program' => 2,
                'id_sub_program' => null,
                'id_program_duration' => 1,
                'harga' => 459000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 2,
                'id_sub_program' => null,
                'id_program_duration' => 2,
                'harga' => 699000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],

            // PROGRAM 3
            [
                'id_program' => 3,
                'id_sub_program' => null,
                'id_program_duration' => 1,
                'harga' => 649000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 3,
                'id_sub_program' => null,
                'id_program_duration' => 2,
                'harga' => 999000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],

            // PROGRAM 4
            [
                'id_program' => 4,
                'id_sub_program' => null,
                'id_program_duration' => 1,
                'harga' => 1039000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 4,
                'id_sub_program' => null,
                'id_program_duration' => 2,
                'harga' => 1599000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],

            // PROGRAM 5
            [
                'id_program' => 5,
                'id_sub_program' => null,
                'id_program_duration' => 3,
                'harga' => 299000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 5,
                'id_sub_program' => null,
                'id_program_duration' => 4,
                'harga' => 539000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ],
            [
                'id_program' => 5,
                'id_sub_program' => null,
                'id_program_duration' => 5,
                'harga' => 729000,
                'tanggal_mulai' => '2025-07-01',
                'tanggal_selesai' => '2025-07-01',
                'created_by' => null,
                'updated_by' => null
            ]
        ];

        foreach ($configProgramDurationList as $program) {
            m_config_program_duration::create($program);
        }

        $this->command->info('✅ Tabel m_config_program_duration berhasil di-reset dan diisi ulang.');
    }
}
