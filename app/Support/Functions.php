<?php

use App\Models\Configuration;
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

function isCheckedPermissionUser(string $valueCheckbox = '', string $permissions = '')
{
    $regularExpression = '/' . $valueCheckbox . '/';
    $checkboxActive = preg_match($regularExpression, $permissions) ? ' checked' : '';

    return $checkboxActive;
}

function hasPermission(string $name = '')
{
    return in_array($name, User::getPermissions());
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