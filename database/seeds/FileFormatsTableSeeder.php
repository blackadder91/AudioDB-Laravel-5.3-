<?php

use Illuminate\Database\Seeder;
use App\FileFormat;

class FileFormatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['FLAC', 'APE', 'WV'];

        foreach($titles as $t)
        {
            $m = new FileFormat();
            $m->title = $t;
            $m->slug = str_slug($t, '-');
            $m->save();
        }
    }
}
