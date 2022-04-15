---
title: Mise à jour
sidebarDepth: 3
---

# Comment installer Castopod ?

Après avoir installé Castopod, vous pouvez mettre à jour votre instance vers la
dernière version afin de profiter des dernières fonctionnalités ✨, des
corrections de bugs 🐛 et des améliorations de performance ⚡.

## Instructions de mise à jour automatique

> Prochainement... 👀

## Instructions de mise à jour manuelle

1. Allez sur la
   [page de notes de versions](https://code.castopod.org/adaures/castopod/-/releases)
   et vérifiez si votre instance est à jour avec la dernière version de
   Castopod.

   - cf.
     [Where can I find my Castopod version?](#where-can-i-find-my-castopod-version)

2. Téléchargez la dernière version du paquet nommé `Castopod Package`. Vous
   pouvez choisir entre les archives au format `zip` ou `tar.gz`.

   - ⚠️ Assurez-vous de bien télécharger le paquet Castopod `Castopod Package`
     et **PAS** le code source.

3. Sur votre serveur :

   - Supprimer tous les fichiers sauf `.env` et `public/media`
   - Copiez les nouveaux fichiers du package téléchargé sur votre serveur.

     ::: info Nota Bene

     Vous devrez peut-être re-définir les autorisations de fichiers comme
     effectué durant le processus d'installation. Vérifiez les
     [questions de sécurité](./security.md).

     :::

4. Les versions peuvent être accompagnées d'instructions de mise à jour
   supplémentaires (cf. la
   [page des notes de versions](https://code.castopod.org/adaures/castopod/-/releases)).
   Il s'agit généralement de scripts de migration de base de données au format
   `.sql` qui mettent à jour le schéma de votre base de données.

   - 👉 Assurez-vous d'exécuter les scripts sur votre interface phpmyadmin ou
     utilisez la ligne de commande pour mettre à jour la base de données avec
     les fichiers du paquet !
   - Je n'ai pas mis à jour mon instance depuis longtemps… Que devrais-je faire
     ?

5. Si vous utilisez redis, effacez votre cache.
6. ✨ Votre nouvelle instance est prête !

## Foire Aux Questions (FAQ)

### Où puis-je trouver ma version de Castopod ?

Allez dans votre panneau d'administration de Castopod, la version s'affiche en
bas à gauche.

Vous pouvez également trouver la version dans le fichier
`app > Config > Constants.php`.

### [Je n'ai pas mis à jour mon instance depuis longtemps… Que devrais-je faire ?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

Aucun souci ! Il suffit d'obtenir la dernière version comme décrit ci-dessus.
Lorsque vous exécutez les instructions de mise à jour (4), lancez-les
séquentiellement, de la plus ancienne à la plus récente.

> Vous devriez sauvegarder votre instance selon la date de votre dernière mise à
> jour de Castopod.

Par exemple, si vous êtes en `v1.0.0-alpha.42` et souhaitez mettre à jour vers
la `v1.0.0-beta.1` :

0. (fortement recommandé) Faites une sauvegarde de vos fichiers et de votre base
   de données.

1. Téléchargez la dernière version, écrasez vos fichiers tout en conservant
   `.env` et `public/media`.

2. Effectuez les instructions de mise à jour l'une après l'autre (de la plus
   ancienne à la plus récente).

3. ✨ Votre nouvelle instance est prête !

### Dois-je faire une sauvegarde avant de mettre à jour ?

Nous vous conseillons de le faire, afin de ne pas tout perdre si quelque chose
se passait mal !

Plus généralement, nous vous conseillons de faire des sauvegardes régulières de
vos fichiers Castopod et de votre base de données afin d'éviter de tout perdre…
