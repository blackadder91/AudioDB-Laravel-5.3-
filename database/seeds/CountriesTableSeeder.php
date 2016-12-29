<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [['United States', 'US'], ['Europe', 'EU'], ['United Kingdom', 'UK'], ['Italy', 'Italy'],['Germany', 'DEU'],['Austria', 'Austria'],['Japan', 'JP'],['Canada', 'Canada'],['', ''],['Argentina', 'Argentina'],];

        foreach ($titles as $t) {
            $m = new Country();
            $m->title = $t[0];
            $m->title_short = $t[1];
            $m->slug = str_slug($t[1], '-');
            $m->save();
        }
    }
}
