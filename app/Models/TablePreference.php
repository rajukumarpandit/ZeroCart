<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablePreference extends Model
{
    protected $table = 'table_preferences';

    protected $fillable = [
        'user_id',
        'table',
        'preferences'
    ];

    protected $casts = [
        'preferences' => 'array'
    ];

    /**
     * Preference belongs to user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}