<?php

use Illuminate\Database\Seeder;
use App\ImageType;

class ImageTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [
            [null, 'artist_main'],
            [null, 'artist_background'],
            [null, 'recording_main'],
            [null, 'recording_back'],
            [null, 'recording_disc'],
            [null, 'tag_icon'],
            [null, 'genre_icon'],
            [null, 'genre_background'],
            [null, 'misc']
        ];

        foreach ($titles as $t) {
            $m = new ImageType();
            $m->title = $t[0];
            $m->code = $t[1];
            $m->save();
        }
    }
}
