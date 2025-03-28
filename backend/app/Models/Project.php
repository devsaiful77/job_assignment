<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'name',
        'description',
        'created_by'
    ];

    public function createBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
