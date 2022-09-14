<?php

namespace App\Http\Controllers;

use App\Http\Resources\ApiResource;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrowseBySubjectController
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
        return view('browse.subject');
    }

    /**
     * @return Collection
     */
    public function getParents(): Collection
    {
        $collection = collect($this->api->getParents());

        $collection->transform(function ($item) {
            $item['id'] = $item['uri'];
            $item['text'] = ucwords($item['label']);
            $item['children'] = true;
            $item['parent'] = '#';

            unset($item['uri'], $item['label'], $item['childrenNb']);

            return $item;
        });

        return $collection;
    }

    /**
     * @param $child
     * @param  null  $parent
     * @return Collection
     */
    public function getChildren($child, $parent = null): Collection
    {
        $startsWith = Str::startsWith($child, 'http://');

        if (!$startsWith) {
            $child = 'itm:n#_'.$child;
        }

        if ($parent) {
            $parent = 'itm:n#_'.$parent;
        }

        $array = $this->api->getChildren($child, $parent);

        $collection = collect($array['data']);

        $collection->transform(static function ($item, $parent) {
            $item['id'] = $item['uri'];
            $item['text'] = ucwords(strtolower($item['label']));
            if ($item['hasChild'] > 0) {
                $item['hasChild'] = true;
            } else {
                $item['hasChild'] = false;
            }
            $item['children'] = $item['hasChild'];
            $item['tooltip'] = $item['text'];

            if ($parent) {
                $item['parent'] = $parent;
            }

            unset($item['uri'], $item['label'], $item['hasChild']);

            return $item;
        });

        return $collection;
    }

    /**
     * @return Factory|View
     */
    public function post()
    {
        return view('browse.subject', ['data' => []]);
    }
}
