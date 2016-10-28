<?php

use Illuminate\Database\Seeder;
use App\Archive;

class ArchiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $m = new Archive();
        $m->release_id = 1;
        $m->arch_disc_id = 1;
        $m->file_format_id = 1;
        $m->flags = 0;
        $m->save();

        $m = new Archive();
        $m->release_id = 2;
        $m->arch_disc_id = 1;
        $m->file_format_id = 1;
        $m->flags = 0;
        $m->save();
    }
}
