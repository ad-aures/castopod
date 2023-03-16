---
sidebarDepth: 2
---

# Välkommen 👋

[![release-badge]][release]&nbsp;[![license-badge]][license]&nbsp;[![contributions-badge]][contributions]&nbsp;[![semantic-release-badge]][semantic-release]&nbsp;[![crowdin-badge]][crowdin]&nbsp;[![discord-badge]][discord]&nbsp;[![stars-badge]][stars]

Castopod är en gratis hostingplattform med öppen källkod gjord för podcastare
som vill engagera och interagera med sin publik.

Castopod är lätt att installera och byggdes ovanpå
[CodeIgniter4](https://codeigniter.com/), ett kraftfullt PHP-ramverk med ett
mycket litet fotavtryck.

<div class="flex items-center">
  <a href="/getting-started/install" class="inline-flex items-center px-4 py-2 mx-auto font-semibold text-center text-white rounded-full shadow gap-x-1 bg-pine-500 hover:no-underline hover:bg-pine-600">Installera<svg viewBox="0 0 24 24" width="1em" height="1em" class="text-xl text-pine-200"><path fill="currentColor" d="m16.172 11-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path></svg></a>
</div>

## Funktioner

- 🌱 &nbsp;Gratis & öppen källkod (AGPL v3-licens)
- 🔐 &nbsp;Fokuserad på datasuveränitet: ditt innehåll, målgrupp och analys
  tillhör dig, och&nbsp;du&nbsp;bara
- <unk> &nbsp;Podcasting 2.0 funktioner: GUID, låst, avskrifter, finansiering,
  kapitel, plats, personer, ljud, …
- 💬 &nbsp;Inbyggt socialt nätverk:
  - 🚀 &nbsp;Castopod är en del av Fediverse, ett decentraliserat socialt
    nätverk
  - ❤️ &nbsp;Skapa inlägg, dela, favorit och kommentera avsnitt
- 📈 &nbsp;Inbyggd analys:
  - ⚖️ &nbsp;GDPR / CCPA / LGPD kompatibel
  - <unk> &nbsp;Standard IABv2 målgruppsmätning
  - 🏡 &nbsp;Lokalanalys, ingen tredje part involverad
- 📢 &nbsp;Inbyggda marknadsföringsverktyg:
  - ✅ &nbsp;SEO ready (open-graph meta-tags, JSON-LD, …)
  - 📱 &nbsp;PWA: installera som en fristående app
  - 🎨 &nbsp;Anpassningsbara temafärger
  - 🎬 &nbsp;Generera att dela videoklipp från avsnitt
  - 🔉 &nbsp;Generera ljudbitar
  - <unk> \_button_selector: &nbsp;Inbäddbar spelare, bädda in dina avsnitt på
    valfri webbplats
- 💸 &nbsp;Monetization:
  - 🔗 &nbsp;Finansierar länkar
  - 📲 &nbsp;lista-att-klicka annonser
  - 🤝 &nbsp;value4value / WebMonetization
  - 💎 &nbsp;Premium podcasts
- 📡 &nbsp;Publicera dina avsnitt överallt med RSS:
  - 📱 &nbsp;På alla index och appar: Podcast Index, Apple Podcasts, Spotify,
    Google Podcasts, Deezer, Podcast Addict, Podfriend, …
  - ⚡ &nbsp;Sänd dina avsnitt direkt med WebSub
- 📥 &nbsp;Podcast import: flytta din befintliga podcast till Castopod
- 📤 &nbsp;Flytta ut din podcast från Castopod
- :shuffle_tracks<unk> &nbsp;Flera hyresgäst: värd så många podcasts du vill
- 👥 &nbsp;Flera användare: lägg till bidragslämnare och ange roller
- 🌎 &nbsp;i18n support: översatt till engelska, franska, polska, tyska,
  brasilianska portugisiska & spanska… med
  [mer att komma](https://translate.castopod.org)!

## Motivation

Den podcasting ekosystem är decentraliserad av naturen: du kan skapa din podcast
som en RSS-fil, publicera den på webben och få den delad överallt på nätet.

Det är i själva verket en av de enda medierna som har stannat kvar på detta sätt
under en lång tid.

I takt med att användningsområden utvecklas kommer fler och fler människor in i
podcasts: om det är skapare att hitta nya sätt att dela sina idéer, eller
lyssnare i sökningen för bättre innehåll.

När podcasting blir mer allmänt använd försöker vissa företag flytta den till
ett mer kontrollerat och centraliserat medium.

Castopod skapades i ett försök att ge ett öppet och hållbart alternativ för att
vara värd för dina podcasts, främja decentralisering för att säkerställa att
podcastare kreativitet kan uttrycka sig.

Detta projekt drivs av open source-communityn och specifikt av
[Fediverse](https://fediverse.party/en/fediverse/) och
[Podcasting 2.0](https://podcastindex.org/) rörelser.

## Jämförelse med andra lösningar

Vi tror att en lösning inte nödvändigtvis är rätt för alla, det mycket beror på
dina behov. Så, här är jämförelser med andra verktyg för att hjälpa dig att mäta
om Castopod är rätt passform för&nbsp;du.

### Castopod vs Wordpress

Castopod kallas ofta för "Wordpress för podcasts" på grund av de likheter mellan
de två. På vissa sätt är detta sant. Och faktiskt, Castopod var mycket
inspirerad av Wordpress ekosystem, se lätthet att adoptera från gemenskapen och
antalet webbplatser som kör&nbsp;den.

Precis som Wordpress är Castopod gratis & öppen källkod, byggd med PHP med en
MySQL-databas och är paketerad på ett sätt som du enkelt kan installera på de
flesta webb -servrar.

Wordpress är ett bra sätt att skapa din webbplats och utöka den med plugins för
att få vad du vill. Det är en fullfjädrad CMS som hjälper dig att få någon typ
av webbplats online.

Å andra sidan, Castopod är tänkt att ta itu med podcasters behöver specifikt,
med fokus på podcasting, och inget annat. Du behöver inte någon plugin för att
komma igång med din podcasting&nbsp;resa.

Detta gör det möjligt att optimera de processer som är specifika för podcasting:
allt från skapandet av dina podcasts och publiceringen av nya avsnitt hela vägen
till sändning, marknadsföring och analys.

Slutligen, beroende på dina behov, Wordpress och Castopod kan även leva sida vid
sida eftersom de delar samma krav!

### Castopod vs Funkwhale

Funkwhale är en självvärd, modern gratis och öppen källkod musikserver. Precis
som Castopod, Funkwhale är på fediverse, ett decentraliserat socialt nätverk som
möjliggör interoperabilitet mellan de två.

Funkwhale byggdes ursprungligen runt musik. Och senare när projektet utvecklades
introducerades förmågan att vara värd för podcasts.

Till skillnad från Funkwhale har Castopod designats och byggts kring podcasting
exklusivt. Detta möjliggör enklare implementering av funktioner relaterade till
podcasting ekosystem, såsom podcasting 2.0 funktioner (transkript, kapitel,
platser, personer, …).

Så, du bör förmodligen använda Funkwhale om du vill vara värd för din musik, och
använda Castopod om du vill vara värd för dina podcasts.

### Castopod vs andra podcast värdar

Det finns många lösningar för dig att vara värd för dina podcasts, några av dem
är verkligen bra och [en hel del av dem](https://podcastindex.org/apps) hoppar
in i Podcasting 2. vagn precis som Castopod!

Var och en av dessa lösningar skiljer sig från varandra, kan du jämföra med
[listan över funktioner](#features).

Med detta sagt, det finns två huvudsakliga skillnader med andra podcasting
lösningar:

- Castopod kan vara själv värd och är den enda lösningen som gör att du kan
  hålla full kontroll över vad du producerar. Dessutom, eftersom det är öppen
  källkod, kan du även anpassa det som du vill.

- Castopod är den enda lösningen som för närvarande integrerar både ett
  decentraliserat socialt nätverk med ActivityPub samt många av podcasting 2.
  funktioner, i hopp om att överbrygga gapet mellan de två.

## Hjälp till

Älskar du Castopod och vill hjälpa till? Ta en titt på följande dokumentation
för att få dig&nbsp;igång.

### Uppförandekod

Castopod har antagit en uppförandekod som vi förväntar oss projektdeltagare att
hålla sig till. Läs
[CODE_OF_CONDUCT manualen](https://code.castopod.org/adaures/castopod/-/blob/beta/CODE_OF_CONDUCT.md)
så att du kan förstå vilka åtgärder som kommer och inte kommer
att&nbsp;tolereras.

### Bidragande guide

Läs vår [bidragande guide](./contributing/guidelines.md) för att lära dig om vår
utvecklingsprocess, hur du föreslår buggfixar och förbättringar, och hur du
bygger och testar dina ändringar till Castopod.

## Alla bidragsgivare ✨

Tack går till dessa underbara människor
([emoji nyckel](https://allcontributors.org/docs/en/emoji-key)):

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore-start -->
<!-- markdownlint-disable -->
<table>
  <tbody>
    <tr>
      <td align="center" valign="top" width="14.28%"><a href="https://github.com/yassinedoghri"><img src="https://code.castopod.org/uploads/-/system/user/avatar/3/avatar.png?s=100" width="100px;" alt="Yassine Doghri"/><br /><sub><b>Yassine Doghri</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/commits/master" title="Code">💻</a> <a href="https://code.castopod.org/adaures/castopod/issues?author_username=yassinedoghri" title="Bug reports">🐛</a> <a href="https://code.castopod.org/adaures/castopod/commits/master" title="Documentation">📖</a> <a href="https://code.castopod.org/adaures/castopod/merge_requests?scope=all&state=all&approver_usernames[]=yassinedoghri" title="Reviewed Pull Requests">👀</a> <a href="#maintenance-yassinedoghri" title="Maintenance">🚧</a> <a href="#content-yassinedoghri" title="Content">🖋</a> <a href="#design-yassinedoghri" title="Design">🎨</a> <a href="#a11y-yassinedoghri" title="Accessibility">️️️️♿️</a> <a href="https://translate.castopod.org" title="Translation">🌍</a> <a href="#question-yassinedoghri" title="Answering Questions">💬</a> <a href="#mentoring-yassinedoghri" title="Mentoring">🧑‍🏫</a> <a href="#infra-yassinedoghri" title="Infrastructure (Hosting, Build-Tools, etc)">🚇</a> <a href="#ideas-yassinedoghri" title="Ideas, Planning, & Feedback">🤔</a> <a href="#projectManagement-yassinedoghri" title="Project Management">📆</a> <a href="https://blog.castopod.org/author/yassinedoghri/" title="Blogposts">📝</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/benjamin"><img src="https://code.castopod.org/uploads/-/system/user/avatar/2/avatar.png?s=100" width="100px;" alt="Benjamin Bellamy"/><br /><sub><b>Benjamin Bellamy</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/commits/master" title="Code">💻</a> <a href="https://code.castopod.org/adaures/castopod/issues?author_username=benjamin" title="Bug reports">🐛</a> <a href="https://code.castopod.org/adaures/castopod/merge_requests?scope=all&state=all&approver_usernames[]=benjamin" title="Reviewed Pull Requests">👀</a> <a href="#content-benjamin" title="Content">🖋</a> <a href="https://translate.castopod.org" title="Translation">🌍</a> <a href="#question-benjamin" title="Answering Questions">💬</a> <a href="#infra-benjamin" title="Infrastructure (Hosting, Build-Tools, etc)">🚇</a> <a href="#ideas-benjamin" title="Ideas, Planning, & Feedback">🤔</a> <a href="https://blog.castopod.org/author/benjamin-bellamy/" title="Blogposts">📝</a> <a href="#projectManagement-benjamin" title="Project Management">📆</a> <a href="#talk-benjamin" title="Talks">📢</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://github.com/ola-hn"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Ola Hneini"/><br /><sub><b>Ola Hneini</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/commits/master" title="Code">💻</a> <a href="https://code.castopod.org/adaures/castopod/merge_requests?scope=all&state=all&approver_usernames[]=ola" title="Reviewed Pull Requests">👀</a> <a href="https://code.castopod.org/adaures/castopod/commits/master" title="Documentation">📖</a> <a href="#maintenance-ola" title="Maintenance">🚧</a> <a href="#question-ola" title="Answering Questions">💬</a> <a href="#ideas-ola" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://mamot.fr/@rdelaage"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Romain de Laage"/><br /><sub><b>Romain de Laage</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/commits/master" title="Code">💻</a> <a href="#infra-rdelaage" title="Infrastructure (Hosting, Build-Tools, etc)">🚇</a> <a href="https://code.castopod.org/adaures/castopod/commits/master" title="Documentation">📖</a> <a href="https://translate.castopod.org" title="Translation">🌍</a> <a href="#ideas-rdelaage" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://twitter.com/lyonelbernard"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Lyonel Bernard"/><br /><sub><b>Lyonel Bernard</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=Lyonel" title="Bug reports">🐛</a> <a href="#question-Lyonel" title="Answering Questions">💬</a> <a href="#audio-Lyonel" title="Audio">🔊</a> <a href="#ideas-Lyonel" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://www.crypticchameleon.com/"><img src="https://secure.gravatar.com/avatar/7c2a721b52d0763673a600e8f01bd745?s=80&d=identicon?s=100" width="100px;" alt="Christopher Lagonick-Weitzel"/><br /><sub><b>Christopher Lagonick-Weitzel</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=ctlw83" title="Bug reports">🐛</a> <a href="#question-ctlw83" title="Answering Questions">💬</a> <a href="#audio-ctlw83" title="Audio">🔊</a> <a href="#ideas-ctlw83" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://ernestoacosta.me/"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Ernesto Acosta"/><br /><sub><b>Ernesto Acosta</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=ernestoacostame" title="Bug reports">🐛</a> <a href="#audio-ernestoacostame" title="Audio">🔊</a> <a href="https://translate.castopod.org" title="Translation">🌍</a> <a href="#question-ernestoacostame" title="Answering Questions">💬</a> <a href="#ideas-ernestoacostame" title="Ideas, Planning, & Feedback">🤔</a></td>
    </tr>
    <tr>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/Behel"><img src="https://secure.gravatar.com/avatar/ad63ee8ef8e3db8253d21e5012d2724f?s=80&d=identicon?s=100" width="100px;" alt="Bastien Luneteau"/><br /><sub><b>Bastien Luneteau</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/commits/master" title="Code">💻</a> <a href="https://code.castopod.org/adaures/castopod/issues?author_username=Behel" title="Bug reports">🐛</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://www.cecillie.fr/"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Cécile Ricordeau"/><br /><sub><b>Cécile Ricordeau</b></sub></a><br /><a href="#design-cecillie" title="Design">🎨</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/PatrykMis"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Patryk Miś"/><br /><sub><b>Patryk Miś</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/mspanc"><img src="https://secure.gravatar.com/avatar/eed8337939641eac5ad0b570bd6acf96?s=80&d=identicon?s=100" width="100px;" alt="Marcin Lewandowski"/><br /><sub><b>Marcin Lewandowski</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=mspanc" title="Bug reports">🐛</a> <a href="#ideas-mspanc" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/SJanik"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Sebastian Janik"/><br /><sub><b>Sebastian Janik</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/commits/master" title="Code">💻</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/patryk"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Patryk Karczmarczyk"/><br /><sub><b>Patryk Karczmarczyk</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/commits/master" title="Code">💻</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/ddenis"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="denis d"/><br /><sub><b>denis d</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=ddenis" title="Bug reports">🐛</a> <a href="#ideas-ddenis" title="Ideas, Planning, & Feedback">🤔</a></td>
    </tr>
    <tr>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/douglaskastle"><img src="https://secure.gravatar.com/avatar/b7e652ba4b6bcd440afa069e7f7bc9e6?s=80&d=identicon?s=100" width="100px;" alt="Douglas Kastle"/><br /><sub><b>Douglas Kastle</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=douglaskastle" title="Bug reports">🐛</a> <a href="#ideas-douglaskastle" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/cExplorer"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="cExplorer"/><br /><sub><b>cExplorer</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=cExplorer" title="Bug reports">🐛</a> <a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/imacrea"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="ImaCrea"/><br /><sub><b>ImaCrea</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=imacrea" title="Bug reports">🐛</a> <a href="#ideas-imacrea" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/jonas"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Jonas S"/><br /><sub><b>Jonas S</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/commits/master" title="Code">💻</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/yannL"><img src="https://secure.gravatar.com/avatar/9c46600ce566ec6d526370d8e104b1c8?s=80&d=identicon?s=100" width="100px;" alt="LEFEBVRE Yann"/><br /><sub><b>LEFEBVRE Yann</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=yannL" title="Bug reports">🐛</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/spaetz"><img src="https://secure.gravatar.com/avatar/278e1af65e82993efd0ba7bbbacf6435?s=80&d=identicon?s=100" width="100px;" alt="Sebastian Späth"/><br /><sub><b>Sebastian Späth</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=spaetz" title="Bug reports">🐛</a> <a href="#ideas-spaetz" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/rocky"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="rocky III"/><br /><sub><b>rocky III</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=rocky" title="Bug reports">🐛</a></td>
    </tr>
    <tr>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/Regenpfeifer"><img src="https://code.castopod.org/uploads/-/system/user/avatar/103/avatar.png?s=100" width="100px;" alt="Hermann Josef Eckl"/><br /><sub><b>Hermann Josef Eckl</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=Regenpfeifer" title="Bug reports">🐛</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://code.castopod.org/cyrilledel"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Delhaye Cyrille"/><br /><sub><b>Delhaye Cyrille</b></sub></a><br /><a href="https://code.castopod.org/adaures/castopod/issues?author_username=cyrilledel" title="Bug reports">🐛</a> <a href="#ideas-cyrilledel" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://twitter.com/otetranome"><img src="https://code.castopod.org/uploads/-/system/user/avatar/113/avatar.png?s=100" width="100px;" alt="João Leandro"/><br /><sub><b>João Leandro</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a> <a href="#ideas-otetranome" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://achouvardas.eu/"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Angelos Chouvardas"/><br /><sub><b>Angelos Chouvardas</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://mastodon.fjerland.no/@eivind"><img src="https://mastodon.fjerland.no/system/accounts/avatars/107/769/768/295/192/222/original/e5c985fea6487dcb.jpg?s=100" width="100px;" alt="Eivind"/><br /><sub><b>Eivind</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://mastodon.fedi.bzh/@ewen"><img src="https://mastodon.fedi.bzh/system/accounts/avatars/000/000/002/original/6f387690a504ae46.jpg?s=100" width="100px;" alt="Ewen"/><br /><sub><b>Ewen</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a> <a href="#ideas-3wen" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/forght"><img src="https://crowdin-static.downloads.crowdin.com/avatar/15073833/large/82d1e2e443a6df7edc43a7405dfeeb75_default.png?s=100" width="100px;" alt="forght"/><br /><sub><b>forght</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
    </tr>
    <tr>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/glottis0q"><img src="https://crowdin-static.downloads.crowdin.com/avatar/15209934/large/8b17ef6a7399f0b82a8198f87c224195.png?s=100" width="100px;" alt="glottis0q"/><br /><sub><b>glottis0q</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://mstdn.fr/@ButterflyOfFire"><img src="https://static.mstdn.fr/static/accounts/avatars/000/065/901/original/5908e93ad5447f15.png?s=100" width="100px;" alt="ButterflyOfFire"/><br /><sub><b>ButterflyOfFire</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://github.com/lil5"><img src="https://avatars.githubusercontent.com/u/17646836?v=4?s=100" width="100px;" alt="Lucian I. Last"/><br /><sub><b>Lucian I. Last</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/luuzviir"><img src="https://crowdin-static.downloads.crowdin.com/avatar/13166188/large/d03ab0abc7ce354b210d836955cd3805_default.png?s=100" width="100px;" alt="LuuzViir"/><br /><sub><b>LuuzViir</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/cthtc"><img src="https://crowdin-static.downloads.crowdin.com/avatar/15211502/large/ed0651060cb8474a9519b5168bd377c1_default.png?s=100" width="100px;" alt="CTHTC"/><br /><sub><b>CTHTC</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/retrograde"><img src="https://crowdin-static.downloads.crowdin.com/avatar/15021651/large/b10c4057f85bf4de49c7fdf01354ecde.jpeg?s=100" width="100px;" alt="Russian Retro"/><br /><sub><b>Russian Retro</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/mareklach"><img src="https://crowdin-static.downloads.crowdin.com/avatar/13572324/large/3eeba8d569c247ace33862bf4ef4748f.jpeg?s=100" width="100px;" alt="Marek L'ach"/><br /><sub><b>Marek L'ach</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
    </tr>
    <tr>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/gunchleoc"><img src="https://crowdin-static.downloads.crowdin.com/avatar/13043878/large/3223f7b606296a8b1c92c5de39c459a2_default.png?s=100" width="100px;" alt="GunChleoc"/><br /><sub><b>GunChleoc</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/gabisnow"><img src="https://crowdin-static.downloads.crowdin.com/avatar/15214858/large/5b083bdf9c9e9de67cc6ee72a6c8db18_default.png?s=100" width="100px;" alt="GabiSnow"/><br /><sub><b>GabiSnow</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/bendaha"><img src="https://crowdin-static.downloads.crowdin.com/avatar/15331656/large/cd92450d2c20202299fb3a0075903e20_default.png?s=100" width="100px;" alt="bendaha"/><br /><sub><b>bendaha</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/samuelroland"><img src="https://crowdin-static.downloads.crowdin.com/avatar/14980053/large/3e154a37d03d6e98ae402ed3f930f4f5.png?s=100" width="100px;" alt="Samuel Roland"/><br /><sub><b>Samuel Roland</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://dimitriregnier.net/"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Dimitri Regnier"/><br /><sub><b>Dimitri Regnier</b></sub></a><br /><a href="#ideas-dimregnier" title="Ideas, Planning, & Feedback">🤔</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://im.irithys.com/@thy"><img src="https://crowdin-static.downloads.crowdin.com/avatar/15405614/large/3086461c47cce0a0c031925e5f943412.png?s=100" width="100px;" alt="irithys"/><br /><sub><b>irithys</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://twitter.com/caos30"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Sergi"/><br /><sub><b>Sergi</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
    </tr>
    <tr>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/xosem"><img src="https://crowdin-static.downloads.crowdin.com/avatar/12617257/large/a201650da44fed28890b0e0d8477a663.jpg?s=100" width="100px;" alt="ghose (XoseM)"/><br /><sub><b>ghose (XoseM)</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/basen1982"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="Andreas Olsson"/><br /><sub><b>Andreas Olsson</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/leonfrom"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="leonfrom"/><br /><sub><b>leonfrom</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/agentcobra57"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="agentcobra"/><br /><sub><b>agentcobra</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/alephoto85"><img src="https://crowdin-static.downloads.crowdin.com/avatar/15094649/large/530391f54157af52ae33058ec15b0f99.jpg?s=100" width="100px;" alt="Alessandro"/><br /><sub><b>Alessandro</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://crowdin.com/profile/liimee"><img src="https://castopod.org/assets/images/castopod-avatar.jpg?s=100" width="100px;" alt="liimee"/><br /><sub><b>liimee</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
      <td align="center" valign="top" width="14.28%"><a href="https://github.com/ahmedsabouni"><img src="https://avatars.githubusercontent.com/u/74497842?v=4?s=100" width="100px;" alt="Ahmed Sabouni"/><br /><sub><b>Ahmed Sabouni</b></sub></a><br /><a href="https://translate.castopod.org" title="Translation">🌍</a></td>
    </tr>
  </tbody>
</table>

<!-- markdownlint-restore -->
<!-- prettier-ignore-end -->

<!-- ALL-CONTRIBUTORS-LIST:END -->

Detta projekt följer specifikationen
[för alla bidragsgivare](https://github.com/all-contributors/all-contributors) .
Bidrag av något slag välkomna!

## Kontakt

Du kan nå oss för hjälp eller ställa någon fråga du har på:

- [Discord](https://castopod.org/discord) (för direkt interaktion med
  -utvecklare och gemenskapen)
- [Ärendespårare](https://code.castopod.org/adaures/castopod/-/issues) (för
  funktionsförfrågningar & felrapporter)

Alternativt kan du följa oss på sociala medier för att få nyheter om Castopod:

- [podlibre.social](https://podlibre.social/@Castopod) (Mastodon instance)
- [Twitter](https://twitter.com/castopod)
- [LinkedIn](https://linkedin.com/company/castopod)
- [Facebook](https://www.facebook.com/castopod)

## Sponsorer

Den pågående utvecklingen av Castopod möjliggörs med stöd av sina backers. Om du
vill hjälpa till, överväg
[sponsra Castopods utveckling](https://opencollective.com/castopod/contribute).

<div class="flex flex-wrap gap-x-16 gap-y-8">
  <a href="https://adaures.com/" target="_blank" rel="noopener noreferrer"><img src="/images/sponsors/adaures.svg" alt="Ad Aures Logo" class="h-16" /></a>
  <a href="https://nlnet.nl/project/Castopod/" target="_blank" rel="noopener noreferrer"><img src="/images/sponsors/nlnet.svg" alt="NLnet Logo" class="h-16" /></a>
</div>

## Licens

[GNU Lesser General Public License](https://choosealicense.com/licenses/agpl-3.0/)

Copyright © 2020-present, [Ad Aures](https://adaures.com/).
https://img.shields.io/gitlab/v/release/2?color=brightgreen&gitlab_url=https%3A%2F%2Fcode.castopod.org%2F&include_prereleases&label=release
https://img.shields.io/github/license/ad-aures/castopod?color=blå
https://img.shields. o/badge/contributions-welcome-brightgreen.svg
https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantik--release-e10079.
vg https://img.shields.io/github/stars/ad-aures/castopod?style=sociala

[release]: https://code.castopod.org/adaures/castopod/-/releases
[license]: https://code.castopod.org/adaures/castopod/-/blob/beta/LICENSE.md
[contributions]: https://code.castopod.org/adaures/castopod/-/issues
[semantic-release]: https://github.com/semantic-release/semantic-release
[discord]: https://castopod.org/discord
[stars]: https://github.com/ad-aures/castopod/stargazers
[crowdin]: https://translate.castopod.org/project/castopod
