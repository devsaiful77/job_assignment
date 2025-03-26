<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class ProcessCsvUpload implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $csvPath;

    public function __construct($csvPath)
    {
        $this->csvPath = $csvPath;
    }

    public function handle()
    {
        $csvData = array_map('str_getcsv', file($this->csvPath));

        foreach ($csvData as $row) {
            // Validate and process each row
            try {
                $task = Task::create([
                    'title' => $row[0],
                    'description' => $row[1],
                    'project_id' => $row[2],
                    'assigned_to' => $row[3],
                    'status' => $row[4],
                ]);
            } catch (\Exception $e) {
                Log::error("Error processing task: " . $e->getMessage());
            }
        }
    }
}
