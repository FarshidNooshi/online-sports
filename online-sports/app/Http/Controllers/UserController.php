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
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $teams = Auth::user()
            ->teams(Auth::id());

        return response()
            ->json($teams);
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
            ->where('team_key', '=', $request->get('team_key'))
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
               'team_key' => $request->get('team_key')
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
            ->where('team_key', '=', $request->get('team_key'))
            ->delete();

        return response()
            ->json([
                'status' => 'OK'
            ]);
    }
}
