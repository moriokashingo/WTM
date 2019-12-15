<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('comments')->insert([
            ['body' => 'book',
            'question_id'=>'1',
            'user_id=>1'
            ],
            ['body' => 'cafe',
            'question_id'=>'1',
            'user_id=>1'],
            ['body' => 'travel',
            'question_id'=>'1',
            'user_id=>1']
        ]);
    }
}
