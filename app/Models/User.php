<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 *
 * @property-read \App\Models\Task[]|\Illuminate\Support\Collection $tasks
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    /**
     * @param string $roles
     *
     * @return $this
     * @throws \Throwable
     */
    public function assignRole(string $roles)
    {
        $role = Role::where('name', $roles)->first();
        throw_if(!$role, 'Role not found');

        $this->roles()->attach($role->id);

        return $this;
    }

    /**
     * @param string $role
     *
     * @return bool
     * @throws \Throwable
     */
    public function hasRole(string $role): bool
    {
        $roleModel = Role::where('name', $role)->first();
        throw_if(!$roleModel, 'Role not found');

        return !!$this->roles()->find($roleModel->id);
    }

    public function isManager(): bool
    {
        return !!$this->roles()->where('name', 'manager')->first();
    }

    public function isDeveloper(): bool
    {
        return !!$this->roles()->where('name', 'developer')->first();
    }
}
