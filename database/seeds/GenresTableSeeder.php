<?php

use Illuminate\Database\Seeder;
use App\Genre;

class GenresTableSeeder extends Seeder
{

    public function insert($data, $parentId = 0)
    {
        $keys = array_keys($data);
        $idx = $parentId;
        foreach ($keys as $k) {
            $idx++;
            if (is_array($data[$k])) {
                $m = new Genre();
                $m->title = $k;
                $m->slug = str_slug($k, '-');
                $m->parent_id = $parentId;
                $m->save();

                $idx = $this->insert($data[$k], $idx);
            } else {
                $m = new Genre();
                $m->title = $data[$k];
                $m->slug = str_slug($data[$k], '-');
                $m->parent_id = $parentId;
                $m->save();
            }
        }

        return $idx;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Avant-garde',
            'Blues',
            'Country',
            'Classical',
            'Easy Listening',
            'Electronic',
            'Jazz' => [
                'Bebop',
                'Fusion',
                'Smooth Jazz'
            ],
            'New Age',
            'Pop/Rock' => [
                'Blues Rock',
                'Progressive Rock',
                'Hard Rock',
                'Metal' => [
                    'Heavy Metal' => [
                        'Thrash Metal',
                        'Speed Metal',
                        'Death Metal',
                        'Black Metal'
                    ],
                    'Pop metal'
                ],
                'R&B',
                'Rap',
                'Vocal'
            ]
        ];

        $this->insert($genres);
    }
}
