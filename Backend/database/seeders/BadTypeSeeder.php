<?php

namespace Database\Seeders;

use App\Models\BedType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        BedType::create(['name' => 'One bad']);
        BedType::create(['name' => 'Two bad']);
    }
}
