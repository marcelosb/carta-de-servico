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
    public function __construct() {}

    /**
     * Determina se o usuário pode visualizar o módulo secretaria.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    { 
        return hasPermission($user, '001');
    }

    /**  
     * Determina se o usuário pode criar uma nova secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    { 
        return hasPermission($user, '002');
    }

    /**  
     * Determina se o usuário pode editar uma secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $user)
    { 
        return hasPermission($user, '003');
    }

    /**  
     * Determina se o usuário pode deletar uma secretaria.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user)
    { 
        return hasPermission($user, '004');
    }

}
