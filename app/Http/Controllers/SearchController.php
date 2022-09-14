<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Traits\Transformable;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    use Transformable;

    protected $api;

    /**
     * @param  Client  $client
     */
    public function __construct(Client $client)
    {
        $this->api = new ApiResource($client);
    }

    /**
     * @param  Request  $request
     * @return Factory|View
     * @throws Exception
     */
    public function index(Request $request)
    {
        $q = $request['q'] ?: '';
        $mode = $request['mode'] ?: 'begin';

        $data = $this->api->search($q, $mode);

        $contentUnits = $this->transformContentUnit($data);

        return view('search', ['data' => $contentUnits]);
    }

}
