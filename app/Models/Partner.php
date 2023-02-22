<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'team_id'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function answers()
    {
        return $this->hasOne(Answer::class);
    }
}
