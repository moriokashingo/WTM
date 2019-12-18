<?php

use Illuminate\Database\Seeder;

class QuestiontagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('question_tag')->insert([
            ['question_id' => '1',
            'tag_id' => '1',
            ],
            ['question_id' => '2',
            'tag_id' => '1',
            ],
            ['question_id' => '2',
            'tag_id' => '2',
            ],
            ['question_id' => '3',
            'tag_id' => '3',
            ],
            ]);
    }
}
