<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'team_id',
        'role_id',
    ];
    public $timestamps = false;
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function boot()
    {
        parent::boot();
    
        static::created(function ($user) {
            $user->assignRole($user->role_id);
            $user->timestamps = false;
        });
    
        static::updated(function ($user) {
            $user->syncRoles($user->role_id);
        });
    
        static::deleted(function ($user) {
            $user->removeRole($user->role_id);
        });
    
        static::creating(function ($user) {
            $user->created_at = $user->freshTimestamp();
            $user->updated_at = $user->created_at;
        });

    }
}
