<?php

use Illuminate\Database\Seeder;
use App\Models\Question;

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
            ['description' => '一曲めをおしえてください',
            'url' => '278381162',
            'resolution' => '1',
            'user_id' => '2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            ['description' => 'この曲教えて',
            'url' => 'https://www.youtube.com/embed/fmAH4-_TaDs',
            'resolution' => '1',
            'user_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),

            ],
            ['description' => 'あの曲教えて',
            'url' => 'https://www.youtube.com/embed/aTjzcPFLEYY',
            'resolution' => '0',
            'user_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            ['description' => 'その曲教えて',
            'url' => 'https://www.youtube.com/embed/sNLkY3C5bV0',
            'resolution' => '0',
            'user_id' => '1',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            ['description' => 'どの曲教えて',
            'url' => 'https://www.youtube.com/embed/KwUxoC0w4Yo',
            'resolution' => '0',
            'user_id' => '2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],
            ['description' => 'あそこの曲教えて',
            'url' => 'https://www.youtube.com/embed/kWkNvEr3DB8',
            'resolution' => '1',
            'user_id' => '2',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ],

        ]);
    }
}
