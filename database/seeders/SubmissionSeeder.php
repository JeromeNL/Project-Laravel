<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submissions = [
            [
                'title' => 'Weiland met laagstaande zon',
                'description' => 'Een weide met een laagstaande zon. Je ziet de grassen wapperen.',
                'submission_url' => 'https://img.freepik.com/free-photo/wide-angle-shot-single-tree-growing-clouded-sky-during-sunset-surrounded-by-grass_181624-22807.jpg',
                'submission_image' => '',
                'user_id' => 1,
                'competition_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Waterval',
                'description' => 'Een groot meer, met daarbij een waterval. De kleuren accentueren perfect.',
                'submission_url' => 'https://wallpapers.com/images/featured/2ygv7ssy2k0lxlzu.jpg',
                'submission_image' => '',
                'user_id' => 2,
                'competition_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Gitarist',
                'description' => 'Ik speel al sinds mijn 18e gitaar. Dit is een foto van mij tijdens een optreden.',
                'submission_url' => 'https://k18.media/news/2021/25118-01252021143017.jpg',
                'submission_image' => '',
                'user_id' => 3,
                'competition_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Drumsessie',
                'description' => 'Hier zie je mij drummen. Ik ben een drummer van beroep.',
                'submission_url' => 'https://nationaltoday.com/wp-content/uploads/2020/11/National-Drummer-Day-1.jpg',
                'submission_image' => '',
                'user_id' => 4,
                'competition_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Najib Amhali',
                'description' => 'Hoewel hij niet jong meer is, wil ik Najib toch graag aandragen als een van de beste comedians van Nederland.',
                'submission_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9f/Najib_Amhali_-_Daten_-_Klassieker.webm_02.jpg/800px-Najib_Amhali_-_Daten_-_Klassieker.webm_02.jpg',
                'submission_image' => '',
                'user_id' => 5,
                'competition_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Hans Teeuwen',
                'description' => 'We kennen hem allemaal. Roerbakei, roerbakei...',
                'submission_url' => 'https://media.nu.nl/m/djhxn9uax80s_wd1280/hans-teeuwen-keert-na-vier-jaar-met-nieuw-programma-terug-in-theater.jpg',
                'submission_image' => '',
                'user_id' => 6,
                'competition_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tuin vol met bloemen',
                'description' => 'Dit is een prachtige tuin, vol met bloemen.',
                'submission_url' => 'https://tuinseizoen.com/wp-content/uploads/sites/6/2014/12/2-tuin1-f22.jpg',
                'submission_image' => '',
                'user_id' => 1,
                'competition_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tuin met zwembad',
                'description' => 'In mijn tuin vind je een zwembad.',
                'submission_url' => 'https://www.sparqtuinen.nl/cache/com_zoo/images/Moderne_tuin_met_zwembad_strak_en_stijlvol_83727ce6be05f68859c8d26770a57c56.jpg',
                'submission_image' => '',
                'user_id' => 2,
                'competition_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Robotdans',
                'description' => 'Hier zie je ons dansen in robotstijl, met gepaste outfits.',
                'submission_url' => 'https://www.events.nl/sites/default/files/styles/650x416/public/LeDgends.jpg?itok=ShEtaG3Q',
                'submission_image' => '',
                'user_id' => 2,
                'competition_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Hiphop',
                'description' => 'Aanschouw: hier dansen we met een groep van 10 personen in hiphopstijl.',
                'submission_url' => 'https://www.dancewavescompetition.com/media/images/20170808072416_home_banner_10.jpg',
                'submission_image' => '',
                'user_id' => 2,
                'competition_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('submissions')->insert($submissions);
    }
}
