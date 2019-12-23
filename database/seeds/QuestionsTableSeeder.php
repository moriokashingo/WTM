<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('questions')->insert([
            ['description' => 'この曲教えて',
            'url' => 'https://www.youtube.com/embed/fmAH4-_TaDs',
            'resolution' => '1',
            'user_id' => '1',
            ],
            ['description' => 'あの曲教えて',
            'url' => 'https://www.youtube.com/embed/aTjzcPFLEYY',
            'resolution' => '0',
            'user_id' => '1',
            ],
            ['description' => 'その曲教えて',
            'url' => 'https://www.youtube.com/embed/sNLkY3C5bV0',
            'resolution' => '1',
            'user_id' => '2',
            ],
            ['description' => 'どの曲教えて',
            'url' => 'https://www.youtube.com/embed/KwUxoC0w4Yo',
            'resolution' => '0',
            'user_id' => '2',
            ],
            ['description' => 'あそこの曲教えて',
            'url' => 'https://www.youtube.com/embed/kWkNvEr3DB8',
            'resolution' => '1',
            'user_id' => '2',
            ],
        ]);
    }
}
