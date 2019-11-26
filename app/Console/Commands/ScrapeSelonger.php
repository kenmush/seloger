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
        $this->line('Started new job: ');
        foreach ($cities as $city) {
            $this->line('Scraping for ' . $city);
            $seloger = new Selonger();
            $seloger->search($city);
            $this->line('Finished scraping for '. $city);
        }
        $this->line('Finished scraping the seloger site.');
    }
}
