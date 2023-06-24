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
            'username' => 'PT. TA',
            'email' => 'pt.ta@example.com',
            'password' => Hash::make('ptta'),
            'first_name' => 'PT. TA'
        ])->addRole('mitra');
        User::create([
            'username' => 'KOPEG',
            'email' => 'kopeg@example.com',
            'password' => Hash::make('kopeg'),
            'first_name' => 'KOPEG'
        ])->addRole('mitra');
        User::create([
            'username' => 'WMT',
            'email' => 'wmt@example.com',
            'password' => Hash::make('wmt'),
            'first_name' => 'WMT'
        ])->addRole('mitra');

        // Optima Account
        User::create([
            'username' => 'optima',
            'email' => 'optima@example.com',
            'password' => Hash::make('optima'),
            'first_name' => 'optima'
        ])->addRole('optima');
    }
}
