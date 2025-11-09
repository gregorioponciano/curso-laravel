<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Driver de Sessão Padrão
    |--------------------------------------------------------------------------

    | Esta opção determina o driver de sessão padrão que será utilizado para
    | requisições recebidas. O Laravel suporta diversas opções de armazenamento para
    | persistir dados de sessão. O armazenamento em banco de dados é uma ótima opção padrão.
    | Suportado: "file", "cookie", "database", "memcached",
    | "redis", "dynamodb", "array"
    */

    'driver' => env('SESSION_DRIVER', 'database'),

    /*
    |--------------------------------------------------------------------------
    | Tempo de vida da sessão
    --------------------------------------------------------------------------

    | Aqui você pode especificar o número de minutos que deseja que a sessão
    | permaneça ociosa antes de expirar. Se desejar que ela
    | expire imediatamente ao fechar o navegador, você pode
    | indicar isso através da opção de configuração expire_on_close.
    */

    'lifetime' => (int) env('SESSION_LIFETIME', 120),

    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    /*
    |--------------------------------------------------------------------------
    | Criptografia de Sessão
    |--------------------------------------------------------------------------

    | Esta opção permite especificar facilmente que todos os seus dados de sessão
    | devem ser criptografados antes de serem armazenados. Toda a criptografia é realizada
    | automaticamente pelo Laravel e você pode usar a sessão normalmente.
    */

    'encrypt' => env('SESSION_ENCRYPT', false),

    /*
    |--------------------------------------------------------------------------
    | Localização dos Arquivos de Sessão
    --------------------------------------------------------------------------

    | Ao utilizar o driver de sessão "arquivo", os arquivos de sessão são colocados
    | no disco. O local de armazenamento padrão é definido aqui; no entanto, você
    | pode fornecer outro local onde eles devem ser armazenados.
    */

    'files' => storage_path('framework/sessions'),

    /*
    |--------------------------------------------------------------------------
    | Conexão de Sessão com o Banco de Dados
    |--------------------------------------------------------------------------

    | Ao usar os drivers de sessão "database" ou "redis", você pode especificar uma
    | conexão que deve ser usada para gerenciar essas sessões. Isso deve
    | corresponder a uma conexão nas opções de configuração do seu banco de dados.
    */

    'connection' => env('SESSION_CONNECTION'),

    /*
    |--------------------------------------------------------------------------
    | Tabela do Banco de Dados de Sessões
    |--------------------------------------------------------------------------

    | Ao usar o driver de sessão "banco de dados", você pode especificar a tabela a ser
    | usada para armazenar as sessões. Obviamente, um valor padrão adequado é definido
    | para você; no entanto, você pode alterá-lo para outra tabela.
    */

    'table' => env('SESSION_TABLE', 'sessions'),

    /*
    |--------------------------------------------------------------------------
    | Armazenamento de Cache de Sessão
    |--------------------------------------------------------------------------

    | Ao usar um dos backends de sessão baseados em cache do framework, você pode
    | definir o armazenamento de cache que deve ser usado para armazenar os dados da sessão
    | entre as requisições. Este deve corresponder a um dos seus armazenamentos de cache definidos.

    | Afeta: "dynamodb", "memcached", "redis"
    */

    'store' => env('SESSION_STORE'),

    /*
    |--------------------------------------------------------------------------
    | Loteria de Varredura de Sessões
    |--------------------------------------------------------------------------

    | Alguns drivers de sessão precisam limpar manualmente seu local de armazenamento para se livrar
    | de sessões antigas. Aqui estão as chances de isso acontecer
    | em uma determinada solicitação. Por padrão, a probabilidade é de 2 em 100.
    */

    'lottery' => [2, 100],

    /*
    |--------------------------------------------------------------------------
    | Nome do Cookie de Sessão
    --------------------------------------------------------------------------

    | Aqui você pode alterar o nome do cookie de sessão criado pelo
    | framework. Normalmente, não é necessário alterar esse valor
    | pois isso não garante uma melhoria significativa na segurança.
    */

    'cookie' => env(
        'SESSION_COOKIE',
        Str::slug(env('APP_NAME', 'laravel')).'-session'
    ),

    /*
    |--------------------------------------------------------------------------
    | Caminho do Cookie de Sessão
    --------------------------------------------------------------------------

    | O caminho do cookie de sessão determina o caminho para o qual o cookie será
    | considerado disponível. Normalmente, este será o caminho raiz do
    | seu aplicativo, mas você pode alterá-lo quando necessário.
    */

    'path' => env('SESSION_PATH', '/'),

    /*
    |--------------------------------------------------------------------------
    | Domínio do Cookie de Sessão
    --------------------------------------------------------------------------

    | Este valor determina o domínio e os subdomínios para os quais o cookie de sessão está
    | disponível. Por padrão, o cookie estará disponível para o domínio raiz
    | e todos os subdomínios. Normalmente, isso não deve ser alterado.
    */

    'domain' => env('SESSION_DOMAIN'),

    /*
    |--------------------------------------------------------------------------
    | Cookies somente HTTPS
    |--------------------------------------------------------------------------

    | Ao definir esta opção como verdadeira, os cookies de sessão só serão enviados de volta
    | ao servidor se o navegador tiver uma conexão HTTPS. Isso impedirá
    | que o cookie seja enviado a você quando isso não puder ser feito de forma segura.
    */

    'secure' => env('SESSION_SECURE_COOKIE'),

    /*
    |--------------------------------------------------------------------------
    | Acesso somente via HTTP
    |--------------------------------------------------------------------------

    | Definir este valor como verdadeiro impedirá que o JavaScript acesse o
    | valor do cookie e o cookie só poderá ser acessado por meio do
    | protocolo HTTP. É improvável que você deva desativar esta opção.
    */

    'http_only' => env('SESSION_HTTP_ONLY', true),

    /*
    |--------------------------------------------------------------------------
    | Cookies do Mesmo Site
    |--------------------------------------------------------------------------

    | Esta opção determina como seus cookies se comportam quando interferências entre sites
    | ocorrem e podem ser usados ​​para mitigar ataques de CSRF. Por padrão,
    | definimos este valor como "lax" para permitir a proteção entre sites seguros.

    | Consulte: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Set-Cookie#samesitesamesite-value

    | Suportado: "lax", "strict", "none", null
    */

    'same_site' => env('SESSION_SAME_SITE', 'lax'),

    /*
    |--------------------------------------------------------------------------
    | Cookies Particionados
    |--------------------------------------------------------------------------
    |
    | Definir este valor como verdadeiro vinculará o cookie ao site de nível superior para
    | um contexto entre sites. Cookies particionados são aceitos pelo navegador
    | quando sinalizado como "seguro" e o atributo Same-Site estiver definido como "nenhum".
    |
    */

    'partitioned' => env('SESSION_PARTITIONED_COOKIE', false),

];
