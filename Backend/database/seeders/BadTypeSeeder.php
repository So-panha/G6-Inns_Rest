<?php

namespace Database\Seeders;

use App\Models\BadType;
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
        BadType::create(['name' => 'One bad']);
        BadType::create(['name' => 'Two bad']);
    }
}
