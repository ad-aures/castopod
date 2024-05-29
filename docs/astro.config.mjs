import { defineConfig } from "astro/config";
import starlight from "@astrojs/starlight";

import tailwind from "@astrojs/tailwind";

const site = "https://docs.castopod.org/";
const base = process.env.BASE ?? "/docs";

// https://astro.build/config
export default defineConfig({
  site,
  base,
  integrations: [
    starlight({
      title: "Castopod Docs",
      description:
        "Check out the Castopod documentation! Install your own free & open-source podcast host, help make it better by contributing, or simply learn more about Castopod!",
      components: {
        Header: "./src/components/Header.astro",
        MobileMenuFooter: "./src/components/MobileMenuFooter.astro",
      },
      logo: {
        src: "./src/assets/castopod-logo-inline.svg",
        replacesTitle: true,
      },
      favicon: "/favicon.ico",
      customCss: [
        "@fontsource/inter/400.css",
        "@fontsource/inter/600.css",
        "@fontsource/rubik/700.css",
        "./src/styles/tailwind.css",
      ],
      head: [
        {
          tag: "meta",
          attrs: {
            property: "og:type",
            content: "website",
          },
        },
        {
          tag: "meta",
          attrs: {
            property: "og:image",
            content: base + "/open-graph.jpg?v=1",
          },
        },
        {
          tag: "meta",
          attrs: { property: "og:image:type", content: "image/jpeg" },
        },
        { tag: "meta", attrs: { property: "og:image:width", content: "1200" } },
        { tag: "meta", attrs: { property: "og:image:height", content: "630" } },
        {
          tag: "meta",
          attrs: {
            property: "og:image:alt",
            content:
              "Castopod mascot waving hello and holding a browser showcasing the Castopod documentation.",
          },
        },
        {
          tag: "meta",
          attrs: { property: "og:url", content: "https://docs.castopod.org/" },
        },
        { tag: "meta", attrs: { name: "twitter:site", content: "@castopod" } },
        {
          tag: "meta",
          attrs: { name: "twitter:card", content: "summary_large_image" },
        },
        {
          tag: "meta",
          attrs: { name: "twitter:creator", content: "@ad_aures" },
        },
        {
          tag: "script",
          attrs: {
            src: "https://analytics.castopod.org/js/plausible.js",
            "data-domain": "docs.castopod.org",
            defer: true,
          },
        },
      ],
      defaultLocale: "en",
      locales: {
        en: {
          label: "English",
        },
        ca: {
          label: "Català",
        },
        de: {
          label: "Deutsch",
        },
        es: {
          label: "Español",
        },
        fr: {
          label: "Français",
        },
        "nn-no": {
          label: "Norsk nynorsk",
          lang: "nn-NO",
        },
        "pt-br": {
          label: "Português do Brasil",
          lang: "pt-BR",
        },
        "sr-latn": {
          label: "Srpski",
          lang: "sr-Latn",
        },
        "zh-hans": {
          label: "中文",
          lang: "zh-Hans",
        },
      },
      social: {
        discord: "https://castopod.org/chat",
        "x.com": "https://twitter.com/castopod",
        mastodon: "https://podlibre.social/@Castopod",
        gitlab: "https://code.castopod.org/adaures/castopod",
        github: "https://github.com/ad-aures/castopod",
      },
      sidebar: [
        {
          label: "Instroduction",
          link: "/",
          translations: {
            fr: "Installer",
            "pt-br": "Instalar",
            "nn-no": "Installer",
          },
        },
        {
          label: "Getting started",
          translations: {
            fr: "Commencer",
            "pt-br": "Começando",
            "nn-no": "Starter",
          },
          items: [
            // Each item here is one entry in the navigation menu.
            {
              label: "Install",
              link: "/getting-started/install/",
              translations: {
                fr: "Installer",
                "pt-br": "Instalar",
                "nn-no": "Installer",
              },
            },
            {
              label: "Docker",
              link: "/getting-started/docker/",
            },
            {
              label: "Security",
              link: "/getting-started/security/",
              translations: {
                fr: "Sécurité",
                "pt-br": "Segurança",
                "nn-no": "Sikkerhet",
              },
            },
            {
              label: "Update",
              link: "/getting-started/update/",
              translations: {
                fr: "Mise à jour",
                "pt-br": "Atualizar",
                "nn-no": "Oppdaterer",
              },
            },
            {
              label: "Auth",
              link: "/getting-started/auth/",
              translations: {
                fr: "Authentification",
                "pt-br": "Autenticação",
                "nn-no": "Autentisering",
              },
            },
          ],
        },
      ],
      editLink: {
        baseUrl:
          "https://code.castopod.org/adaures/castopod/-/edit/develop/docs/",
      },
    }),
    tailwind({
      applyBaseStyles: false,
    }),
  ],
});
