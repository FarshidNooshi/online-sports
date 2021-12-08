<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Country;
use App\Models\Team;
use Illuminate\Http\JsonResponse;

/**
 * Web controller handles the requests API.
 *
 */
class WebController extends Controller
{
    /**
     * The index method handles the home route data.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $countries = Country::all();
        $competitions = Competition::all();
        $teams = Team::all();

        return response()
            ->json([
                'countries' => $countries,
                'competitions' => $competitions,
                'teams' => $teams
            ]);
    }
}
