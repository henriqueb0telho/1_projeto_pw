<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin da CleanSolutions
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Principal',
            'email' => 'admin@cleansolutions.pt',
            'password' => Hash::make('password'),
            'phone' => '+351 912 345 678',
            'role' => 'admin',
            'company_id' => 1,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Gestor
        User::create([
            'first_name' => 'Maria',
            'last_name' => 'Silva',
            'email' => 'maria.silva@cleansolutions.pt',
            'password' => Hash::make('password'),
            'phone' => '+351 913 456 789',
            'role' => 'manager',
            'company_id' => 1,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Funcionários de limpeza
        User::create([
            'first_name' => 'Ana',
            'last_name' => 'Costa',
            'email' => 'ana.costa@cleansolutions.pt',
            'password' => Hash::make('password'),
            'phone' => '+351 914 567 890',
            'role' => 'cleaner',
            'company_id' => 1,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'first_name' => 'João',
            'last_name' => 'Santos',
            'email' => 'joao.santos@cleansolutions.pt',
            'password' => Hash::make('password'),
            'phone' => '+351 915 678 901',
            'role' => 'cleaner',
            'company_id' => 1,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        User::create([
            'first_name' => 'Sofia',
            'last_name' => 'Oliveira',
            'email' => 'sofia.oliveira@cleansolutions.pt',
            'password' => Hash::make('password'),
            'phone' => '+351 916 789 012',
            'role' => 'cleaner',
            'company_id' => 1,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        // Utilizador suspenso (exemplo)
        User::create([
            'first_name' => 'Carlos',
            'last_name' => 'Ferreira',
            'email' => 'carlos.ferreira@cleansolutions.pt',
            'password' => Hash::make('password'),
            'phone' => '+351 917 890 123',
            'role' => 'cleaner',
            'company_id' => 1,
            'status' => 'suspended',
            'email_verified_at' => now(),
        ]);

        // Utilizador da segunda empresa
        User::create([
            'first_name' => 'Pedro',
            'last_name' => 'Almeida',
            'email' => 'pedro.almeida@sparkleclean.pt',
            'password' => Hash::make('password'),
            'phone' => '+351 918 901 234',
            'role' => 'admin',
            'company_id' => 2,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
    }
}
