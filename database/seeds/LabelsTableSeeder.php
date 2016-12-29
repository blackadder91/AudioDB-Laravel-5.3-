<?php

use Illuminate\Database\Seeder;
use App\Label;

class LabelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [['Elektra Records', 'Elektra'], ['Legacy Records', 'Legacy'], ['EMI', 'EMI']];

        foreach ($titles as $t) {
            $m = new Label();
            $m->title = $t[0];
            $m->title_short = $t[1];
            $m->slug = str_slug($t[1], '-');
            $m->save();
        }
    }
}
