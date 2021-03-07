<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServicePolicy
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
     * Determina se o usuário pode visualizar o módulo serviço.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    { 
        return hasPermission($user, '005');
    }

    /**  
     * Determina se o usuário pode criar um novo serviço.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    { 
        return hasPermission($user, '006');
    }

    /**  
     * Determina se o usuário pode editar um serviço.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $user)
    { 
        return hasPermission($user, '007');
    }

    /**  
     * Determina se o usuário pode deletar um serviço.
     * 
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function delete(User $user)
    { 
        return hasPermission($user, '008');
    }

}
