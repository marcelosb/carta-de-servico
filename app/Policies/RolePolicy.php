<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Determina se o usuário pode visualizar o módulo perfil.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    { 
        return hasPermission($user, '015');
    }

    /**  
     * Determina se o usuário pode criar um novo perfil.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    { 
        return hasPermission($user, '016');
    }

    /**  
     * Determina se o usuário pode editar um perfil.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $user)
    { 
        return hasPermission($user, '017');
    }

    /**  
     * Determina se o usuário pode deletar um perfil.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user)
    { 
        return hasPermission($user, '018');
    }
}
