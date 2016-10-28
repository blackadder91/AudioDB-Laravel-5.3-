<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(FormatsTableSeeder::class);
        $this->call(FileFormatsTableSeeder::class);
        $this->call(LabelsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(AlbumTypesTableSeeder::class);
        $this->call(RecordingsTableSeeder::class);
        $this->call(ReleasesTableSeeder::class);
        $this->call(ArchDiscsTableSeeder::class);
        $this->call(ArchiveTableSeeder::class);
        $this->call(GenresTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(ImageTypesTableSeeder::class);
        $this->call(ImagesTableSeeder::class);

    }
}
