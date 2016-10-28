<?php

use Illuminate\Database\Seeder;
use App\AlbumType;

class AlbumTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Studio album', 'Compilation', 'Live'];

        foreach($titles as $t)
        {
            $m = new AlbumType();
            $m->title = $t;
            $m->slug = str_slug($t, '-');
            $m->save();
        }
    }
}
