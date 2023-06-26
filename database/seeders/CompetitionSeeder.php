<?php

namespace Database\Seeders;

use App\Models\Enums\CompetitionPublicationStatus;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $competitions = [
            [
                'title' => 'Nederlandse Fotografie Wedstrijd',
                'description' => 'Een fotowedstrijd voor Nederlandse fotografen. De beste foto\'s worden geëxposeerd in het Rijksmuseum.',
                'start_date' => '2023-02-01',
                'end_date' => null,
                'thumbnail_url' => 'https://media-01.imu.nl/storage/hetfotoalbum.nl/3945/wp/Schermafbeelding-2016-11-30-om-11.25.54.png',
                'owner_id' => User::factory()->create()->id,
                'created_at' => now(),
                'updated_at' => now(),
                'publication_status' => CompetitionPublicationStatus::Published->value,
                'ended' => false,
            ],
            [
                'title' => 'Grote Prijs van Rotterdam',
                'description' => 'Een jaarlijkse muziekwedstrijd voor opkomende artiesten uit Rotterdam. De winnaar krijgt een opnamecontract bij een platenmaatschappij.',
                'start_date' => '2023-01-01',
                'end_date' => now()->addDays(10),
                'thumbnail_url' => 'https://www.oprechtemediums.nl/wp-content/uploads/2016/05/muziek-noten.jpg',
                'owner_id' => User::factory()->create()->id,
                'created_at' => now(),
                'updated_at' => now(),
                'publication_status' => CompetitionPublicationStatus::Published->value,
                'ended' => true,
            ],
            [
                'title' => 'De Haagse Cabaretcompetitie',
                'description' => 'Een cabaretwedstrijd voor jong talent uit Den Haag en omgeving. De finalisten treden op in het Diligentia theater.',
                'start_date' => '2023-03-24',
                'end_date' => '2023-03-14',
                'thumbnail_url' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRmka_-OqPOibTVpMDTFzNrpsi-62QAifLFEA&usqp=CAU',
                'owner_id' => User::factory()->create()->id,
                'created_at' => now(),
                'updated_at' => now(),
                'publication_status' => CompetitionPublicationStatus::Published->value,
                'ended' => true,
            ],
            [
                'title' => 'Nationale Tuinontwerpwedstrijd',
                'description' => 'Een wedstrijd voor de beste tuinontwerpen in Nederland. De winnaar krijgt een geldprijs en zijn ontwerp wordt uitgevoerd in een park in Amsterdam.',
                'start_date' => now()->subDays(2),
                'end_date' => now()->addDays(30),
                'thumbnail_url' => 'https://www.puurgezond.nl/fileadmin/_processed_/9/2/csm_Tuinieren_bb48c2f51f.jpg',
                'owner_id' => User::factory()->create()->id,
                'created_at' => now(),
                'updated_at' => now(),
                'publication_status' => CompetitionPublicationStatus::Published->value,
                'ended' => true,
            ],
            [
                'title' => 'Amsterdamse Danscompetitie',
                'description' => 'Een danswedstrijd voor jonge talenten uit Amsterdam. De winnaar krijgt een optreden tijdens het Amsterdam Dance Event.',
                'start_date' => '2023-02-01',
                'end_date' => '2023-03-01',
                'thumbnail_url' => 'https://dansmagazine.nl/sites/default/files/styles/schermbreed/public/een_mooie_groepsdans.jpg?itok=dHvdzHmi',
                'owner_id' => User::factory()->create()->id,
                'created_at' => now(),
                'updated_at' => now(),
                'publication_status' => CompetitionPublicationStatus::Draft->value,
                'ended' => true,
            ],
            [
                'title' => 'Competitie zonder thumbnail',
                'description' => 'Dit is een competitie zonder een werkende thumbnail',
                'start_date' => now()->addDays(2),
                'end_date' => now()->addDays((6)),
                'thumbnail_url' => 'https://ditplaatjebestaatniet.png',
                'owner_id' => User::factory()->create()->id,
                'created_at' => now(),
                'updated_at' => now(),
                'publication_status' => CompetitionPublicationStatus::Published->value,
                'ended' => false
            ]];

        DB::table('competitions')->insert($competitions);

    }
}
