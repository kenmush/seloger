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
        $cities = City::all()->pluck('insee');

        foreach ($cities as $city) {
            $this->info('Scraping for ' . $city);
            $seloger = new Selonger();
            $seloger->search($city);
            $this->info('Finished scraping for '. $city);
        }
        $this->info('Finished scraping the seloger site.');
    }
}
