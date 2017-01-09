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
                'Michael Joseph Jackson (August 29, 1958 - June 25, 2009) was an American singer, songwriter, record producer, dancer, and actor. Called the King of Pop, his contributions to music, dance and fashion along with his publicized personal life made him a global figure in popular culture for over four decades.',
                'dob' => '1958-08-29'
            ],
            [
                'David Bowie',
                false,
                'David Robert Jones, known professionally as David Bowie was an English singer, songwriter and actor. He was a figure in popular music for over five decades, regarded by critics and musicians as an innovator, particularly for his work in the 1970s. His career was marked by reinvention and visual presentation, his music and stagecraft significantly influencing popular music. During his lifetime, his record sales, estimated at 140 million worldwide, made him one of the world\'s best-selling music artists. In the UK, he was awarded nine platinum album certifications, eleven gold and eight silver, releasing eleven number-one albums. In the US, he received five platinum and seven gold certifications. He was inducted into the Rock and Roll Hall of Fame in 1996.',
                'dob' => '1947-01-08'
            ],
            [
                'Brian Eno',
                false,
                'Brian Peter George St John le Baptiste de la Salle Eno, RDI (born 15 May 1948 and originally christened Brian Peter George Eno) is an English musician, composer, record producer, singer, writer, and visual artist. He is best known for his pioneering work in ambient and electronic music as well as his contributions to rock, worldbeat, chance, and generative music styles. A self-described "non-musician", Eno has advocated a methodology of "theory over practice" throughout his career, and has helped to introduce a variety of unique recording techniques and conceptual approaches into contemporary music. He has been described as one of popular music\'s most influential and innovative figures.',
                'dob' => '1948-06-15'
            ],
            [
                'Genesis',
                true,
                'Genesis are an English rock band formed at Charterhouse School, Godalming, Surrey in 1967. The most commercially successful and long-lasting line-up includes keyboardist Tony Banks, bassist/guitarist Mike Rutherford and drummer/singer Phil Collins. Other important members were the original lead singer Peter Gabriel and guitarist Steve Hackett. The band underwent many changes in musical style over its career, from folk music to progressive rock in the 1970s, before moving towards pop at the end of the decade. They have sold 21.5 million RIAA-certified albums in the US and their worldwide sales are estimated to be between 100 million and 150 million.',
            ],
        ];

        foreach ($artists as $a) {
            Artist::create([
                'title' => $a[0],
                'slug' => str_slug($a[0], '-'),
                'is_band' => $a[1],
                'description' => $a[2]
            ]);
        }
    }
}
