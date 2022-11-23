<?php

namespace App\Console\Commands;

use App\Http\Resources\ApiResource;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use JsonException;

class LoadDataFromAPI extends Command
{
    protected $client;

    protected $baseURI;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stores data from Knowledge Browser REST API in a JSON file.';

    /**
     * Create a new command instance.
     *
     * @param  Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->baseURI = config('guzzle.default.base_uri').':9090/KB/';

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     *
     * @throws JsonException
     */
    public function handle()
    {
        Log::critical('Inside LoadDataFromAPI.');

        $data = $this->getAll();

        Storage::put('mondeca-db.json', json_encode($data));

        Log::critical('Done LoadDataFromAPI: retrieved '.count($data).' records');

        return null;
    }

    /**
     * @return mixed
     *
     * @throws JsonException
     */
    public function getAll() // Get All Content Units
    {
        $response = $this->client->put($this->baseURI.'search',
            [
                'json' => [
                    'offset' => 0,
                    'size' => ApiResource::RESULT_SIZE,
                    'q' => '',
                    'mode' => 'full',
                    'type' => 'pub:Content_Unit',
                ],
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }
}
