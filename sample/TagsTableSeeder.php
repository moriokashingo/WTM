<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tags')->insert([
            ['name' => 'pops'],
            ['name' => 'rock'],
            ['name' => 'hiphop'],
        ]);
    }
}
