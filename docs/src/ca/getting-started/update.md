---
title: Actualitzar
sidebarDepth: 3
---

# Com actualitzar Castopod?

Després d'instal·lar Castopod, és possible que vulgueu actualitzar la vostra
instància a la darrera versió per gaudir de les últimes funcions ✨, correccions
d'errors 🐛 i millores de rendiment ⚡.

## Instruccions d'actualització automàtica

> Aviat... 👀

## Instruccions d'actualització manual

1. Aneu a la
   [pàgina de llançaments](https://code.castopod.org/adaures/castopod/-/releases)
   i comproveu si la vostra instància està actualitzada amb la darrera versió de
   Castopod

   - [On puc trobar la meva versió de Castopod?](#where-can-i-find-my-castopod-version)

2. Baixeu l'últim paquet de llançament anomenat `Castopod Package`, podeu triar
   entre els fitxers `zip` o `tar.gz`

   - ⚠️ Assegureu-vos de descarregar el paquet Castopod i **NO** el codi font

3. Al vostre servidor:

   - Elimina tots els fitxers excepte `.env` i `public/media`
   - Copieu els fitxers nous del paquet descarregat al vostre servidor

     ::: info Nota

     És possible que hàgiu de restablir els permisos dels fitxers durant el
     procés d'instal·lació. Comproveu els [Detalls de seguretat](./security.md).

     :::

4. Les diferents versions poden incloure instruccions d'actualització
   addicionals (vegeu la
   [pàgina de versions](https://code.castopod.org/adaures/castopod/-/releases)).
   Normalment són scripts de migració de bases de dades en format `.sql` per
   actualitzar l'esquema de la base de dades.

   - 👉 Assegureu-vos que executeu els scripts al vostre panell phpmyadmin o
     utilitzeu la línia d'ordres per actualitzar la base de dades juntament amb
     els fitxers del paquet.
   - [Fa molt de temps que no actualitzo la meva instància... Què hauria de fer?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

5. Si utilitzeu redis, esborreu la memòria cau.
6. ✨ Gaudiu de la vostra nova instància, tot fet i preparat!

## Preguntes més freqüents (FAQ)

### On puc trobar la meva versió de Castopod?

Aneu al vostre panell de control de Castopod, la versió es mostra a la cantonada
inferior esquerra.

Alternativament, podeu trobar la versió al fitxer
`app > Config > Constants.php`.

### Fa temps que no actualitzo la meva instància... Què hauria de fer?

Cap problema. Només heu d'obtenir l'última versió tal com es descriu
anteriorment. Només, quan seguiu les instruccions de la versió en qüestió (4),
realitzeu-les de manera seqüencial, de la més antiga a la més nova.

> És possible que vulgueu fer una còpia de seguretat de la vostra instància en
> funció del temps que no heu actualitzat Castopod.

Per exemple, si sou a `v1.0.0-alpha.42` i voleu actualitzar a `v1.0.0-beta.1`:

0. (molt recomanable) Feu una còpia de seguretat dels vostres fitxers i base de
   dades.

1. Baixeu la darrera versió, sobreescriu els vostres fitxers mantenint `.env` i
   `public/media`.

2. Seguiu les instruccions d'actualització de cada versió seqüencialment (de la
   més antiga a la més recent) començant per `v1.0.0-alpha.43`,
   `v1.0.0-alpha.44`, `v1.0.0-alpha.45`, ..., `v1.0.0-beta.1`.

3. ✨ Gaudiu de la vostra nova instància, tot fet i preparat!

### Hauria de fer una còpia de seguretat abans d'actualitzar?

T'aconsellem que ho facis, perquè no ho perdis tot si alguna cosa va malament!

De manera més general, us aconsellem que feu còpies de seguretat periòdiques
dels vostres fitxers i base de dades de Castopod per evitar que ho perdeu tot...
