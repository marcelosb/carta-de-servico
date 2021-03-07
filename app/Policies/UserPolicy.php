<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Determina se o usuário pode visualizar o módulo de usuário.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    { 
        return hasPermission($user, '011');
    }

    /**  
     * Determina se o usuário pode criar uma novo usuário.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    { 
        return hasPermission($user, '012');
    }

    /**  
     * Determina se o usuário pode editar um usuário existente.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $user)
    { 
        return hasPermission($user, '013');
    }

    /**  
     * Determina se o usuário pode deletar um usuário em específico.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user)
    { 
        return hasPermission($user, '014');
    }
}
