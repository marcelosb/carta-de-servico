<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfigurationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Determina se o usuário pode visualizar as configurações gerais.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function view(User $user)
    { 
        return hasPermission($user, '019');
    }

    /**
     * Determina se o usuário pode editar as configurações gerais.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $user)
    { 
        return hasPermission($user, '020');
    }

}
