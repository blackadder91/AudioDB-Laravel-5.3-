<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['gloomy', '60s', '70s', '80s', '90s', 'existential', 'melancholic', 'sad', 'romance',
            'upbeat', 'epic', 'introspection', 'loss/grief', 'nihilistic', 'angst', 'cynical/sarcastic',
            'aggresive', 'theatrical'];

        foreach($titles as $t)
        {
            Tag::create([
               'title' => $t,
                'slug' => str_slug($t, '-'),
            ]);
        }
    }
}
