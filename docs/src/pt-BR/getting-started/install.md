---
title: Instalação
sidebarDepth: 3
---

# Como instalar o Castopod?

Castopod foi pensado para ser fácil de instalar. Seja usando hospedagem dedicada
ou compartilhada, você pode instalá-lo na maioria dos servidores web compatíveis
com PHP-MySQL.

## Requisitos

- PHP v8.0 ou superior
- MySQL versão 5.7 ou superior ou MariaDB versão 10.2 ou superior
- Suporte a HTTPS

### PHP v8.0 ou superior

É necessário PHP versão 8.0 ou superior com as seguintes extensões instaladas:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) com **JPEG**,
  **PNG** e bibliotecas **WEBP**.
- [exif](https://www.php.net/manual/en/exif.installation.php)

Além disso, certifique-se de que as seguintes extensões estejam habilitadas em
seu PHP:

- json (habilitado por padrão - não desativar)
- xml (habilitado por padrão - não desativar)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### Banco de dados compatível com MySQL

> Recomendamos usar o [MariaDB](https://mariadb.org).

::: aviso

Castopod só funciona com bancos de dados compatíveis com MySQL 5.7 ou superior.
Vai quebrar com a versão anteiror do MySQL, v5.6, por exemplo, pois teve seu
ciclo encerrado em 5 de fevereiro de 2021.

:::

Você vai precisar do hostname do servidor, nome do banco de dados, nome do
usuário e senha para concluir o processo de instalação. Se você não os tem,
entre em contato com o administrador do servidor.

#### Privilégios

O usuário deve ter pelo menos estes privilégios no banco de dados para que o
Castopod funcione: `CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`,
`SELECT`, `UPDATE`.

### (Opcional) FFmpeg v4.1.8 ou superior para Clipes de Vídeo

[FFmpeg](https://www.ffmpeg.org/) versão 4.1.8 ou superior é necessário se você
deseja gerar Clipes de Vídeo. As seguintes extensões devem ser instaladas:

- Biblioteca **FreeType 2** para
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Opcional) Outras recomendações

- Redis para melhores desempenhos de cache.
- CDN para cache de arquivos estáticos e melhores desempenhos.
- gateway de e-mail para senhas perdidas.

## Instruções de instalação

### Pré-requisitos

0. Obter um servidor web com os [requisitos](#requirements) instalados
1. Criar um banco de dados MySQL para Castopod com um usuário com privilégios de
   acesso e de modificação (para mais informações, ver o
   [banco de dados compatível com MySQL](#mysql-compatible-database)).
2. Ativar HTTPS em seu domínio com um _certificado SSL_.
3. Baixar e descompactar o último [Pacote Castopod](https://castopod.org/) no
   servidor web, se você ainda não o fez.
   - ⚠️ Definir a raiz do documento do servidor web para a subpasta `public/`
     dentro da pasta `castopod`.
4. Adicionar **tarefas cron** no seu servidor web para vários processos em
   segundo plano (substitua os caminhos adequadamente):

   - Para que os recursos sociais funcionem corretamente, esta tarefa é usada
     para transmitir atividades sociais para seus seguidores no fediverso:

   ```bash
      * * * * * /path/to/php /path/to/castopod/public/index.php scheduled-activities
   ```

   - Para que seus episódios sejam transmitidos em hubs abertos após a
     publicação usando [WebSub](https://en.wikipedia.org/wiki/WebSub):

   ```bash
      * * * * * /usr/local/bin/php /castopod/public/index.php scheduled-websub-publish
   ```

   - Para que os clipes de vídeo sejam criados (veja
     [requisitos de FFmpeg](#ffmpeg-v418-or-higher-for-video-clips)):

   ```bash
      * * * * * /path/to/php /path/to/castopod/public/index.php scheduled-video-clips
   ```

   > Essas tarefas são executadas **a cada minuto**. Você pode definir a
   > freqüência dependendo de suas necessidades: a cada 5, 10 minutos ou mais.

### (recomendado) Assistente de Instalação

1. Execute o script de instalação do Castopod acessando a página do assistente
   de instalação (`https://your_domain_name.com/cp-install`) no seu navegador
   favorito.
2. Siga as instruções na sua tela.
3. Comece o podcast!

::: info Nota

O script de instalação grava um arquivo `.env` na raiz do pacote. Se você não
puder passar pelo assistente de instalação, você pode
[criar e atualizar o arquivo `.env` manualmente](#alternative-manual-configuration).

:::

## Pacotes comunitários

Se você não quiser se preocupar em instalar o Castopod manualmente, você pode
usar um dos pacotes criados e mantidos pela comunidade de código aberto.

### Instalar com YunoHost

[YunoHost](https://yunohost.org/) é uma distribuição baseada no Debian GNU/Linux
composta por pacotes de software livre e de código aberto. Ele gerencia as
dificuldades de auto-hospedagem para você.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Instalar Castopod com YunoHost" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Github
Repo</a>

</div>

### Instalar com o Docker

Se você deseja usar o Docker para instalar o Castopod, é possível graças a
[Romain de Laage](https://mamot.fr/@rdelaage)!

<a href="https://gitlab.utc.fr/picasoft/projets/services/castopod" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-2 mx-auto font-semibold text-center text-white rounded-md shadow gap-x-1 bg-[#1282d7] hover:no-underline hover:bg-[#0f6eb5]">Instalar
com o
Docker<svg viewBox="0 0 24 24" width="1em" height="1em" class="text-xl text-pine-200"><path fill="currentColor" d="m16.172 11-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path></svg></a>

::: info Nota

Dado o alto nível de demanda por docker, planejamos manter uma imagem oficial do
Castopod Docker diretamente no repositório do Castopod.

:::
