<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Traits\Transformable;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DisplayRelatedContentUnits extends Controller
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
        $uri = urldecode($request['uri']);

        // Decode type param and replace # with :
        $type = str_replace('#', ':', urldecode($request['type']));

        $data = $this->api->searchByUri($type, $uri);
        $data = $this->transformContentUnit($data);

        return view('display', compact('data'));
    }

}
