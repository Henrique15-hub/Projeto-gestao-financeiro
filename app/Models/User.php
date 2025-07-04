<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    public function category(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function report(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            if (User::count() === 1) {
                $defaultCategory = [
                    'TRANSPORT', 'FOOD', 'LEISURE', 'FINANCIAL',
                ];

                foreach ($defaultCategory as $category) {
                    Category::create([
                        'name' => $category,
                        'isPersonalizada' => false,
                    ]);
                }
            }
        });
    }
}
