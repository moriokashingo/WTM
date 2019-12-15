<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'resolution' => '1',
            'user_id' => '1',
            ],
            ['description' => 'あの曲教えて',
            'resolution' => '0',
            'user_id' => '1',
            ],
            ['description' => 'その曲教えて',
            'resolution' => '1',
            'user_id' => '2',
            ],
            ['description' => 'どの曲教えて',
            'resolution' => '0',
            'user_id' => '2',
            ],
            ['description' => 'あそこの曲教えて',
            'resolution' => '1',
            'user_id' => '2',
            ],
        ]);
    }
}
