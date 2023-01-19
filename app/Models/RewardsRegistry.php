<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class RewardsRegistry extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'reward_id',
        'started_at',
        'is_finished'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Reward::class, 'reward_id');
    }
}
