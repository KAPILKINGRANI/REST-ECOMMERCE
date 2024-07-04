<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const VERIFIED_USER = 'verified';
    const UNVERIFIED_USER = 'unverified';

    const ADMIN_USER = true;
    const REGULAR_USER = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

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

    public function isVerified(): bool
    {
        return $this->verified === self::VERIFIED_USER;
    }

    public function isAdmin(): bool
    {
        return $this->admin === self::ADMIN_USER;
    }
    public static function generateVerificationToken(): string
    {
        return Str::random(40);
    }
    /**
     * Defining a Mutator
     *  @return Attribute
     */
    protected function email(): Attribute
    {
        return Attribute::make(set: fn (string $value) => strtolower($value));
    }
}
