<?php

namespace App;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class Selonger
{
    public function search($postcode)
    {
        ini_set('max_execution_time', 1000000);
        $page = 1;
        $totalpages = 1;
        $results = [];
        do {

            $client = new \GuzzleHttp\Client();
            $jar = new \GuzzleHttp\Cookie\CookieJar();
            try {
                $response = $client->request('GET', "https://www.seloger.com/list.htm?projects=2&types=1%2C2&natures=1%2C2&places=%5B%7Bci%3A690381%7D%5D&enterprise=0&qsVersion=1.0&LISTING-LISTpg={$page}", [
                    'headers' => [
                        'authority' => 'www.seloger.com',
                        'origin' => 'www.seloger.com',
                        'sec-fetch-site' => 'same-origin',
                        'sec-fetch-mode' => 'cors',
                        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36',
                        'referer' => 'https://www.seloger.com'
                    ],
                    'cookies' => $jar,

                ]);
                $res = $response->getBody()->getContents();
                preg_match_all('/{("cards").*(?=;window\.tags)/', $res, $output_array2);
                $date = date('Y-m-d');
                $data = collect(json_decode($output_array2[0][0]));
                $totalpages = round($data['pagination']->count / 25, 0);
                $results = array_merge($results, $data['cards']->list);
                $page++;
            } catch (ClientException $exception) {
                $response = $exception->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
            }

        } while ($page <= $totalpages);
        $tosave = collect($results)->each(static function ($card) {
            if (!isset($card->classifiedURL)) {
                return;
            }
            $locate = $card->cityLabel .  $card->districtLabel;
            $unit = new \App\Results();
            $unit->website = 'seloger';
            $unit->squareMeterPrice = $card->pricing->squareMeterPrice ?? '';
            $unit->price = $card->pricing->price ?? '';
            $unit->url = $card->classifiedURL ?? '';
            $unit->postcode = $card->zipCode ?? '';
            $unit->location = $locate ?? '';
            $unit->type = $card->estateType ?? '';
            $unit->m2 = $card->tags[2] ?? '';
            $unit->rooms = $card->tags[0] ?? '';
            $unit->bedrooms = $card->tags[1] ?? '';
            $unit->description = $card->description ?? '';
            $unit->save();
        });
        sleep(10);
        return $results;
    }

    public function aggregate($method, array $parameters = []): array
    {

    }

    /**
     * Make an HTTP request to Selonger.
     *
     * @param string $method
     * @param string $path
     * @param array $parameters
     *
     * @return array
     */
    protected function request($method, $path, array $parameters = [])
    {
        //types=1%2C2&projects=2&enterprise=0&natures=1%2C2&places=%5B%7Bdiv%3A2238%7D%5D&qsVersion=1.0
        $response = (new Client)->{$method}('https://www.seloger.com/list.htm?' . ltrim($path, '/'), [
            'headers' => [
                'authority' => 'www.seloger.com',
                'origin' => 'www.seloger.com',
                'sec-fetch-site' => 'same-origin',
                'sec-fetch-mode' => 'cors',
                'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36',
                'referer' => 'https://www.seloger.com'
            ],
            'json' => $parameters,
        ]);

        return json_decode((string)$response->getBody(), true);
    }
}
