<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Handling the user routes for teams.
 *
 */
class UserController extends Controller
{
    // Website API key
    protected $API_KEY = "e017ebb8a6a65ad9c26acf1eb955aaa8a334da8e1530cb9a7e522f1738818a21";

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $from = $request->get('from', date('Y-m-d'));
        $to = $request->get('to', date('Y-m-d'));

        $teams = Auth::user()->teams(Auth::id());
        $data = [];

        foreach ($teams as $team) {
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
            $obj['team'] = $team;

            foreach ($response as $match) {
                if ($match['match_hometeam_id'] == $team->team_key || $match['match_awayteam_id'] == $team->team_key) {
                    $obj['match'][] = $match;
                }
            }

            $data[] = $obj;
        }

        return response()
            ->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $res = DB::table('teams_users')
            ->where('user_id', '=', Auth::id())
            ->where('team_key', '=', $request->get('team_id'))
            ->exists();

        if ($res) {
            return response()
                ->json([
                    'status' => 'FAIL'
                ]);
        }

        DB::table('teams_users')
            ->insert([
               'user_id' => Auth::id(),
               'team_key' => $request->get('team_id')
            ]);

        return response()
            ->json([
                'status' => 'OK'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        DB::table('teams_users')
            ->where('user_id', '=', Auth::id())
            ->where('team_id', '=', $request->get('team_id'))
            ->delete();

        return response()
            ->json([
                'status' => 'OK'
            ]);
    }
}
