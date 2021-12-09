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
    protected $API_KEY = "e017ebb8a6a65ad9c26acf1eb955aaa8a334da8e1530cb9a7e522f1738818a21";

    /**
     * The index method handles the home route data.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $from = $request->get('from');
        $to = $request->get('to');

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

            $data[$competition->id] = [
                'league_name' => $competition->league_name,
                'matches' => $response
            ];
        }

        return response()
            ->json([
                $data
            ]);
    }
}
