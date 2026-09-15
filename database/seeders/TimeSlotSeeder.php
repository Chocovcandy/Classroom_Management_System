<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TimeSlot;

class TimeSlotSeeder extends Seeder
{
    public function run(): void
    {
        TimeSlot::create([
            'session_number' => 1,
            'session_label' => '1',
            'start_time' => '08:00:00',
            'end_time' => '09:00:00',
        ]);

        TimeSlot::create([
            'session_number' => 2,
            'session_label' => '2',
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
        ]);

        TimeSlot::create([
            'session_number' => 3,
            'session_label' => '3',
            'start_time' => '10:00:00',
            'end_time' => '10:30:00',
        ]);

        TimeSlot::create([
            'session_number' => 4,
            'session_label' => '4',
            'start_time' => '10:30:00',
            'end_time' => '11:00:00',
        ]);
    }
}