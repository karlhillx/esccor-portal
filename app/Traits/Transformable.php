<?php

namespace App\Traits;

use App\Http\Resources\ApiResource;
use Carbon\Carbon;
use DateTime;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * @property ApiResource api
 */
trait Transformable
{
    public $API_ERROR_MSG = 'Data is not available at this time. Please check the API resource.';

    /**
     * Transformable constructor.
     * @param  Client  $client
     */
    public function __construct(Client $client)
    {
        $this->api = new ApiResource($client);
    }

    /**
     * Get the data from Mondeca and transform to native types and formats.
     *
     * @param $data
     * @return Collection
     * @throws Exception
     */
    public function transformContentUnit($data): Collection
    {
        $contentUnits = new Collection();

        if (!empty($data)) {
            foreach ($data['items'] as $item) {
                // Convert updated epoch to DateTime to Carbon
                $timestamp = $item['fields']['bo:updated_the'][0];
                $datetime = date('Y-m-d H:i:s', substr($timestamp, 0, 10));
                $updated = DateTime::createFromFormat('Y-m-d H:i:s', $datetime);
                try {
                    $updated = new Carbon($updated->format('Y-m-d H:i:s'));
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                    throw $e;
                }

                // Convert published from DateTime to Carbon
                $datetime = $item['fields']['dcterms:issued'][0];
                $published = DateTime::createFromFormat('m-d-Y', $datetime);
                try {
                    $published = new Carbon($published->format('Y-m-d H:i:s'));
                } catch (Exception $e) {
                    Log::error($e->getMessage());
                    throw $e;
                }

                $parsedURL = parse_url($item['fields']['model:originalURL'][0]);
                $entry = [
                    'id' => $item['uri'],
                    'title' => html_entity_decode($item['fields']['rdfs:label'][0]),
                    'abstract' => $item['fields']['model:contentAbstract'][0],
                    'url' => $item['fields']['model:originalURL'][0],
                    'domain' => $parsedURL['host'],
                    'published' => $published,
                    'updated' => $updated,
                ];
                $contentUnits->push($entry);
            }

            $contentUnits = $contentUnits->sortBy('title')->sortByDesc('published');
        } else {
            toastr($this->API_ERROR_MSG, 'error');
        }

        return $contentUnits;
    }

    /**
     * @param  Request  $request
     * @param $route
     * @return Factory|View
     * @throws Exception
     */
    public function displayDomains(Request $request, $route)
    {
        $q = $request['domainq'] ?: '';

        $storedContentUnits = $this->api->getStoredJSONData();

        $domain = $storedContentUnits->where('domain', '=', $q);
        $domainCounts = $this->countDomains($storedContentUnits);
        $domains = $domainCounts->sortKeys();

        return view($route, ['domain' => $domain])->with(compact('domains'));
    }

    /**
     * @param  Collection  $collection
     * @return Collection
     */
    public function countDomains(Collection $collection): Collection
    {
        return $collection->groupBy('domain')->map(static function ($values) {
            return $values->count();
        })->sort()->reverse();
    }
}
