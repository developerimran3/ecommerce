<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Permission;
use App\Models\RolePermission;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'image',
        'password',
        'role',
        'status',
    ];



    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    //Role Permission ar jonno
    public function hasPermission(string $permission): bool
    {
        if ($this->role === 'Administrator') {
            return true;
        }
        return RolePermission::where('role', $this->role)
            ->whereHas('permission', function ($query) use ($permission) {
                $query->where('name', $permission);
            })
            ->exists();
    }
    public function hasAnyPermission(array $permissions): bool
    {
        if ($this->role === 'Administrator') {
            return true;
        }
        return RolePermission::where('role', $this->role)
            ->whereHas('permission', function ($query) use ($permissions) {
                $query->whereIn('name', $permissions);
            })
            ->exists();
    }



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
}
