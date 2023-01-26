<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class RefRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_id',
        'user_id'
    ];

    protected $casts = [
        'user_id'=> 'integer',
        'owner_id'=> 'integer',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
