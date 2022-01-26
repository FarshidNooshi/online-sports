<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Web controller handles the requests API.
 *
 */
class WebController extends Controller
{
    // Website API key
    protected $API_KEY = "bad871a77b653b7010bc3ce2852fac3b972badd1e198c3fc6aaa06edce3b7d64";

    /**
     * The index method handles the home route data.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $from = $request->get('from', date('Y-m-d'));
        $to = $request->get('to', date('Y-m-d'));

        $competitions = Competition::all();
        $data = [];

        foreach ($competitions as $competition) {
            $league_id = $competition->league_id;
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
            if (isset($response['error']) && $response['error'] == 404) {
                continue;
            }

            $data[] = [
                'league_name' => $competition->league_name,
                'league_badge' => $competition->league_badge,
                'matches' => $response
            ];
        }

        return response()
            ->json([
                'html' => view('components.match.results-table', [
                    'data' => $data,
                    'show_time' => false
                ])->render()
            ]);
    }
}
