<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    // ⬇️ Tambahkan ini
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'password',
        'employee_id', // Menambahkan field employee_id
        'role_id',     // Menambahkan field role_id
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // JWTSubject methods
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // Relasi dengan tabel Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id'); // Relasi dengan tabel Employee
    }

    // Relasi dengan tabel Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id'); // Relasi dengan tabel Role
    }
}
