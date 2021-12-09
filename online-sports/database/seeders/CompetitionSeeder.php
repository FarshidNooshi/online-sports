<?php

namespace Database\Seeders;

use App\Models\Competition;
use Illuminate\Database\Seeder;

class CompetitionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Italy
        Competition::factory()
            ->create([
                'league_id' => '207',
                'league_name' => 'Serie A',
                'league_badge' => 'https://apiv3.apifootball.com/badges/logo_leagues/207_serie-a.png'
            ]);
        // Spain
        Competition::factory()
            ->create([
                'league_id' => '302',
                'league_name' => 'La Liga',
                'league_badge' => 'https://apiv3.apifootball.com/badges/logo_leagues/302_la-liga.png'
            ]);
        // England
        Competition::factory()
            ->create([
                'league_id' => '152',
                'league_name' => 'Primer League',
                'league_badge' => 'https://apiv3.apifootball.com/badges/logo_leagues/152_premier-league.png'
            ]);
        // France
        Competition::factory()
            ->create([
                'league_id' => '168',
                'league_name' => 'League 1',
                'league_badge' => 'https://apiv3.apifootball.com/badges/logo_leagues/168_ligue-1.png'
            ]);
        // Germany
        Competition::factory()
            ->create([
                'league_id' => '175',
                'league_name' => 'Bundesliga',
                'league_badge' => 'https://apiv3.apifootball.com/badges/logo_leagues/175_bundesliga.png'
            ]);
        // Iran
        Competition::factory()
            ->create([
                'league_id' => '195',
                'league_name' => 'Persian Gulf Pro League',
                'league_badge' => 'https://apiv3.apifootball.com/badges/logo_leagues/195_persian-gulf-pro-league.png'
            ]);
        // UEFA
        Competition::factory()
            ->create([
                'league_id' => '3',
                'league_name' => 'UEFA Champions League',
                'league_badge' => 'https://apiv3.apifootball.com/badges/logo_leagues/3_uefa-champions-league.png'
            ]);
        // Euro
        Competition::factory()
            ->create([
                'league_id' => '4',
                'league_name' => 'UEFA Europa League',
                'league_badge' => 'https://apiv3.apifootball.com/badges/logo_leagues/4_uefa-europa-league.png'
            ]);
    }
}
