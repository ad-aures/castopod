---
title: Atualização
sidebarDepth: 3
---

# Como atualizar o Castopod?

Depois de instalar o Castopod, você pode querer atualizar sua instância para a
última versão para desfrutar das últimas funcionalidades ✨, correção de bugs 🐛
e melhorias de desempenho ⚡.

## Instruções de atualização automática

> Em breve... 👀

## Instruções para atualização manual

1. Vá para a
   [página de versões](https://code.castopod.org/adaures/castopod/-/releases) e
   veja se sua instância está atualizada com a última versão do Castopod

   - cf.
     [Onde posso encontrar minha versão do Castopod?](#where-can-i-find-my-castopod-version)

2. Baixe o último pacote de versão chamado `Castopod Package`, você pode
   escolher entre os arquivos `zip` ou `tar.gz`

   - ⚠️ Certifique-se de baixar o pacote Castopod e **NÃO** o Código Fonte

3. No seu servidor:

   - Remova todos os arquivos, exceto `.env` e `public/media`
   - Copie os novos arquivos do pacote baixado para o seu servidor

     ::: info Nota

     Talvez seja necessário redefinir as permissões de arquivos como durante o
     processo de instalação. Verifique as
     [Questões de segurança](./security.md).

     :::

4. Versões podem vir com instruções de atualização adicionais (veja a
   [página de versões](https://code.castopod.org/adaures/castopod/-/releases)).
   Geralmente são scripts de migração de banco de dados no formato `.sql` para
   atualizar seu esquema de banco de dados.

   - 👉 Certifique-se de executar os scripts em seu painel phpmyadmin ou use a
     linha de comando para atualizar o banco de dados junto com os arquivos do
     pacote!
   - cf.
     [Faz muito tempo que não atualizo minha instância… O que devo fazer?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

5. Se você estiver usando redis, limpe seu cache.
6. ✨ Aproveite sua instância atualizada, está tudo pronto!

## Perguntas frequentes (FAQ)

### Onde posso encontrar minha versão do Castopod?

Vá para o painel de administração do Castopod, a versão é exibida no canto
inferior esquerdo.

Ou então, você pode encontrar a versão no arquivo
`app > Config > Constants.php`.

### Faz muito tempo que não atualizo minha instância… O que devo fazer?

Sem problemas! Basta obter a versão mais recente, conforme descrito acima. Só
que, ao passar pelas instruções da versão (4), execute-as sequencialmente, da
mais antiga para a mais recente.

> Você pode querer fazer backup de sua instância dependendo de quanto tempo você
> não atualizou o Castopod.

Por exemplo, se você estiver na `v1.0.0-alpha.42` e gostaria de atualizar para a
`v1.0.0-beta.1`:

0. (altamente recomendado) Faça um backup de seus arquivos e banco de dados.

1. Baixe a versão mais recente, substitua seus arquivos enquanto mantém o `.env`
   e `public/media`.

2. Passe por cada instrução de atualização da versão sequencialmente (a partir
   da mais antiga até a mais recente) começando com `v1.0.0-alpha.43`,
   `v1.0.0-alpha.44`, `v1.0.0-alpha.45`, …, `v1.0.0-beta.1`.

3. ✨ Aproveite sua instância atualizada, está tudo pronto!

### Devo fazer um backup antes de atualizar?

Aconselhamos você a fazer, assim você não perde tudo se algo der errado!

De forma mais geral, recomendamos que você faça backups regulares dos seus
arquivos de Castopod e banco de dados para evitar que você perca tudo…
