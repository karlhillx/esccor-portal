<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use App\Traits\Transformable;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BrowseByDateController extends Controller
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
     * @return Factory|View
     * @throws Exception
     */
    public function index()
    {
        $storedContentUnits = $this->api->getStoredJSONData();

        $start = Carbon::now();
        $end = new Carbon('-29 days');

        $fromDate = $end->endOfDay();
        $toDate = $start->endOfDay();

        $data = $storedContentUnits
            ->where('published', '>', $fromDate->startOfDay())
            ->where('published', '<', $toDate->endOfDay());

        return view('browse.date', ['data' => $data]);
    }

    /**
     * @return Factory|View
     * @throws Exception
     */
    public function post()
    {
        $dates = explode('-', request()->input('daterange'));
//dd($dates);
        $storedContentUnits = $this->api->getStoredJSONData();
//dd($storedContentUnits);
        $fromDate = Carbon::parse(Carbon::createFromFormat('F j, Y', trim($dates[0])));
        $toDate = Carbon::parse(Carbon::createFromFormat('F j, Y', trim($dates[1])));

        $data = $storedContentUnits
            ->where('published', '>', $fromDate->startOfDay())
            ->where('published', '<', $toDate->endOfDay());

        return view('browse.date', ['data' => $data]);
    }

}
