<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo('APP\Models\User');
    }

    public function task() {
        return $this->belongsTo('APP\Models\Task');
    }
}
