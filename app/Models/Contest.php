<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;
    protected $fillable = [
        'prize',
        'description',
        'duration',
        'is_finished'
    ];

    protected $casts = [
        'is_finished' => 'boolean',
    ];

    public function participants (){
        return $this->hasMany(Participant::class);
    }
}
