<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Traits\Transformable;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DetailController extends Controller
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
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $uri = urldecode($request['uri']);

        $data = $this->api->getTopics($uri);

        $title = $data['label'][0];
        $data = $data['properties'];


        if (empty($data)) {
            toastr($this->API_ERROR_MSG, 'error');
            $data = [];
        }

        return view('detail', compact('uri'))->with(compact('data'))->with(compact('title'));
    }
}
