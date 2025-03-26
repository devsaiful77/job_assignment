<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvError extends Model
{
    use HasFactory;
    protected $table = 'csv_errors';
    protected $fillable = [
        'user_id',
        'errors'
    ];
}
