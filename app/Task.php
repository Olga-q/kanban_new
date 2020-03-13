<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task', 'notes', 'user_do_id', 'status',
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public static function getByStatus($status) 
    {
        return static::where('status', $status)->get();
    }
}
 