<?php

namespace Database\Seeders;

use App\Models\BookingUserRooms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    
    BookingUserRooms::create([
        'first_name' => 'da',
        'last_name' => 'ny',
        'email' => 'da@example.com',
        
    ]);
}

}
