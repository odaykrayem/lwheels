<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'amount',
        'bank_code',
        'status'
    ];

    protected $casts = [
        'user_id'=> 'integer',
        'amount'=> 'integer',
        'status'=> 'boolean',
    ];


    /**
     * Get the user that owns the Withdrawal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');

    }
}
