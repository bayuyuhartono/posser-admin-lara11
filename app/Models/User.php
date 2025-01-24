<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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
        'uuid',
        'role_uuid',
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

    public function scopeGetUserList($query)
    {
        $query = DB::table("users")
            ->select('users.uuid','users.name','users.email','users.role_uuid','role.title as rolename')
            ->join("rbac_role AS role", "role.uuid", "=", "users.role_uuid")
            ->orderBy('users.created_at')
            ->get();

        return $query;
    }

    public function scopeGetUser($query, $uuid)
    {
        $query = DB::table("users")
            ->select('users.uuid','users.name','users.email','users.role_uuid','role.title as rolename')
            ->join("rbac_role AS role", "role.uuid", "=", "users.role_uuid")
            ->where('users.uuid', $uuid)
            ->orderBy('users.created_at')
            ->first();

        return $query;
    }
}
