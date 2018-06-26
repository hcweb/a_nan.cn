<?php

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Comment::truncate();
        $mIds = \App\Models\Member::pluck('id');
        $pIds = \App\Models\Post::pluck('id');
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 20; $i++) {
            Comment::create([
                'title' => $faker->sentence,
                'content' => $faker->text($maxNbChars = 500),
                'visitor' => $faker->city,
                'state' => 1,
                'reply' => 0,
                'reply_id' => 0,
                'member_id' => $faker->randomElement(collect($mIds)->toArray()),
                'post_id' => $faker->randomElement(collect($pIds)->toArray())
            ]);
        }
    }
}
