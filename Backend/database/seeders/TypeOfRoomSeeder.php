<?php

namespace Database\Seeders;

use App\Models\TypeOfRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeOfRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TypeOfRoom::create(['name' => 'Air conditioned']);
        TypeOfRoom::create(['name' => 'Fan']);
    }
}
