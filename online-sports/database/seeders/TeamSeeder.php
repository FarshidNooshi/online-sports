<?php

namespace Database\Seeders;

use App\Models\Competition;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    // Website API key
    protected $API_KEY = "bad871a77b653b7010bc3ce2852fac3b972badd1e198c3fc6aaa06edce3b7d64";

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competitions = Competition::all();

        foreach ($competitions as $competition) {
            $league_id = $competition->league_id;
            $APIkey = $this->API_KEY;
            $URL = "https://apiv3.apifootball.com/?action=get_teams&league_id=$league_id&APIkey=$APIkey";

            $curl = curl_init($URL);
            curl_setopt($curl, CURLOPT_URL, $URL);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($resp, true);

            foreach ($response as $team) {
                Team::query()
                    ->where('team_key', '=', $team['team_key'])
                    ->firstOrCreate([
                        'team_key' => $team['team_key'],
                        'team_name' => $team['team_name'],
                        'team_badge' => $team['team_badge'],
                        'league_id' => $league_id,
                    ]);
            }
        }
    }
}
