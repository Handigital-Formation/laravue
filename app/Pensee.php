<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pensee extends Model
{
    protected $fillable = [
        'text', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
