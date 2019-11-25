<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getproperties', function () {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://www.seloger.com/list.htm?types=1%2C2&projects=2&enterprise=0&natures=1%2C2&places=%5B%7Bdiv%3A2238%7D%5D&qsVersion=1.0&LISTING-LISTpg=2', [
        'headers' => [
            'authority' => 'www.seloger.com',
            'origin' => 'www.seloger.com',
            'sec-fetch-site' => 'same-origin',
            'sec-fetch-mode' => 'cors',
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36',
            'referer' => 'https://www.seloger.com'
        ]
    ]);
    $res = $response->getBody()->getContents();

    preg_match_all('/{("cards").*(?=;window\.tags)/', $res, $output_array2);
    $date = date('Y-m-d');
    file_put_contents(public_path("$date.json"), (string)$output_array2[0][0]);
    dd($output_array2[0][0]);
});

Route::get('saveProperties', function () {
    $date = date('Y-m-d');
    $file = file_get_contents(public_path("$date.json"));;

    $data = collect(json_decode($file));
    dd($data);
    $tosave = collect($data['cards']->list)->each(function ($card) {
        $unit = new \App\Results();
        $unit->price = $card->pricing->price ?? '';
        $unit->url = $card->classifiedURL ?? '';
        $unit->postcode = $card->zipCode ?? '';
        $unit->location = $card->cityLabel ?? '';
        $unit->type = $card->estateType ?? '';
        $unit->m2 = $card->tags[2] ?? '';
        $unit->rooms = $card->tags[0] ?? '';
        $unit->bedrooms = $card->tags[1] ?? '';
        $unit->description = $card->description ?? '';
        $unit->save();
    });
});
Route::get('/mutisya', function () {
    $seloner = new \App\Selonger();
    return $seloner->search('GET');
});

