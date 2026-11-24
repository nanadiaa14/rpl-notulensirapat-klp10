<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'nip' => '199001012020011001',
            'unit' => 'IT',
            'email' => 'admin@example.com',
            'password' => 'Admin12345',
            'nomor_hp' => '081234567890',
        ]);

        // pegawai lain, supaya dropdown notulis ada isinya
        User::factory(4)->create([
            'password' => 'Pegawai12345',
        ]);
    }
}
