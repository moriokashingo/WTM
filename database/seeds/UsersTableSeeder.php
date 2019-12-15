<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            ['name' => 'tanaka',
            'email' => 'tanaka@gmail.com',
            'password' => bcrypt('testtest'),],
            ['name' => 'suzuki',
            'email' => 'suzuki@gmail.com',
            'password' => bcrypt('testtest'),],
        ]);
    }
}
