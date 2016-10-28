<?php

use Illuminate\Database\Seeder;
use App\ArchDisc;

class ArchDiscsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['LOSSLESS_001', 'LOSSLESS_002'];

        foreach($titles as $t)
        {
            $m = new ArchDisc();
            $m->title = $t;
            $m->slug = str_slug($t, '-');
            $m->save();
        }
    }
}
