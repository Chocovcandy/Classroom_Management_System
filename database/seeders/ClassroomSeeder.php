<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;

class ClassroomSeeder extends Seeder
{
    public function run(): void
    {
        // Room 31...
        Classroom::create([
            'room_name' => '315',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => '316',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => '317',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => '318',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);


        // Room 4...
        Classroom::create([
            'room_name' => '409',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);

        Classroom::create([
            'room_name' => '410',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);


        //Room 41....
        Classroom::create([
            'room_name' => '413',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => '414',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => '415',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => '416',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => '417',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => '418',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);



        //Room B0...
        Classroom::create([
            'room_name' => 'B01',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => 'B02',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => 'B03',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => 'B04',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => 'B05',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => 'B06',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => 'B07',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);


        // Computer Lab...
        Classroom::create([
            'room_name' => 'Computer Lab 1',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => 'Computer Lab 2',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);
        Classroom::create([
            'room_name' => 'Computer Lab 3',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);




        // Foundatation Year Classroom
        Classroom::create([
            'room_name' => 'Foundatation Year Classroom',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);




        // Room R&D
        Classroom::create([
            'room_name' => 'Room R&D',
            'capacity' => 15,
            'floor' => 1,
            'building' => 'Main Building',
        ]);




    }
}