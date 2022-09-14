<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SubjectDetailController
{
    protected $api;

    /**
     * @param  Client  $client
     */
    public function __construct(Client $client)
    {
        $this->api = new ApiResource($client);
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $uri = urldecode(request()->uri);

        $data = $this->api->getTopics($uri);

        return view('subject-detail', compact('uri'))->with(compact('data'));
    }
}
