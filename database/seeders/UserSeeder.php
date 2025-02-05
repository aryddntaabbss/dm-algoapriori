<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',  // Set role admin
        ]);

        // Menambahkan user pengunjung
        User::create([
            'name' => 'Pengunjung',
            'email' => 'pengunjung@gmail..com',
            'password' => Hash::make('pengunjung1'),
            'role' => 'pengunjung',  // Set role pengunjung
        ]);
    }
}
