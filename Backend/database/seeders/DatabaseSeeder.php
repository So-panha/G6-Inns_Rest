<?php

namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AdminSeeder::class);
        \App\Models\Post::factory(17)->create();
        $this->call(MailsettingSeeder::class);
        $this->call(ConversationSeeder::class);
        $this->call(MessageSeeder::class);

        $this->call(BadTypeSeeder::class);
        $this->call(TypeOfRoomSeeder::class);
    }
}
