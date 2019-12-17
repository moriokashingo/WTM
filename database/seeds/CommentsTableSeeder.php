<?php

use Illuminate\Database\Seeder;

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
            ['body' => 'これはあの曲ですよ',
            'question_id'=>'1',
            'user_id'=>'1',
            'created_at'=>'2019-12-14 14:23:24',
            'updated_at'=>'2019-12-14 14:23:24'
            ],
            ['body' => 'それはあの曲ですよ',
            'question_id'=>'1',
            'user_id'=>'1',
            'created_at'=>'2019-12-14 14:23:24',
            'updated_at'=>'2019-12-14 14:23:24'
        ],
            ['body' => 'あれはあの曲ですよ',
            'question_id'=>'1',
            'user_id'=>'1',
            'created_at'=>'2019-12-14 14:23:24',
            'updated_at'=>'2019-12-14 14:23:24']
        ]);
    }
}
