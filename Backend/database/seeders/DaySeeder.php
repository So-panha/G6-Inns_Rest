<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\OpeningHours\Day as SpatieDay;
use App\Models\Day;


class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $days = SpatieDay::days();

        foreach($days as $day)
        {
            Day::create(['name' => $day]);
        }
    }
}
