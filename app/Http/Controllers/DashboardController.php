<?php

namespace App\Http\Controllers;

use App\Charts\DoughnutChart;
use App\Charts\LineChart;
use App\Http\Resources\ApiResource;
use App\Traits\Transformable;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return Renderable
     * @throws Exception
     */
    public function index(): Renderable
    {
        $storedContentUnits = $this->api->getStoredJSONData();
        $monthCounts = $this->getMonthsYearCounts($storedContentUnits);

        $monthLabels = [];
        $mcounts = [];
        foreach ($monthCounts as $index => $item) {
            $monthLabels[] = $index;
            $mcounts[] = count($item);
        }
        $monthLabels = array_reverse($monthLabels);
        $mcounts = array_reverse($mcounts);

        $lineChart = new LineChart;
        $lineChart->labels($monthLabels);
        $lineChart->loader(true);
        $lineChart->dataset('', 'line',
            $mcounts)->options(['backgroundColor' => '#6cb2eb']);

        $domainCounts = $this->countDomains($storedContentUnits);
        $domains = $domainCounts->sortKeys();

        $countAllRecords = count($storedContentUnits);

        $doughnutChart = new DoughnutChart;
        $doughnutChart->minimalist(true);
        $doughnutChart->labels([$countAllRecords]);
        $doughnutChart->dataset('', 'doughnut', [$countAllRecords])->options([
            'backgroundColor' => [
                'orange',
            ]
        ]);

        if (!session()->has('MondecaData')) {
            toastr()->success('Welcome to the NASA ESCCOR Portal!');
        }

        // Get 20 for the most recent.
        $storedContentUnits = $storedContentUnits->take(20);

        $updated = Storage::lastModified('mondeca-db.json');
        $updated = date('m/d/Y', $updated);

        return view('dashboard', ['count' => $countAllRecords])
            ->with(compact('lineChart'))
            ->with(compact('doughnutChart'))
            ->with(compact('storedContentUnits'))
            ->with(compact('domains'))
            ->with(compact('updated'));
    }

    /**
     * @param  Collection  $collection
     * @return Collection
     */
    public function getMonthsYearCounts(Collection $collection): Collection
    {
        $collection = $collection
            ->groupBy(static function ($item) {
                return $item['published']->format('Y-m');
            });

        return $collection->take(6);
    }

}


