<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Esta opção define a autenticação padrão "guard" e a senha
    | redefine o "broker" para o seu aplicativo. Você pode alterar esses valores
    | conforme necessário, mas eles são um começo perfeito para a maioria dos aplicativos.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Guardas de Autenticação
    |-------------------------------------------------------------------------
    |
    | Em seguida, você pode definir cada guarda de autenticação para sua aplicação.
    | É claro que uma ótima configuração padrão foi definida para você
    | que utiliza o armazenamento de sessão mais o provedor de usuário do Eloquent.
    |
    | Todas as guardas de autenticação têm um provedor de usuário, que define como os
    | usuários são realmente recuperados do seu banco de dados ou outro sistema de armazenamento
    | usado pela aplicação. Normalmente, o Eloquent é utilizado.
    |
    | Suportado: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Provedores de Usuário
    |--------------------------------------------------------------------------
    |
    | Todos os guardas de autenticação têm um provedor de usuário, que define como os
    | usuários são realmente recuperados do seu banco de dados ou outro sistema de armazenamento
    | usado pelo aplicativo. Normalmente, o Eloquent é utilizado.
    |
    | Se você tiver várias tabelas ou modelos de usuários, poderá configurar vários
    | provedores para representar o modelo/tabela. Esses provedores podem então
    | ser atribuídos a quaisquer guardas de autenticação extras que você tenha definido.
    |
    | Suportados: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Redefinindo Senhas
    |--------------------------------------------------------------------------
    |
    | Estas opções de configuração especificam o comportamento da funcionalidade de redefinição de senhas do Laravel,
    | incluindo a tabela utilizada para armazenamento de tokens
    | e o provedor de usuário que é invocado para recuperar usuários.
    |
    | O tempo de expiração é o número de minutos que cada token de redefinição será
    | considerado válido. Este recurso de segurança mantém os tokens com vida curta,
    | para que tenham menos tempo para serem descobertos. Você pode alterar isso conforme necessário.
    |
    | A configuração de aceleração é o número de segundos que um usuário deve esperar antes de
    | gerar mais tokens de redefinição de senha. Isso impede que o usuário
    | gere rapidamente uma grande quantidade de tokens de redefinição de senha.
        |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Tempo Limite de Confirmação de Senha
    |--------------------------------------------------------------------------
    |
    | Aqui você pode definir o número de segundos antes que uma janela de confirmação de senha
    | expire e os usuários sejam solicitados a digitar novamente suas senhas na
    | tela de confirmação. Por padrão, o tempo limite dura três horas.
        |
        */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
