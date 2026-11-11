<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun 1: Admin (Akses penuh CRUD termasuk Hapus)
        User::create([
            'nama'     => 'Admin Haerul',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // Akun 2: Staff / Role ke-2 (Hanya bisa lihat, tambah, dan ubah - Tidak boleh hapus)
        User::create([
            'nama'     => 'Staff Budi',
            'email'    => 'staff@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'staff',
        ]);
    }
}