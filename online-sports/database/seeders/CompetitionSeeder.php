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
                'league_name' => 'Serie A'
            ]);
        // Spain
        Competition::factory()
            ->create([
                'league_id' => '302',
                'league_name' => 'La Liga'
            ]);
        // England
        Competition::factory()
            ->create([
                'league_id' => '152',
                'league_name' => 'Primer League'
            ]);
        // France
        Competition::factory()
            ->create([
                'league_id' => '168',
                'league_name' => 'League 1'
            ]);
        // Germany
        Competition::factory()
            ->create([
                'league_id' => '175',
                'league_name' => 'Bundesliga'
            ]);
        // Iran
        Competition::factory()
            ->create([
                'league_id' => '195',
                'league_name' => 'Persian Gulf Pro League'
            ]);
        // UEFA
        Competition::factory()
            ->create([
                'league_id' => '3',
                'league_name' => 'UEFA Champions League'
            ]);
        // Euro
        Competition::factory()
            ->create([
                'league_id' => '4',
                'league_name' => 'UEFA Europa League'
            ]);
    }
}
