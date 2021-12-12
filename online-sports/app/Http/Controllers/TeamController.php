<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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

        return response()
            ->json([
                'html' => view('components.team.team', [
                    'teams' => $teams
                ])->render()
            ]);
    }

    /**
     * Get a team profile.
     *
     * @param $team_key
     * @return JsonResponse
     */
    public function show($team_key): JsonResponse
    {
        $team = Team::query()
            ->where('team_key', '=', $team_key)
            ->first();


        return response()
            ->json([
                $team
            ]);
    }
}
