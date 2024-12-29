<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
