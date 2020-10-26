<?php

use Illuminate\Database\Seeder;
use App\Models\Message;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        factory(User::class, 5)->create()->each(function ($user) {
                $user->messagesFrom()->save(factory(Message::class)->make());
            }); 

            // factory(Message::class, 5)->create();
    }
}
