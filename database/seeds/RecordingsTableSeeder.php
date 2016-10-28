<?php

use Illuminate\Database\Seeder;
use App\Recording;

class RecordingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = Recording::create(
          [
              'title' => 'Master Of Puppets',
              'slug' => str_slug('Metallica - Master Of Puppets', '-'),
              'artist_id' => 2,
              'release_date' => date("1986-01-01"),
              'label_id' => 1,
              'album_type_id' => 1,
              'genre_id' => 18
          ]
        );
        $m->tags()->sync([1, 4, 6, 17]);

        $m = Recording::create(
            [
                'title' => 'The Essential',
                'slug' => str_slug('Michael Jackson - The Essential', '-'),
                'artist_id' => 3,
                'release_date' => date("2004-01-01"),
                'label_id' => 2,
                'album_type_id' => 2,
                'genre_id' => 12
            ]
        );
        $m->tags()->sync([4, 10]);

        $m = Recording::create(
            [
                'title' => 'The Wall',
                'slug' => str_slug('Pink Floyd - The Wall', '-'),
                'artist_id' => 1,
                'release_date' => date("1978-01-01"),
                'label_id' => 2,
                'album_type_id' => 1,
                'genre_id' => 14
            ]
        );
        $m->tags()->sync([6, 3, 7, 8, 11, 16, 18]);
    }
}
