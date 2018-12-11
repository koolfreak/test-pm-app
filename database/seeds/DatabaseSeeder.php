<?php

use Illuminate\Database\Seeder;

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
        // $this->call(UsersTableSeeder::class);
        $user = new User;
        $user->name = "Eman Nollase";
        $user->email = "exst_enollase@yahoo.com";
        $user->password = bcrypt('123456');
        $user->role = "admin";
        $user->save();

    }
}
