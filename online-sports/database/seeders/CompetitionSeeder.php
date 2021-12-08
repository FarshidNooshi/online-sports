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
                'league_id' => '',
                'league_name' => ''
            ]);
        // Spain
        Competition::factory()
            ->create([
                'league_id' => '',
                'league_name' => ''
            ]);
        // England
        Competition::factory()
            ->create([
                'league_id' => '',
                'league_name' => ''
            ]);
        // France
        Competition::factory()
            ->create([
                'league_id' => '',
                'league_name' => ''
            ]);
        // Germany
        Competition::factory()
            ->create([
                'league_id' => '',
                'league_name' => ''
            ]);
        // Iran
        Competition::factory()
            ->create([
                'league_id' => '',
                'league_name' => ''
            ]);
        // UEFA
        Competition::factory()
            ->create([
                'league_id' => '',
                'league_name' => ''
            ]);
        // Euro
        Competition::factory()
            ->create([
                'league_id' => '',
                'league_name' => ''
            ]);
        // National league
        Competition::factory()
            ->create([
                'league_id' => '',
                'league_name' => ''
            ]);
    }
}
