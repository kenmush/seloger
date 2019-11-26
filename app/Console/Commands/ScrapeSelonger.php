<?php

namespace App\Console\Commands;

use App\City;
use App\Selonger;
use Illuminate\Console\Command;

class ScrapeSelonger extends Command
{

    protected $signature = 'scrape:seloger';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $cities = City::all();
        foreach ($cities as $city) {
            $this->line('Started new job: ' . $city->city);
            $seloger = new Selonger();
            $seloger->search($city->insee);
            $this->line('Finished scraping for ' . $city->city);
        }
    }
}
