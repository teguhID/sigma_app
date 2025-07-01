<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'id_role' => 1,
                'name' => 'Admin',
                'password' => Hash::make('admin@1234'),
            ]
        );

        $this->command->info('👤 User admin berhasil dibuat.');
    }
}
