<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Handling the teams functionalities.
 *
 */
class TeamController extends Controller
{
    // Website API key
    protected $API_KEY = "e017ebb8a6a65ad9c26acf1eb955aaa8a334da8e1530cb9a7e522f1738818a21";

    /**
     * Getting the list of all teams for a user.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $teams = Team::all();
        $user_teams = Auth::user()
            ->teams(Auth::id());

        foreach ($teams as $team) {
            $flag = false;
            foreach ($user_teams as $u_team) {
                if ($team->team_key == $u_team->team_key)
                    $flag = true;
            }
            $team['favorite'] = $flag;
        }
        
        $teams = $teams->sortBy(function ($team) {
            return -1 * $team->favorite;
        });

        return response()
            ->json([
                'html' => view('components.team.team', [
                    'teams' => $teams
                ])->render()
            ]);
    }

    /**
     * Get a team profile by its team key.
     *
     * @param $team_key
     *
     */
    public function show($team_key)
    {
        $team = Team::query()
            ->where('team_key', '=', $team_key)
            ->firstOrFail();

        $from = '2021-8-13';
        $to = '2022-5-22';

        $league_id = $team->league_id;
        $APIkey = $this->API_KEY;
        $URL = "https://apiv3.apifootball.com/?action=get_events&from=$from&to=$to&league_id=$league_id&APIkey=$APIkey";

        $curl = curl_init($URL);
        curl_setopt($curl, CURLOPT_URL, $URL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $resp = curl_exec($curl);
        curl_close($curl);

        $response = json_decode($resp, true);
        $obj = [];

        foreach ($response as $match) {
            if ($match['match_hometeam_id'] == $team->team_key || $match['match_awayteam_id'] == $team->team_key) {
                $obj[] = $match;
            }
        }

        return view('components.team.team-detail', [
                    'team' => $team,
                    'matches' => $obj
                ])->render();
    }


    /**
     * Getting top 10 popular teams of our website.
     *
     */
    public function top10()
    {
        $top_keys = DB::table('teams_users')
            ->select('team_key', DB::raw('count(user_id) as total'))
            ->groupBy('team_key')
            ->orderBy('total', 'desc')
            ->limit(10)
            ->get();

        $teams = collect();
        foreach ($top_keys as $key) {
            $team = Team::query()
                ->where('team_key', '=', $key->team_key)
                ->first();
            $team['popularity'] = $key->total;
            $teams->add($team);
        }

        return view('top-ten', [
            'teams' => $teams
        ]);
    }
}
