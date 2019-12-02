<?php

namespace App\Console\Commands;

use App\Mail\Personal;
use App\Mail\SendExcel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendPersonalEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:ken';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail to me';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Mail::to(['kenmsh@gmail.com','coolivingimmo@gmail.com'])->send(new SendExcel());
        return 'Done';
    }
}
