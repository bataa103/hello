<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'role_id',
        'plan_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id'); // 'plan_id' is the foreign key in users table
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function isAdmin()
    {
        return $this->role && $this->role->name === 'admin';
        // return $this->role->name === "admin";
    }
    public function isUser()
    {
        return $this->role && $this->role->name === 'user';
        // return $this->role->name === "user";
    }
}
