<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    // Menentukan bahwa ID adalah UUID dan tidak auto-increment
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang boleh diisi
    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    // Menentukan cara casting untuk beberapa kolom
    protected $casts = [
        'description' => 'array',
        'is_active' => 'boolean',
    ];

    // Menentukan UUID saat role baru dibuat
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($role) {
            // Generate UUID saat role dibuat
            $role->id = (string) Str::uuid();
        });
    }
}
