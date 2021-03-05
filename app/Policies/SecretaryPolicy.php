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
        $secretaryViewAny = config('permissions.secretary.viewAny');

        return $this->hasPermission($user, $secretaryViewAny);
    }

    /**  
     * Determina se o usuário pode editar uma secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $user)
    { 
        $secretaryEdit = config('permissions.secretary.edit');

        return $this->hasPermission($user, $secretaryEdit);
    }

    /**  
     * Determina se o usuário pode criar uma nova secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    { 
        $secretaryCreate = config('permissions.secretary.create');

        return $this->hasPermission($user, $secretaryCreate);
    }

    /**  
     * Determina se o usuário pode criar uma nova secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user)
    { 
        $secretaryDelete = config('permissions.secretary.delete');

        return $this->hasPermission($user, $secretaryDelete);
    }

    private function hasPermission(User $user, string $action)
    {
        $id = $user->roles()->first()->id;
        $roles = Role::where('id', $id)->first();

        foreach ($roles->permissions as $permission) {
            if ($permission->name === $action) {
                return true;
            }
        }

        return false;
    }

}
