<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mitra;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LaratrustSeeder::class);

        // Admin Account
        User::create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'first_name' => 'admin'
        ])->addRole('admin');

        // Mitra Account
        User::create([
            'username' => 'Mitra',
            'email' => 'mitra@example.com',
            'password' => Hash::make('mitra'),
            'first_name' => 'mitra'
        ])->addRole('mitra');

        // Optima Account
        User::create([
            'username' => 'optima',
            'email' => 'optima@example.com',
            'password' => Hash::make('optima'),
            'first_name' => 'optima'
        ])->addRole('optima');

        // Create Mitra TA
        Mitra::create([
            'nama_mitra' => 'PT. TA',
        ]);

        // Create Mitra KOPEG
        Mitra::create([
            'nama_mitra' => 'KOPEG',
        ]);

        // WMT
        Mitra::create([
            'nama_mitra' => 'WMT',
        ]);
    }
}
