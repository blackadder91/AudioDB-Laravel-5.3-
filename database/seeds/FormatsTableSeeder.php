<?php

use Illuminate\Database\Seeder;
use App\Format;

class FormatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [['Audio Disc','CD'], ['Super Audio Disc','SACD'], ['Vinyl','LP'], ['Digital Download','Digital']];

        foreach($titles as $t)
        {
            $m = new Format();
            $m->title = $t[0];
            $m->title_short = $t[1];
            $m->slug = str_slug($t[1], '-');
            $m->save();
        }
    }
}
