<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'daffa@gmail.com'],
            [
                'name' => 'daffa',
                'nip' => '123456789012345678',
                'role' => 'admin',
                'password' => bcrypt('daffa123')
            ]
        );
    }
}