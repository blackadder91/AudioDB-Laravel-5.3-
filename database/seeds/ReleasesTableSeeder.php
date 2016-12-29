<?php

use Illuminate\Database\Seeder;
use App\Release;

class ReleasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'slug' => 'pink-floyd-the-wall-8312432',
                'recording_id' => 3,
                'label_id' => 3,
                'format_id' => 1,
                'country_id' => 2,
                'year' => 1994,
                'catalog_no' => '8312432',
                'isbn' => '9326165001449',
                'notes' => 'Remastered'
            ],
            [
                'slug' => 'michael-jackson-the-essential-5204222',
                'recording_id' => 2,
                'label_id' => 2,
                'format_id' => 1,
                'country_id' => 2,
                'year' => 2004,
                'catalog_no' => '5204222',
                'isbn' => '5099752042227',
                'notes' => ''
            ],
        ];

        foreach ($data as $d) {
            Release::create($d);
        }
    }
}
