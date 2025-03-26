<?php

namespace App\Jobs;

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Events\CsvProcessingProgress;
use App\Models\Task;
use App\Models\CsvError;
use Illuminate\Support\Facades\Mail;
use App\Mail\CsvProcessingComplete;

class ProcessCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;
    protected $userId;

    public function __construct($filePath, $userId)
    {
        $this->filePath = $filePath;
        $this->userId = $userId;
    }

    public function handle()
    {
        $file = Storage::get($this->filePath);
        $rows = array_map('str_getcsv', explode("\n", $file));
        $header = array_shift($rows);

        $totalRows = count($rows);
        $processed = 0;
        $errors = [];

        foreach ($rows as $row) {
            if (count($row) < 3) { // Assuming minimum 3 columns
                $errors[] = ['row' => $row, 'error' => 'Invalid data format'];
                continue;
            }

            try {
                Task::create([
                    'title' => $row[0],
                    'description' => $row[1],
                    'created_by' => $this->userId,
                ]);
            } catch (\Exception $e) {
                $errors[] = ['row' => $row, 'error' => $e->getMessage()];
            }

            $processed++;

            // Send real-time progress update via Pusher
            broadcast(new CsvProcessingProgress($this->userId, $processed, $totalRows));
        }

        // Save errors
        if (!empty($errors)) {
            CsvError::create([
                'user_id' => $this->userId,
                'errors' => json_encode($errors),
            ]);
        }

        // Send email notification
        Mail::to(auth()->user()->email)->send(new CsvProcessingComplete($this->userId));

        // Notify completion via WebSocket
        broadcast(new CsvProcessingProgress($this->userId, $totalRows, $totalRows, true));
    }
}
