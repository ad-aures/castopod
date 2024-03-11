---
title: Ažuriranje
sidebarDepth: 3
---

# Kako da ažurirate Castopod?

Nakon instalacije Castopod-a, možete poželeti da ažurirate svoju instancu na
najnoviju verziju kako bi ste uživali u najnovijim opcijama ✨, sređenim
bagovima 🐛 i unapređenim performansama ⚡.

## Uputstva za ažuriranje

0. ⚠️ Pre bilo kog ažuriranja, toplo preporučujemo da napravite rezervnu kopiju
   svojih Castopod datoteka i baze podataka.

   - cf.
     [Da li treba da napravim rezervnu kopiju pre ažuriranja?](#should-i-make-a-backup-before-updating)

1. Idite na
   [stranicu izdanja](https://code.castopod.org/adaures/castopod/-/releases) i
   proverite da li je vaša instanca ažurirana sa najnovijom verzijom Castopod-a

   - cf.
     [Gde mogu da pronađem moju verziju Castopod-a?](#where-can-i-find-my-castopod-version)

2. Skinite najnoviji paket izdanja koji se zove `Castopod Package`, možete
   odabrati `zip` ili `tar.gz` tip arhive

   - ⚠️ Uverite se da ste preuzeli Castopod paket a **NE** izvorni kod
   - Imajte na umu da takođe možete preuzeti najnoviji paket sa
     [castopod.org](https://castopod.org/)

3. Na vašem serveru:

   - Uklonite sve datoteke sem `.env` i `public/media`
   - Kopirajte nove datoteke iz preuzetog paketa na vaš server

     ::: info Napomena

     Možda ćete morati da resetujete dozvole za datoteke kao tokom procesa
     instalacije. Proverite [Bezbednosne interese](./security.md).

     :::

4. Ažurirajte svoju šemu baze podataka iz vaše `Castopod Admin` > `About`
   stranice ili tako što ćete pokrenuti:

   ```bash
   php spark castopod:database-update
   ```

5. Očistite keš iz `Castopod Admin` > `Settings` > `general` > `Housekeeping`
6. ✨ Uživajte u svežoj instanci, završili ste!

::: info Napomena

Izdanja mogu doći sa dodatnim uputstvima za ažuriranje (pogledajte
[stranicu izdanja](https://code.castopod.org/adaures/castopod/-/releases)).

- cf.
  [Nisam ažurirao/la svoju instancu jako dugo… Šta treba da uradim?](#i-havent-updated-my-instance-in-a-long-time-what-should-i-do)

:::

## Potpuno automatsko ažuriranje

> Stiže uskoro... 👀

## Često postavljana pitanja (česta pitanja)

### Gde mogu da pronađem svoju verziju Castopod-a?

Idite na administratorski panel vašeg Castopod-a, verziju možete pronaći u
donjem levom uglu.

Alternativno, verziju možete pronaći u `app > Config > Constants.php` datoteci.

### Nisam ažurirao/la svoju instancu veoma dugo… Šta treba da uradim?

Nema problema! Samo preuzmite poslednju verziju na način opisan iznad. Samo,
kada idete kroz uputstva izdanja (4), izvodite ih jedno za drugim, od
najstarijih do najnovijih.

> Možda ćete želeti da napravite rezervnu kopiju instance u zavisnosti od toga
> koliko dugo niste ažurirali Castopod.

Na primer, ako koristite verziju `v1.0.0-alpha.42` i želite da ažurirate na
verziju `v1.0.0-beta.1`:

0. (toplo preporučujemo) Napravite kopiju važih datoteka i baze podataka.

1. Preuzmite najnovije izdanje, preišite svoje datoteke čuvajući `.env` i
   `public/media`.

2. Prođite kroz uputstva za ažuriranje svakog izdanja po redu (od najstarijeg do
   najnovijeg) počevši sa `v1.0.0-alpha.43`, `v1.0.0-alpha.44`,
   `v1.0.0-alpha.45`, …, `v1.0.0-beta.1`.

3. ✨ Uživajte u svežoj instanci, završili ste!

### Da li treba da napravim kopiju pre ažuriranja?

Savetujemo vam da to uradite, tako da ne izgubite sve ako nešto krene po zlu!

Uopštenije, savetujemo vam da redovno pravite rezervne kopije vaših Castopod
datoteka i baze podataka kako biste sprečili da sve izgubite…
