<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FaqPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Determina se o usuário pode visualizar as perguntas frequentes.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function view(User $user)
    { 
        return hasPermission($user, '009');
    }

    /**
     * Determina se o usuário pode editar as perguntas frequentes.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function edit(User $user)
    { 
        return hasPermission($user, '010');
    }

}
