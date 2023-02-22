<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function partners()
    {
        return $this->hasMany(Partner::class);
    }
    
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
