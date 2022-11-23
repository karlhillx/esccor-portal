<?php

namespace App\Http\Resources;

use App\Traits\Transformable;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ApiResource
{
    use Transformable;

    public const RESULT_SIZE = '5000';

    public const LANGUAGE = '&dataLang=EN';

    protected $client;

    protected $baseURI;

    /**
     * ApiResource constructor.
     *
     * @param  Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->baseURI = config('guzzle.default.base_uri').':9090/KB/';
    }

    /**
     * @param $term
     * @param $mode
     * @return mixed
     */
    public function search($term, $mode)
    {
        return Http::put($this->baseURI.'search',
            [
                'offset' => 0,
                'size' => self::RESULT_SIZE,
                'q' => $term,
                'mode' => $mode,
                'type' => 'pub:Content_Unit',
            ]
        )->json();
    }

    /**
     * @param $type
     * @param $uri
     * @return mixed
     */
    public function searchByUri($type, $uri)
    {
        switch ($type) {
            case 'contributor':
                $type = 'dc:contributor';
                break;
            case 'contributor2':
                $type = 'dc:contributor2';
                break;
            case 'creator':
                $type = 'dc:creator';
                break;
            case 'subject':
                $type = 'dcterms:subject';
                break;
            case 'model:hasPlatformSatellite':
                $type = 'dcterms:platform-satellite';
                break;
            default:
        }

        $response = $this->client->put($this->baseURI.'search',
            [
                'json' => [
                    'offset' => 0,
                    'size' => self::RESULT_SIZE,
                    'q' => '',
                    'filters' => [
                        $type.'.value' => [
                            'type' => 'terms',
                            'params' => [
                                'values' => [
                                    $uri,
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        );

        return json_decode($response->getBody()->getContents(), true, 512);
    }

    /**
     * @return SessionManager|Store|Collection|mixed
     *
     * @throws Exception
     */
    public function getStoredJSONData()
    {
        try {
            $data = json_decode(Storage::get('mondeca-db.json'), true, 512);
        } catch (Exception $e) {
            abort(403, 'Please check if JSON file exists.');
        }

        return $this->transformContentUnit($data);
    }

    /**
     * @param $uri
     * @return mixed
     */
    public function getTopics($uri)
    {
        $uri = urlencode($uri);

        return Http::get($this->baseURI.'topics?vocabUri=http://esccor.gsfc.nasa.gov/concept-scheme/esccor-taxonomy&'
            .self::LANGUAGE.'&applang=en&restrictToVocab=false&uri='.$uri)->json();
    }

    /**
     * @return array
     */
    public function getParents(): array
    {
        $uri = urlencode('http://esccor.gsfc.nasa.gov/concept-scheme/esccor-taxonomy');

        $api = $this->baseURI.'groups/children?'.self::LANGUAGE.'&voc='.$uri;

        return Http::get($this->baseURI.'groups/children?'.$api)->json();
    }

    /**
     * @param $child
     * @param  null  $parent
     * @return array
     */
    public function getChildren($child, $parent = null): array
    {
        $urlString = 'uri='.urlencode($child);

        if ($parent) {
            $parent = '&parent='.urlencode($parent);
        }
        $urlString .= $parent;
        $urlString .= '&descAware=true&dataLang=EN&range=0-19';
        // dd($urlString);

        http://mondeca-webapp-stage.nasawestprime.com:9090/KB/groups/elements?parent=itm%3An%23_144982&descAware=true&dataLang=EN&range=0-19&uri=itm%3An%23_144981
        return Http::get($this->baseURI.'groups/elements?'.$urlString)->json();
    }

    /*public function geAllVocabularies()
     {
        return Http::get($this->baseURI.'vocabularies?getAll=true&'.self::LANGUAGE)->json();
    }*/

    /* public function getCount()
     {
         return Http::get($this->baseURI.'vocabularies?getAll=true&'.self::LANGUAGE)->json()
     }*/
}
