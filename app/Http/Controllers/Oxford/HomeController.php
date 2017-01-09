<?php

namespace App\Http\Controllers\Oxford;

use App\Http\Controllers\Controller;
use App\Services\Oxford\OxfordApiClient;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function __construct(OxfordApiClient $client)
    {
        $this->client = $client;
    }

    public function index()
    {
        return view('oxford.home');
    }

    public function search(Request $request)
    {
        try {
            $wordId = strtolower($request->get('word_id'));
            /* @var Collection */
            $data = $this->client->getEntries($wordId);
            return response()->json([
                'ok' => true,
                'data' => $data->map(function ($sense) {
                    return $sense->toArray();
                })->all(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'error' => 'something went wrong.',
            ]);
        }
    }
}
