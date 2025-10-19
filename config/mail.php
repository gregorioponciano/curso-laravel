<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mailer Padrão
    |-------------------------------------------------------------------------
    |
    | Esta opção controla o mailer padrão usado para enviar todos os e-mails
    | mensagens, a menos que outro mailer seja explicitamente especificado ao enviar
    | a mensagem. Todos os mailers adicionais podem ser configurados dentro do
    | array "mailers". Exemplos de cada tipo de mailer são fornecidos.
    |
    */

    'default' => env('MAIL_MAILER', 'log'),

    /*
    |--------------------------------------------------------------------------
    | Configurações do Mailer
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar todos os mailers usados ​​pela sua aplicação, além de
    | suas respectivas configurações. Vários exemplos foram configurados para
    | você e você pode adicionar os seus próprios conforme a necessidade da sua aplicação.
    |
    | O Laravel suporta uma variedade de drivers de "transporte" de e-mail que podem ser usados
    | ao entregar um e-mail. Você pode especificar qual deles está usando para
    | seus mailers abaixo. Você também pode adicionar mailers adicionais, se necessário.
    |
    | Suportados: "smtp", "sendmail", "mailgun", "ses", "ses-v2",
    | "postmark", "resend", "log", "array",
    | "failover", "roundrobin"
    |
    */

    'mailers' => [

        'smtp' => [
            'transport' => 'smtp',
            'scheme' => env('MAIL_SCHEME'),
            'url' => env('MAIL_URL'),
            'host' => env('MAIL_HOST', '127.0.0.1'),
            'port' => env('MAIL_PORT', 2525),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'timeout' => null,
            'local_domain' => env('MAIL_EHLO_DOMAIN', parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST)),
        ],

        'ses' => [
            'transport' => 'ses',
        ],

        'postmark' => [
            'transport' => 'postmark',
            // 'message_stream_id' => env('POSTMARK_MESSAGE_STREAM_ID'),
            // 'client' => [
            //     'timeout' => 5,
            // ],
        ],

        'resend' => [
            'transport' => 'resend',
        ],

        'sendmail' => [
            'transport' => 'sendmail',
            'path' => env('MAIL_SENDMAIL_PATH', '/usr/sbin/sendmail -bs -i'),
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        'failover' => [
            'transport' => 'failover',
            'mailers' => [
                'smtp',
                'log',
            ],
            'retry_after' => 60,
        ],

        'roundrobin' => [
            'transport' => 'roundrobin',
            'mailers' => [
                'ses',
                'postmark',
            ],
            'retry_after' => 60,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Endereço "De" Global
    |--------------------------------------------------------------------------
    |
    | Você pode desejar que todos os e-mails enviados pelo seu aplicativo sejam enviados
    | do mesmo endereço. Aqui, você pode especificar um nome e endereço que sejam
    | usados ​​globalmente para todos os e-mails enviados pelo seu aplicativo.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

];
