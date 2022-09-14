<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Traits\Transformable;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrowseByDomainController extends Controller
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
        return $this->displayDomains($request, 'browse.domain');
    }

    /**
     * @param  Request  $request
     * @return Factory|View
     * @throws Exception
     */
    public function post(Request $request)
    {
        return $this->displayDomains($request, 'browse.domain');
    }

}
