<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

return [
    'title' => 'Instalador do Castopod',
    'manual_config' => 'Configuração manual',
    'manual_config_subtitle' =>
        'Crie um arquivo `.env` com suas configurações e atualize a página para continuar a instalação.',
    'form' => [
        'instance_config' => 'Configuração da instância',
        'hostname' => 'Hostname',
        'media_base_url' => 'URL de banco de mídia',
        'media_base_url_hint' =>
            'Se você usar um CDN, você pode configurar aqui.',
        'admin_gateway' => 'Gateway de administrador',
        'admin_gateway_hint' =>
            'O caminho para acessar a área admin (ex. https://example.com/cp-admin). Ele é definido por padrão como cp-admin, recomendamos que você a altere por razões de segurança.',
        'auth_gateway' => 'Gateway de autenticação',
        'auth_gateway_hint' =>
            'O caminho para acessar as páginas de autenticação (ex. https://example.com/cp-auth). Ele é definido por padrão como cp-auth, recomendamos que você a altere por motivos de segurança.',
        'database_config' => 'Configuração do banco de dados',
        'database_config_hint' =>
            'O Castopod precisa se conectar ao seu banco de dados MySQL (ou MariaDB). Se você não tem essas informações necessárias, entre em contato com o administrador do servidor.',
        'db_hostname' => 'Hostname do banco de dados',
        'db_name' => 'Nome do banco de dados',
        'db_username' => 'Nome de usuário do banco de dados',
        'db_password' => 'Senha do banco de dados',
        'db_prefix' => 'Prefixo do banco de dados',
        'db_prefix_hint' =>
            "O prefixo dos nomes das tabelas do Castopod, deixe como está se você não souber o que significa.",
        'cache_config' => 'Configuração de cache',
        'cache_config_hint' =>
            'Escolha seu manipulador de cache preferido. Deixe-o com o valor padrão se você não tiver idéia do que ele significa.',
        'cache_handler' => 'Manipulador de cache (cache handler)',
        'cacheHandlerOptions' => [
            'file' => 'Arquivo',
            'redis' => 'Redis',
            'predis' => 'Predis',
        ],
        'next' => 'Avançar',
        'submit' => 'Finalizar instalação',
        'create_superadmin' => 'Criar sua conta de superadmin',
        'email' => 'E-mail',
        'username' => 'Nome de usuário',
        'password' => 'Senha',
    ],
    'messages' => [
        'createSuperAdminSuccess' =>
            'Sua conta superadmin foi criada com sucesso. Entre para começar a podcastar!',
        'databaseConnectError' =>
            'O Castopod não pôde se conectar ao seu banco de dados. Edite sua configuração do banco de dados e tente novamente.',
        'writeError' =>
            "Não foi possível criar/escrever o arquivo `.env`. Você deve criá-lo manualmente, seguindo o template do arquivo `.env.example` no pacote Castopod.",
    ],
];
