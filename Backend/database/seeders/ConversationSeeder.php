<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use App\Models\Conversation;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  

    public function run()
    {
   
    
            Conversation::create([
                'sender_id' => 2,
                'receiver_id' => 1,
            ]);
    
            Conversation::create([
                'sender_id' => 3,
                'receiver_id' => 1,
            ]);
    }
    
}
