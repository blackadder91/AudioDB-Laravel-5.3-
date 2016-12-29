<?php

use Illuminate\Database\Seeder;
use App\Image;
use App\ImageType;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artist_main = ImageType::where('code', 'artist_main')->first()->id;
        $recording_main = ImageType::where('code', 'recording_main')->first()->id;

        $data = [
            [
                'title' => 'Metallica',
                'slug' => str_slug('Metallica'),
                'filename' => 'metallica.jpg',
                'image_type_id' => $artist_main,
                'imageable_id' => 2,
                'imageable_type' => 'App\Artist',
            ],
            [
                'title' => 'Pink Floyd',
                'slug' => str_slug('Pink Floyd'),
                'filename' => 'pink-floyd.jpg',
                'image_type_id' => $artist_main,
                'imageable_id' => 1,
                'imageable_type' => 'App\Artist',
            ],
            [
                'title' => 'Michael Jackson',
                'slug' => str_slug('Michael Jackson'),
                'filename' => 'michael-jackson.jpg',
                'image_type_id' => $artist_main,
                'imageable_id' => 3,
                'imageable_type' => 'App\Artist',
            ],
            [
                'title' => 'Master Of Puppets',
                'slug' => str_slug('Master Of Puppets'),
                'filename' => 'master-of-puppets.png',
                'image_type_id' => $recording_main,
                'imageable_id' => 1,
                'imageable_type' => 'App\Recording',
            ],
            [
                'title' => 'The Wall',
                'slug' => str_slug('The Wall'),
                'filename' => 'the-wall.jpg',
                'image_type_id' => $recording_main,
                'imageable_id' => 3,
                'imageable_type' => 'App\Recording',
            ],
            [
                'title' => 'The Wall',
                'slug' => str_slug('The Wall 8312432'),
                'filename' => 'the-wall-8312432.jpg',
                'image_type_id' => $recording_main,
                'imageable_id' => 3,
                'imageable_type' => 'App\Release',
            ],
            [
                'title' => 'The Essential',
                'slug' => str_slug('The Essential'),
                'filename' => 'mj-the-essential.jpg',
                'image_type_id' => $recording_main,
                'imageable_id' => 2,
                'imageable_type' => 'App\Recording',
            ],

        ];
        
        foreach ($data as $d) {
            Image::create($d);
        }
    }
}
