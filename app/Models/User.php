<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'is_active',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'deleted_at' => 'datetime',
    ];

    /**
     * Accessor: Returns "Active" or "Inactive" for display
     */
    public function getStatusTextAttribute(): string
    {
        return $this->is_active ? 'Active' : 'Inactive';
    }

    public function getRoleGroupAttribute(): ?string
    {
        return once(function () {
            return $this->roles->first()?->group;
        });
    }

    public function isAdmin(): bool
    {
        return once(function () {
            return $this->roles->contains('group', 'admin');
        });
    }

    public function isBrand(): bool
    {
        return once(function () {
            return $this->roles->contains('group', 'brand');
        });
    }

    public function isUser(): bool
    {
        return once(function () {
            return $this->roles->contains('group', 'user');
        });
    }

    /**
     * Scopes: For filtering active/inactive users
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }
}
