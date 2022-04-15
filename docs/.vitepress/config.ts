import { defineConfig } from "vitepress";

export default defineConfig({
  srcDir: "src",

  head: [
    ["link", { rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
    ["link", { rel: "canonical", href: "https://docs.castopod.org/" }],
    ["meta", { name: "robots", content: "index, follow" }],
    ["meta", { property: "og:type", content: "website" }],
    [
      "meta",
      {
        property: "og:image",
        content: "https://docs.castopod.org/images/open-graph.jpg",
      },
    ],
    ["meta", { property: "og:image:type", content: "image/jpeg" }],
    ["meta", { property: "og:image:width", content: "1200" }],
    ["meta", { property: "og:image:height", content: "630" }],
    [
      "meta",
      {
        property: "og:image:alt",
        content:
          "Castopod mascot waving hello and holding a browser showcasing the Castopod documentation.",
      },
    ],
    ["meta", { property: "og:url", content: "https://docs.castopod.org/" }],
    ["meta", { name: "twitter:site", content: "@castopod" }],
    ["meta", { name: "twitter:card", content: "summary_large_image" }],
    ["meta", { name: "twitter:creator", content: "@ad_aures" }],
    [
      "script",
      {
        defer: "defer",
        "data-domain": "docs.castopod.org",
        src: "https://analytics.castopod.org/js/plausible.js",
      },
    ],
  ],

  locales: {
    "/": {
      lang: "en",
      title: "Castopod documentation",
      description:
        "Check out the Castopod documentation! Install your own free & open-source podcast host, help make it better by contributing, or simply learn more about Castopod!",
    },
    "/fr/": {
      lang: "fr",
      title: "Documentation Castopod",
      description:
        "Castopod est une plateforme d’hébergement gratuite & open-source conçue pour les podcasteurs qui veulent échanger et interagir avec leur public.",
    },
    "/pt-BR/": {
      lang: "pt-BR",
      title: "Documentação Castopod",
      description:
        "Castopod é uma plataforma de hospedagem de código livre & aberto feita para podcasters que querem se envolver e interagir com seu público.",
    },
    "/nn-NO/": {
      lang: "nn-NO",
      title: "Castopod dokumentasjon",
      description:
        "Castopod er ei open og gratis løysing for dei som vil køyra si eiga podkasting-plattform, og for podkastarar som vil engasjera og samhandla med publikum.",
    },
  },

  themeConfig: {
    logo: "/images/castopod-icon.svg",
    lastUpdated: "Last Updated",
    repo: "https://code.castopod.org/adaures/castopod",
    docsDir: "docs/src",
    docsBranch: "develop",
    editLinks: true,
    locales: {
      "/": {
        label: "English",
        selectText: "Languages",
        repoLabel: "Source code",
        nav: [
          {
            text: "Home",
            link: "https://castopod.org/",
          },
          {
            text: "Blog",
            link: "https://blog.castopod.org/",
          },
          {
            text: "Github",
            link: "https://github.com/ad-aures/castopod",
          },
        ],
        sidebar: {
          "/": getGuideSidebarEn(),
        },
      },
      "/fr/": {
        label: "Français",
        selectText: "Langues",
        repoLabel: "Code source",
        nav: [
          {
            text: "Accueil",
            link: "https://castopod.org/",
          },
          {
            text: "Blog",
            link: "https://blog.castopod.org/",
          },
          {
            text: "Github",
            link: "https://github.com/ad-aures/castopod",
          },
        ],
        sidebar: {
          "/": getGuideSidebarFr(),
        },
      },
      "/pt-BR/": {
        label: "Português do Brasil",
        selectText: "Línguas",
        repoLabel: "Código fonte",
        nav: [
          {
            text: "Início",
            link: "https://castopod.org/",
          },
          {
            text: "Blogue",
            link: "https://blog.castopod.org/",
          },
          {
            text: "Github",
            link: "https://github.com/ad-aures/castopod",
          },
        ],
        sidebar: { "/pt-BR/": getGuideSidebarPtBR() },
      },
      "/nn-NO/": {
        label: "Norsk nynorsk",
        selectText: "Språk",
        repoLabel: "Kildekode",
        nav: [
          {
            text: "Heim",
            link: "https://castopod.org/",
          },
          {
            text: "Blogg",
            link: "https://blog.castopod.org/",
          },
          {
            text: "Github",
            link: "https://github.com/ad-aures/castopod",
          },
        ],
        sidebar: { "/nn-NO/": getGuideSidebarNnNO() },
      },
    },
  },
});

function getGuideSidebarEn() {
  return [
    {
      text: "Introduction",
      link: "/",
    },
    {
      text: "Getting started",
      children: [
        { text: "Install", link: "/getting-started/install" },
        { text: "Security", link: "/getting-started/security" },
        { text: "Update", link: "/getting-started/update" },
      ],
    },
    {
      text: "Contributing",
      children: [
        { text: "Guide", link: "/contributing/guidelines" },
        { text: "Dev Setup", link: "/contributing/setup-development" },
      ],
    },
  ];
}

function getGuideSidebarFr() {
  return [
    {
      text: "Introduction",
      link: "/fr/",
    },
    {
      text: "Commencer",
      children: [
        { text: "Installer", link: "/fr/getting-started/install" },
        { text: "Sécurité", link: "/fr/getting-started/security" },
        { text: "Mise à jour", link: "/fr/getting-started/update" },
      ],
    },
    {
      text: "Contributing",
      children: [
        { text: "Guide", link: "/fr/contributing/guidelines" },
        { text: "Dev Setup", link: "/fr/contributing/setup-development" },
      ],
    },
  ];
}

function getGuideSidebarPtBR() {
  return [
    {
      text: "Introdução",
      link: "/pt-BR/",
    },
    {
      text: "Começando",
      children: [
        { text: "Instalar", link: "/pt-BR/getting-started/install" },
        { text: "Segurança", link: "/pt-BR/getting-started/security" },
        { text: "Atualizar", link: "/pt-BR/getting-started/update" },
      ],
    },
    {
      text: "Contributing",
      children: [
        { text: "Guide", link: "/pt-BR/contributing/guidelines" },
        { text: "Dev Setup", link: "/pt-BR/contributing/setup-development" },
      ],
    },
  ];
}

function getGuideSidebarNnNO() {
  return [
    {
      text: "Introduksjon",
      link: "/nn-NO/",
    },
    {
      text: "Starter",
      children: [
        { text: "Installer", link: "/nn-NO/getting-started/install" },
        { text: "Sikkerhet", link: "/nn-NO/getting-started/security" },
        { text: "Oppdaterer", link: "/nn-NO/getting-started/update" },
      ],
    },
    {
      text: "Contributing",
      children: [
        { text: "Guide", link: "/nn-NO/contributing/guidelines" },
        { text: "Dev Setup", link: "/nn-NO/contributing/setup-development" },
      ],
    },
  ];
}
