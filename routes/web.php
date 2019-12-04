<?php

use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/exportxls', function () {
    $date = date('dmy');
    return Excel::download(new \App\Exports\ListingExport, "{$date}_selogerSearch.xlsx");
});

Route::resource('city', 'CityController');

Route::get('/getproperties', function () {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://www.seloger.com/list.htm?projects=2&types=1,2&natures=1,2&places=[{ci:690381}]&enterprise=0&qsVersion=1.0', [
        'headers' => [
            'cache-control' => 'no-cache',
            'pragma' => 'no-cache',
            'authority' => 'www.seloger.com',
            'origin' => 'www.seloger.com',
            'sec-fetch-site' => 'same-origin',
            'sec-fetch-mode' => 'cors',
            'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36',
            'referer' => 'https://www.seloger.com',
            'dnt' => '1',
        ],
        'proxy' => [
            'http' => '151.253.92.173:8080',
            'https' => '151.253.92.173:8080',
        ]
    ]);
    $res = $response->getBody()->getContents();
//    echo $res;
    preg_match_all('/{("cards").*(?=;window\.tags)/', $res, $output_array2);
    $date = date('Y-m-d');
    file_put_contents(public_path("$date.json"), (string)$output_array2[0][0]);
    dd(json_decode($output_array2[0][0]));
});

Route::get('properties', function () {
//    $date = date('Y-m-d');
//    $data =file_get_contents(public_path("$date.json"));
//    $new = json_decode($data);
    $results = \App\Results::where('squareMeterPrice', '<', 3000)->get();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('mail', function () {
    $date = date('dmy');
    $attachment = Excel::download(new \App\Exports\ListingExport(), "{$date}_selogerSearch.xlsx")->getFile();
    Mail::to(['kenmsh@gmail.com','coolivingimmo@gmail.com'])->send(new \App\Mail\SendExcel());
    return new \App\Mail\SendExcel();
});

Route::get('ju', function () {
    phpinfo();
//    $mush = \App\Results::find(2);
//    return $mush->squareMeterPrice;
});
