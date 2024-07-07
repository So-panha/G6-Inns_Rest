<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Message::create([
            'conversation_id'=>1,
            'sender_id'=>2,
            'receiver_id'=>1,
            'body'=>'hello!'
        ]);
        
        Message::create([
            'conversation_id'=>2,
            'sender_id'=>3,
            'receiver_id'=>1,
            'body'=>'Good morning!'
        ]);
        

        
    }
}
