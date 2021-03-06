<?php

return [

   /*
    |--------------------------------------------------------------------------
    | Permissões do painel de controle
    |--------------------------------------------------------------------------
    |
    | Aqui estão listados todos os módulos da aplicação,
    | bem como também todas as ações de visualizar, criar, editar e deletar 
    |
    */

    'name' => [

        /**
        * Permissões do módulo secretaria
        */
        '001' => 'visualizar secretaria',
        '002' =>'cadastrar secretaria',
        '003' =>'editar secretaria',
        '004' =>'deletar secretaria',

        /**
        * Permissões do módulo serviço
        */
        '005' => 'visualizar serviço',
        '006' =>'cadastrar serviço',
        '007' =>'editar serviço',
        '008' =>'deletar serviço',

        /**
        * Permissões do módulo FAQ (Perguntas frequentes)
        */
        '009' => 'visualizar perguntas frequentes',
        '010' =>'editar perguntas frequentes',

        /**
        * Permissões do módulo usuário
        */
        '011' => 'visualizar usuário',
        '012' =>'cadastrar usuário',
        '013' =>'editar usuário',
        '014' =>'deletar usuário',

    ],
    

];
