<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MRoleSeeder::class,
            UserSeeder::class,
            MKelasSeeder::class,
            MProgramSeeder::class,
            MSubProgramSeeder::class,
            MProgramDurationSeeder::class,
            MConfigProgramDurationSeeder::class,
            MStatusBayarSeeder::class,
            MKodeKuponSeeder::class,
            // seeder lainnya...
        ]);
    }
}
