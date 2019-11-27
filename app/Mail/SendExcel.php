<?php

namespace App\Mail;

use App\Exports\ListingExport;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;

class SendExcel extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $date = date('dmy');
        $today = today()->toFormattedDateString();
        $time = date('h:m');
        return $this->markdown('mail.sendexcel')->subject("Seloger Search { $today } at { $time }")->attach(
            Excel::download(
                new ListingExport(),
                "{$date}_Seloger.xlsx"
            )->getFile(), ['as' => "{$date}_Seloger.xlsx"]
        );
    }
}
