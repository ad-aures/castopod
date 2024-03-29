---
title: Instalacija
sidebarDepth: 3
---

# Kako Instalirati Castopod?

Zamišljeno je da Castopod bude jednostavan za instalaciju. Bilo da se koristi
namenski ili deljeni hosting, možete ga instalirati na većinu PHP-MySQL
kompatibilnih veb servera.

::: savet Napomena

Objavili smo zvanične Docker slike za Castopod!

Ako više volite da koristite Docker, možete ovo preskočiti i preći direktno na
[docker dokumentaciju](./docker.md) za Castopod.

:::

## Uslovi

- PHP v8.1 ili novija verzija
- MySQL verzija 5.7 ili novija ili MariaDB verzija 10.2 ili novija
- HTTPS podrška
- [ntp-sinhronizovani sat](https://viki.debian.org/NTP) za potvrdu dolaznih
  zahteva federacije

### PHP v8.1 ili kasnija verzija

Potrebna je PHP verzija 8.1 ili novija, sa instaliranim sledećim ekstenzijama:

- [intl](https://php.net/manual/en/intl.requirements.php)
- [libcurl](https://php.net/manual/en/curl.requirements.php)
- [mbstring](https://php.net/manual/en/mbstring.installation.php)
- [gd](https://www.php.net/manual/en/image.installation.php) sa **JPEG**,
  **PNG** i **WEBP** bibliotekama.
- [exif](https://www.php.net/manual/en/exif.installation.php)

Pored toga, uverite se da su sledeće ekstenzije omogućene u vašem PHP-u:

- json (podrazumevano omogućeno - ne isključujte ga)
- xml (podrazumevano omogućeno - ne isključujte ga)
- [mysqlnd](https://php.net/manual/en/mysqlnd.install.php)

### MySQL kompatibilne baze podataka

> Preporučujemo korišćenje [MariaDB](https://mariadb.org).

::: upozorenje Upozorenje

Castopod radi samo sa podržanim MySQL 5.7 ili novijim kompatibilnim bazama
podataka. Kvari se na MySQL v5.6 na primer, jer je njen životni vek istekao 5.
februara 2021.

:::

Trebaće vam ime servera, ime baze podataka, korisničko ime i lozinka za završite
proces instalacije. Ako ih nemate, obratite se svom administratoru servera.

#### Privilegije

Korisnik mora imati najmanje ove privilegije u bazi podataka da bi Castopod
radio: `CREATE`, `ALTER`, `DELETE`, `EXECUTE`, `INDEX`, `INSERT`, `SELECT`,
`UPDATE`, `REFERENCES`, `CREATE VIEW`.

### (Opciono) FFmpeg v4.1.8 ili kasnija verzija za video isečke

[FFmpeg](https://www.ffmpeg.org/) verzija 4.1.8 ili kasnija je neophodna ukoliko
želite da pravite video isečke. Sledeće ekstenzije moraju biti instalirane:

- **FreeType 2** biblioteka za
  [gd](https://www.php.net/manual/en/image.installation.php).

### (Opciono) Ostale preporuke

- Redis za bolje performanse keša.
- CDN za keširanje statičnih datoteka i bolje performanse.
- e-mail gateway za izgubljene lozinke.

## Uputstva za instalaciju

### Preduslovi

0. Nabavite veb server sa instaliranim [preduslovima](#requirements)
1. Napravite MySQL bazu podataka za Castopod sa korisnikom koji ima pristup i
   privilegije da modifikuje (za više informacija, pogledajte
   [MySQL kompatibilna baza podataka](#mysql-compatible-database)).
2. Aktivirajte HTTPS na vašem domenu sa _SSL sertifikatom_.
3. Preuzmite i otpakujte najnoviji [Castopod Paket](https://castopod.org/) na
   veb server ako to već niste uradili.
   - ⚠️ Podesite root dokument veb servera na `public/` poddirektorijum u okviru
     `castopod` direktorijuma.
4. Dodajte **cron zadatke** na vašem veb serveru za različite zadatke u pozadini
   (zamenite staze u skladu sa tim):

   ```bash
      * * * * * /path/to/php /path/to/castopod/spark tasks:run >> /dev/null 2>&1
   ```

   **Pažnja** - ukoliko ne dodate ovaj cron zadatak, sledeće opcije Castopod-a
   neće raditi:

   - Uvoz podkasta iz postojeće RSS veze
   - Objava društvenih aktivnosti vašim pratiocima u Fediverzumu
   - Objava epizoda u otvorenim hub-ovima uz pomoć
     [WebSub-a](https://en.wikipedia.org/wiki/WebSub)
   - Pravljenje video isečaka -
     [zahteva FFmpeg](#optional-ffmpeg-v418-or-higher-for-video-clips)

### (preporučeno) Čarobnjak za instalaciju

1. Pokrenite Castopod-ovu instalacionu skriptu tako što ćete otići na stranicu
   čarobnjaka za instalaciju (`https://your_domain_name.com/cp-install`) u važem
   omiljenom pretraživaču.
2. Pratite uputstva na ekranu.
3. Počnite sa podkastingom!

::: info Napomena

Instalaciona skripta upisuje `.env` datoteku u root paketa. Ukoliko ne možete da
prođete kroz čarobnjaka za instalaciju, možete sami napraviti i urediti `.env`
datoteku ručno po uzoru na `.env.example` datoteku.

:::

### Korišćenje CLI

1. Napravite `.env` datoteku u root-u paketa, po uzoru na `.env.example`
   datoteku.
2. Inicirajte bazu podataka koristeći:

   ```sh
   php spark install:init-database
   ```

3. Napravite super administratora koristeći:

   ```sh
   php spark install:create-superadmin
   ```

4. Idite na vaš administratorski pristup i krenite sa podkastingom!

### Podešavanja Elektronske pošte/SMTP-a

Podešavanja elektronske pošte su potrebna kako bi neke opcije radile kako treba
(npr. povratak izgubljene lozinke, slanje uputstava premijum pretplatnicima, …)

Možete dodati konfiguraciju elektronske pošte u vašu `.env` datoteku instance na
sledeći način:

```ini
# […]

email.fromEmail="your_email_address"
email.SMTPHost="your_smtp_host"
email.SMTPUser="your_smtp_user"
email.SMTPPass="your_smtp_password"
```

#### Opcije konfigurisanja elektronske pošte

| Naziv promenljive | Vrsta                 | Podrazumevano  |
| ----------------- | --------------------- | -------------- |
| **`fromEmail`**   | string                | `nedefinisano` |
| **`fromName`**    | string                | `"Castopod"`   |
| **`SMTPHost`**    | string                | `nedefinisano` |
| **`SMTPUser`**    | string                | `nedefinisano` |
| **`SMTPPass`**    | string                | `nedefinisano` |
| **`SMTPPort`**    | number                | `25`           |
| **`SMTPCrypto`**  | [`"tls"` ili `"ssl"`] | `"tls"`        |

### Multimedijalno skladište

Podrazumevano, datoteke se čuvaju u `public/media` direktorijumu koristeći
sistem datoteka. Ukoliko želite da prebacite `media` direktorijum na drugo
mesto, možete to odrediti u svojoj `.env` datoteci na način koji je prikazan
ispod:

```ini
# […]

media.root="media"
media.storage="/mnt/storage"
```

U ovom primeru, datoteke će biti sačuvane u /mnt/storage/media direktorijumu.
Obavezno ažurirajte konfiguraciju svog veb servera kako biste odrazili ovu
promenu.

### S3

Ako više volite da čuvate svoje medijske datoteke na S3 kompatibilnom skladištu,
možete da ga navedete u svojoj `.env` datoteci:

```ini
# […]

media.fileManager="s3"
media.s3.endpoint="your_s3_host"
media.s3.key="your_s3_key"
media.s3.secret="your_s3_secret"
media.s3.region="your_s3_region"
```

#### Opcije konfigurisanja S3 skladišta

| Naziv promenljive       | Vrsta   | Podrazumevano  |
| ----------------------- | ------- | -------------- |
| **`endpoint`**          | string  | `nedefinisano` |
| **`key`**               | string  | `nedefinisano` |
| **`secret`**            | string  | `nedefinisano` |
| **`region`**            | string  | `nedefinisano` |
| **`bucket`**            | string  | `castopod`     |
| **`protocol`**          | number  | `nedefinisano` |
| **`pathStyleEndpoint`** | boolean | `false`        |
| **`keyPrefix`**         | string  | `nedefinisano` |

## Paketi iz zajednice

Ukoliko ne želite da sami instalirate Castopod ručno, moežete iskoristiti jedan
od paketa koji je napravila i o kome brine zajednica otvorenog koda.

### Instalirajte sa YunoHost-om

[YunoHost](https://yunohost.org/) je je distribucija zasnovana na Debian
GNU/Linux-u sačinjena od besplatnih softverskih paketa otvorenog koda. Ona
upravlja teškoćama samo-hostovanje za vas.

<div class="flex flex-wrap items-center gap-4">

<a href="https://install-app.yunohost.org/?app=castopod" target="_blank" rel="noopener noreferrer">
   <img src="https://install-app.yunohost.org/install-with-yunohost.svg" alt="Instalirajte Castopod sa YunoHost-om" class="align-middle" />
</a>

<a href="https://github.com/YunoHost-Apps/castopod_ynh" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-4 py-[.3rem] mx-auto font-semibold text-center text-black rounded-md gap-x-1 border-2 border-solid border-[#333] hover:no-underline hover:bg-gray-100"><svg
   xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="1em" height="1em"
   class="text-xl"><path fill="none" d="M0 0h24v24H0z"/><path d="M12 2A10 10 0 0 0 2 12a10 10 0 0 0 6.84 9.49c.5.09.69-.21.69-.48l-.02-1.86c-2.51.46-3.16-.61-3.36-1.18-.11-.28-.6-1.17-1.02-1.4-.35-.2-.85-.66-.02-.67.79-.01 1.35.72 1.54 1.02.9 1.52 2.34 1.1 2.91.83a2.1 2.1 0 0 1 .64-1.34c-2.22-.25-4.55-1.11-4.55-4.94A3.9 3.9 0 0 1 6.68 8.8a3.6 3.6 0 0 1 .1-2.65s.83-.27 2.75 1.02a9.28 9.28 0 0 1 2.5-.34c.85 0 1.7.12 2.5.34 1.9-1.3 2.75-1.02 2.75-1.02.54 1.37.2 2.4.1 2.65.63.7 1.02 1.58 1.02 2.68 0 3.84-2.34 4.7-4.56 4.94.36.31.67.91.67 1.85l-.01 2.75c0 .26.19.58.69.48A10.02 10.02 0 0 0 22 12 10 10 0 0 0 12 2z"/></svg>Github
Repo</a>

</div>
