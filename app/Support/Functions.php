<?php

use App\Models\Configuration;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;

function isActive(string $uri, string $class = 'menu--active')
{
    $pattern = '/' . $uri . '/';
    $classActive = preg_match($pattern, $_SERVER['REQUEST_URI']) ? $class : '';

    return $classActive;
}

function isActiveIcon(string $uri, string $color = '#FFFFFF')
{
    $pattern = '/' . $uri . '/';
    $colorIconActive = preg_match($pattern, $_SERVER['REQUEST_URI']) ? $color : '#899e9c';

    return $colorIconActive;
}

function isCheckedPermissionUser(array $codes, array $permissions)
{
    // return in_array($code, $permissions) ? ' checked' : '';

    // if (in_array($code, array_keys(config('permissions.name')))) {

    // }  
    // foreach ($codes as $code) {
    //     // dd($code);
    //     if (in_array($code, array_keys($permissions))) {
    //         return ' checked';
    //         // die;
    //     } else {
    //         return '';
    //     }
    // }

}

function hasPermission(User $user, string $codeCurrent)
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

function logo(string $page = 'web') 
{
    $image = '';
    $height = $page === 'web' ? '60px' : 'auto';
    $configuration = Configuration::getConfiguration();
    
    if ($configuration->logo === 'default') {
        $image = '<img src=' . asset("images/logo.png") . ' width="180px" height="'. $height . '" alt="logo">';
    } else {
        $image = '<img src=' . asset($configuration->logo) . ' width="180px" height="'. $height . '" alt="logo">';
    }

    return $image;
}

function favicon() 
{
    $favicon = '';
    $configuration = Configuration::getConfiguration();

    if($configuration->favicon === 'default') {
        $favicon = '<link rel="shortcut icon" href=' . asset('images/favicon.png') . ' type="image/x-icon">';
    } else {
        $favicon = '<link rel="shortcut icon" href=' . asset($configuration->favicon) . ' type="image/x-icon">';
    }

    return $favicon;
}

/**
 * Retorna um nome aletório de imagem e concatena com a extensão atual
 *
 * @param string  $extension
 * @return string
 */
function fileName(string $extension)
{
    $name = Str::random(32);
    return "{$name}.{$extension}";
}

/**
 * Retorna o ano corrente
 *
 * @return string
 */
function year()
{
    return date('Y');
}