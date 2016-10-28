<?php

use Illuminate\Database\Seeder;
use App\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artists = [
            [
                'Pink Floyd',
                true,
                'Pink Floyd were an English rock band formed in London. They achieved international acclaim with their progressive and psychedelic music. Distinguished by their use of philosophical lyrics, sonic experimentation, extended compositions and elaborate live shows, they are one of the most commercially successful and influential groups in the history of popular music.'
            ],
            [
                'Metallica',
                true,
                "Metallica is an American heavy metal band formed in Los Angeles, California. Metallica was formed in 1981 when vocalist/guitarist James Hetfield responded to an advertisement posted by drummer Lars Ulrich in a local newspaper. The band's current line-up comprises founding members Hetfield and Ulrich, longtime lead guitarist Kirk Hammett and bassist Robert Trujillo. Guitarist Dave Mustaine and bassists Ron McGovney, Cliff Burton and Jason Newsted are former members of the band."
            ],
            [
                'Michael Jackson',
                false,
                'Michael Joseph Jackson (August 29, 1958 - June 25, 2009) was an American singer, songwriter, record producer, dancer, and actor. Called the King of Pop, his contributions to music, dance and fashion along with his publicized personal life made him a global figure in popular culture for over four decades.'
            ]
        ];

        foreach($artists as $a)
        {
            Artist::create([
                'title' => $a[0],
                'slug' => str_slug($a[0], '-'),
                'is_band' => $a[1],
                'description' => $a[2]
            ]);
        }
    }
}
