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

            $curl_options = array(
                CURLOPT_URL => "https://apiv3.apifootball.com/?action=get_events&from=$from&to=$to&league_id=$league_id&APIkey=$APIkey",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_CONNECTTIMEOUT => 5
            );

            $curl = curl_init();
            curl_setopt_array($curl, $curl_options);
            $response = curl_exec($curl);

            $response = (array) json_decode($response);

            $data[$competition->id] = [
                'league_name' => $competition->league_name,
                'matches' => $response
            ];
        }

        return response()
            ->json([
                'data' => $data,
            ]);
    }
}
