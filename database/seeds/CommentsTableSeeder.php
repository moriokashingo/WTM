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
            ['body' => 'remixばーじょんですがどうぞ',
            'url'=>'295416928',
            'question_id'=>'1',
            'user_id'=>'1',
            'created_at'=>'2019-12-14 14:23:24',
            'updated_at'=>'2019-12-14 14:23:24'
        ],
            ['body' => 'これはあの曲ですよ',
            'question_id'=>'2',
            'user_id'=>'1',
            'url'=>'https://www.youtube.com/embed/i9bW0TuhY6A',
            'created_at'=>'2019-12-14 14:23:24',
            'updated_at'=>'2019-12-14 14:23:24'
            ],
            ['body' => '1曲目です',
            'url'=>'https://www.youtube.com/embed/i9bW0TuhY6A',
            'question_id'=>'3',
            'user_id'=>'1',
            'created_at'=>'2019-12-14 14:23:24',
            'updated_at'=>'2019-12-14 14:23:24'
        ],
            ['body' => '二曲目はこれです',
            'url'=>'https://www.youtube.com/embed/Uc2xESpxO2s',
            'question_id'=>'4',
            'user_id'=>'1',
            'created_at'=>'2019-12-14 14:23:24',
            'updated_at'=>'2019-12-14 14:23:24'
        ],

        ]);
    }
}
