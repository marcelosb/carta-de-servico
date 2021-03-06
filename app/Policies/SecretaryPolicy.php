<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SecretaryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determina se o usuário pode visualizar o módulo secretaria.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    { 
        return $this->hasPermission($user, '001');
    }

    /**  
     * Determina se o usuário pode editar uma secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $user)
    { 
        return $this->hasPermission($user, '002');
    }

    /**  
     * Determina se o usuário pode criar uma nova secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    { 
        return $this->hasPermission($user, '003');
    }

    /**  
     * Determina se o usuário pode criar uma nova secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user)
    { 
        return $this->hasPermission($user, '004');
    }

    private function hasPermission(User $user, string $codeCurrent)
    {
        $id = $user->roles()->first()->id;
        $roles = Role::where('id', $id)->first();

        $codes = explode(',', $roles->permissions->codes);
        foreach ($codes as $code) {
            if ($code === $codeCurrent) {
                return true;
            }
        }

        return false;
    }

}
