<?php

namespace Database\Seeders;

use App\Models\CleaningSchedule;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CleaningScheduleSeeder extends Seeder
{
    public function run(): void
    {
        // Limpezas para hoje
        CleaningSchedule::create([
            'accommodation_id' => 1,
            'scheduled_date' => Carbon::today(),
            'scheduled_time' => '09:00',
            'status' => 'scheduled',
            'notes' => 'Check-in às 15h, urgente'
        ]);

        CleaningSchedule::create([
            'accommodation_id' => 2,
            'scheduled_date' => Carbon::today(),
            'scheduled_time' => '11:00',
            'status' => 'scheduled',
            'notes' => 'Hóspedes deixaram muitas coisas'
        ]);

        // Limpezas para amanhã
        CleaningSchedule::create([
            'accommodation_id' => 3,
            'scheduled_date' => Carbon::tomorrow(),
            'scheduled_time' => '10:00',
            'status' => 'scheduled',
            'notes' => 'Limpeza geral após estadia longa'
        ]);

        CleaningSchedule::create([
            'accommodation_id' => 4,
            'scheduled_date' => Carbon::tomorrow(),
            'scheduled_time' => '14:00',
            'status' => 'scheduled'
        ]);

        // Limpeza concluída
        CleaningSchedule::create([
            'accommodation_id' => 5,
            'scheduled_date' => Carbon::yesterday(),
            'scheduled_time' => '09:00',
            'status' => 'completed',
            'actual_duration' => 115
        ]);
    }
}
