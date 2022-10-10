<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'attached_file_path',
        'status',
        'start_date',
        'end_date',
    ];

    public function user() {
        return $this->belongsTo('APP\Models\User');
    }

    public function bookmarks() {
        return $this->hasMany('APP\Models\Bookmark');
    }
}
