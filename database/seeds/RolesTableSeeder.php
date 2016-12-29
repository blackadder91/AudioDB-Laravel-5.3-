<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = [['user', 0], ['admin', 3], ['editor', 1], ['sysadmin', 2],['anonymous', 0]];

        foreach ($titles as $t) {
            Role::create([
               'title' => $t[0],
                'parent_id' => $t[1]
            ]);
        }
    }
}
