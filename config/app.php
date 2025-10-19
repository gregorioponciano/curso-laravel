<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nome do Aplicativo
    |---------------------------------------------------------------------
    |
    | Este valor é o nome do seu aplicativo, que será usado quando o
    | framework precisar inserir o nome do aplicativo em uma notificação ou
    | outros elementos da interface do usuário onde o nome do aplicativo precise ser exibido.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Ambiente do Aplicativo
    |-------------------------------------------------------------------------
    |
    | Este valor determina o "ambiente" em que seu aplicativo está
    | sendo executado. Isso pode determinar como você prefere configurar os diversos
    | serviços que o aplicativo utiliza. Defina isso no seu arquivo ".env".
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Modo de Depuração (debug) do Aplicativo 
    |--------------------------------------------------------------------------
    |
    | Quando seu aplicativo estiver em modo de depuração, mensagens de erro detalhadas com
    | rastreamentos de pilha serão exibidas em cada erro que ocorrer em seu
    | aplicativo. Se desabilitado, uma página de erro genérica simples será exibida.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | URL do Aplicativo
    |---------------------------------------------------------------------
    |
    | Esta URL é usada pelo console para gerar URLs corretamente ao usar
    | a ferramenta de linha de comando Artisan. Você deve defini-la como a raiz do
    | aplicativo para que esteja disponível nos comandos do Artisan.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Fuso Horário do Aplicativo
    |--------------------------------------------------------------------------
    |
    | Aqui você pode especificar o fuso horário padrão para o seu aplicativo, que
    | será usado pelas funções de data e data-hora do PHP. O fuso horário
    | é definido como "UTC" por padrão, pois é adequado para a maioria dos casos de uso.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Configuração de Localidade do Aplicativo
    |--------------------------------------------------------------------------
    |
    | A localidade do aplicativo determina a localidade padrão que será usada
    | pelos métodos de tradução/localização do Laravel. Esta opção pode ser
    | definida para qualquer localidade para a qual você planeja ter strings de tradução.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'en'),

    'faker_locale' => env('APP_FAKER_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Chave de Criptografia
    |--------------------------------------------------------------------------
    |
    | Esta chave é utilizada pelos serviços de criptografia do Laravel e deve ser definida
    | como uma sequência aleatória de 32 caracteres para garantir que todos os valores criptografados
    | estejam seguros. Você deve fazer isso antes de implantar o aplicativo.
    |
    */

    'cipher' => 'AES-256-CBC',

    'key' => env('APP_KEY'),

    'previous_keys' => [
        ...array_filter(
            explode(',', (string) env('APP_PREVIOUS_KEYS', ''))
        ),
    ],

    /*
    |--------------------------------------------------------------------------
    | Driver do Modo de Manutenção
    |--------------------------------------------------------------------------
    |
    | Estas opções de configuração determinam o driver usado para determinar e
    | gerenciar o status do "modo de manutenção" do Laravel. O driver "cache" irá
    | permitir que o modo de manutenção seja controlado em várias máquinas.
    |
    | Drivers suportados: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => env('APP_MAINTENANCE_DRIVER', 'file'),
        'store' => env('APP_MAINTENANCE_STORE', 'database'),
    ],

];
