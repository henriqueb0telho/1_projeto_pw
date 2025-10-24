<?php

namespace Database\Seeders;

use App\Models\CleaningAssignment;
use Illuminate\Database\Seeder;

class CleaningAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        // Atribuição para a limpeza 1 (hoje)
        CleaningAssignment::create([
            'cleaning_schedule_id' => 1,
            'user_id' => 3, // Ana Costa
            'role_in_cleaning' => 'primary'
        ]);

        CleaningAssignment::create([
            'cleaning_schedule_id' => 1,
            'user_id' => 4, // João Santos
            'role_in_cleaning' => 'assistant'
        ]);

        // Atribuição para a limpeza 2 (hoje)
        CleaningAssignment::create([
            'cleaning_schedule_id' => 2,
            'user_id' => 5, // Sofia Oliveira
            'role_in_cleaning' => 'primary'
        ]);

        // Atribuição para a limpeza 3 (amanhã)
        CleaningAssignment::create([
            'cleaning_schedule_id' => 3,
            'user_id' => 3, // Ana Costa
            'role_in_cleaning' => 'primary'
        ]);

        // Atribuição para a limpeza 4 (amanhã)
        CleaningAssignment::create([
            'cleaning_schedule_id' => 4,
            'user_id' => 4, // João Santos
            'role_in_cleaning' => 'primary'
        ]);
    }
}
