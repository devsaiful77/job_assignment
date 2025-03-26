<?php

namespace App\Jobs;

namespace App\Jobs;

use App\Models\Task;
use App\Models\CsvError;
use Illuminate\Bus\Queueable;
use App\Mail\CsvProcessingComplete;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Events\CsvProcessingProgress;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

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
            // Trim values and check for missing data
            $row = array_map('trim', $row);

            if (count($row) < 3 || empty($row[0]) || empty($row[1]) || empty($row[2])) {
                $errors[] = ['row' => $row, 'error' => 'Invalid data format (Missing values)'];
                continue;
            }

            try {
                Task::create([
                    'title' => $row[0],
                    'description' => $row[1],
                    'status' => $row[2],
                    'assigned_to' => $this->userId,
                    'project_id' => 1,
                ]);
            } catch (\Exception $e) {
                $errors[] = ['row' => $row, 'error' => $e->getMessage()];
            }

            $processed++;

            // Send real-time progress update via Pusher
            broadcast(new CsvProcessingProgress($this->userId, $processed, $totalRows));
        }

        // if (!empty($errors)) {
        //     Log::error('CSV Processing Errors', $errors);
        // }

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
