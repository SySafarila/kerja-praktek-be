<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded = ['id'];

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

    public function pendingNewEmails()
    {
        return $this->hasMany(PendingNewEmail::class);
    }

    public function getApiPermissions()
    {
        $permissions = $this->getAllPermissions()->pluck('name')->toArray();

        return $permissions;
    }

    public function getApiRoles()
    {
        $roles = $this->getRoleNames();

        return $roles;
    }

    function student() {
        return $this->hasOne(Student::class);
    }

    function transaction() {
        return $this->hasOne(Transaction::class);
    }
}
