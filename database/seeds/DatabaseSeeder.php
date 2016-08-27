<?php

use App\Discussion;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discussion::unguard();
//        Discussion::truncate();
//        $this->call(UsersTableSeeder::class);
        $this->call(DiscussionsTableSeeder::class);

        Discussion::reguard();

    }
}
