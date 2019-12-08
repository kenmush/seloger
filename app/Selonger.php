<?php

namespace App;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

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
                $response = $client->request('GET', "https://www.seloger.com/list.htm?projects=2&types=1%2C2&natures=1%2C2&places=%5B%7Bci%3A{$postcode}%7D%5D&enterprise=0&qsVersion=1.0&LISTING-LISTpg={$page}", [
                    'headers' => [
                        'authority' => 'www.seloger.com',
                        'pragma' => 'no-cache',
                        'cache-control' => 'no-cache',
                        'dnt' => 1,
                        'upgrade-insecure-requests' => 1,
                        'sec-fetch-user' => '?1',
                        'origin' => 'www.seloger.com',
                        'sec-fetch-site' => 'none',
                        'sec-fetch-mode' => 'navigate',
                        'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.10s Safari/537.36',
                        'referer' => 'https://www.seloger.com'
                    ],
                    'cookies' => $jar,
                                        'proxy' => [
                                            'https' => '99.126.106.177:80',
                    //                        'http' => '180.210.222.117:1080',
                                        ]
                ]);
                $res = $response->getBody()->getContents();
                preg_match_all('/{("cards").*(?=;window\.tags)/', $res, $output_array2);


                $date = date('Y-m-d');
                if (!isset($output_array2[0][0])) {
                    continue;
                }
                $data = collect(json_decode($output_array2[0][0]));
                $totalpages = round($data['navigation']->counts->count / 25, 0);
                $results = array_merge($results, $data['cards']->list);
                $page++;
            } catch (GuzzleException $e) {
            }
        } while ($page <= $totalpages);
        $tosave = collect($results)->each(static function ($card) {
            if (!isset($card->classifiedURL)) {
                return;
            }
            $locate = $card->cityLabel . $card->districtLabel;
            $values = Str::replaceLast('€', '', $card->pricing->squareMeterPrice);
            $perSquareMetre = preg_replace('/\s/u', '', $values);
            $unit = new \App\Results();
            $unit->website = 'seloger';
            $unit->squareMeterPrice = $perSquareMetre ?? '';
            $unit->price = $card->pricing->rawPrice ?? '';
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
