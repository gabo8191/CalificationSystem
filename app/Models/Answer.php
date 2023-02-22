<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    use HasFactory;

    protected $fillable = [
        'respuesta',
        'question_id',
        'user_id',
        'partner_id'

    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function partners()
    {
        return $this->belongsTo(Partner::class);
    }

    public function teams()
    {
        return $this->belongsTo(Team::class);
    }
}
