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
}
