<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'status', 'date'];

    public function scopeFilterByDate($query, $date)
    {
        if ($date) {
            $query->whereDate('date', $date);
        }
        return $query;
    }

    public function scopeFilterByStatus($query, $status)
    {
        if ($status) {
            $query->where('status', $status);
        }
        return $query;
    }
}
