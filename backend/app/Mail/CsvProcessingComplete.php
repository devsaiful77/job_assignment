<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CsvProcessingComplete extends Mailable
{
    use Queueable, SerializesModels;

    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function build()
    {
        return $this->subject('CSV Processing Complete')
                    ->view('emails.csv_complete', ['userId' => $this->userId]);
    }
}
