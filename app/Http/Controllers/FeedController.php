<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Traits\Transformable;
use Exception;
use GuzzleHttp\Client;

class FeedController extends Controller
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
     * Generate RSS feed
     *
     * @throws Exception
     */
    public function rss()
    {
        $recentEntries = $this->api->getStoredJSONData();
        $recentEntries = $recentEntries->take(20);

        return response()
            ->view('rss', ['recentEntries' => $recentEntries])
            ->header('Content-Type', 'text/xml');
    }
}
