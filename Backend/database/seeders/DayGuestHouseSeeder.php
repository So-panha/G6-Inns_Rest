<?php

namespace Database\Seeders;
use App\Models\GuestHouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DayGuestHouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $days = [
            1 => [
                'from_hours' => '10',
                'from_minutes' => '00',
                'to_hours' => '18',
                'to_minutes' => '00',
            ],
            2 => [
                'from_hours' => '08',
                'from_minutes' => '00',
                'to_hours' => '18',
                'to_minutes' => '00',
            ],
            3 => [
                'from_hours' => '10',
                'from_minutes' => '00',
                'to_hours' => '20',
                'to_minutes' => '00',
            ],
            4 => [
                'from_hours' => '09',
                'from_minutes' => '00',
                'to_hours' => '18',
                'to_minutes' => '00',
            ],
            5 => [
                'from_hours' => '12',
                'from_minutes' => '00',
                'to_hours' => '22',
                'to_minutes' => '00',
            ],
        ];
        $guesthouses = GuestHouse::all();

        foreach($guesthouses as $guesthouse)
        {
            $guesthouse->days()->sync($days);
        }
    }
}
