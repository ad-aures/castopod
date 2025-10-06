// @ts-check
import { defineConfig } from "astro/config";
import starlight from "@astrojs/starlight";
import starlightOpenAPI from "starlight-openapi";

const site = "https://docs.castopod.org/";
const base = process.env.BASE ?? "/docs";

// https://astro.build/config
export default defineConfig({
  server: {
    host: true,
  },
  site,
  base,
  integrations: [
    starlight({
      title: "Castopod Docs",
      description:
        "Check out the Castopod documentation! Install your own free & open-source podcast host, help make it better by contributing, or simply learn more about Castopod!",
      components: {
        ThemeSelect: "./src/components/ThemeSelect.astro",
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
        "./src/styles/custom.css",
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
      social: [
        {
          icon: "discord",
          label: "Discord",
          href: "https://castopod.org/chat",
        },
        {
          icon: "blueSky",
          label: "Bluesky",
          href: "https://bsky.app/profile/castopod.org",
        },
        {
          icon: "mastodon",
          label: "Mastodon",
          href: "https://podlibre.social/@Castopod",
        },
        {
          icon: "gitlab",
          label: "Source code",
          href: "https://code.castopod.org/adaures/castopod",
        },
        {
          icon: "github",
          label: "Github",
          href: "https://github.com/ad-aures/castopod",
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
      plugins: [
        // Generate the OpenAPI documentation pages.
        starlightOpenAPI([
          {
            base: "en/api",
            label: "API reference",
            schema: "../modules/Api/Rest/V1/schema.yaml",
            collapsed: true,
          },
        ]),
      ],
      sidebar: [
        {
          label: "Introduction",
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
            {
              label: "Create your first podcast",
              link: "/getting-started/create-podcast/",
              translations: {},
            },
            {
              label: "Create your first episode",
              link: "/getting-started/create-episode/",
              translations: {},
            },
          ],
        },
        {
          label: "Plugins",
          items: [
            {
              label: "Introduction",
              link: "/plugins/",
            },
            {
              label: "Install plugins",
              link: "/plugins/install",
            },
            {
              label: "Create a plugin",
              link: "/plugins/create",
            },
            {
              label: "Share your plugin",
              link: "/plugins/share",
            },
            {
              label: "Reference",
              items: [
                {
                  label: "plugins.json",
                  link: "/plugins/reference/plugins-json",
                },
                {
                  label: "plugins-lock.json",
                  link: "/plugins/reference/plugins-lock-json",
                },
                {
                  label: "manifest.json",
                  link: "/plugins/reference/manifest",
                },
                {
                  label: "hooks",
                  link: "/plugins/reference/hooks",
                },
              ],
            },
          ],
        },
        // TODO: openapi plugin does not handle i18n, manual sidebar workaround
        // Add the generated sidebar group to the sidebar.
        // ...openAPISidebarGroups,
        {
          label: "API reference",
          translations: {},
          items: [
            {
              label: "Overview",
              link: "/api",
            },
            {
              label: "Operations",
              items: [
                {
                  label: "Get all podcasts",
                  link: "/api/operations/get-all-podcasts",
                },
                {
                  label: "Get podcast by ID",
                  link: "/api/operations/get-podcast-by-id",
                },
                {
                  label: "Get all episodes",
                  link: "/api/operations/get-all-episodes",
                },
                {
                  label: "Add a new episode",
                  link: "/api/operations/add-episode",
                },
                {
                  label: "Get episode by ID",
                  link: "/api/operations/get-episode-by-id",
                },
                {
                  label: "Publish an episode",
                  link: "/api/operations/publish-episode",
                },
              ],
            },
          ],
        },
        {
          label: "User guide",
          translations: {},
          items: [
            {
              label: "Introduction",
              link: "/user-guide/",
            },
            {
              label: "Manage your instance",
              translations: {},
              collapsed: true,
              items: [
                {
                  label: "Introduction",
                  link: "/user-guide/instance/",
                },
                {
                  label: "Add a podcast",
                  link: "/user-guide/instance/podcast",
                  translations: {},
                },
                {
                  label: "Persons",
                  link: "/user-guide/instance/persons",
                  translations: {},
                },

                {
                  label: "Fediverse",
                  link: "/user-guide/instance/fediverse",
                  translations: {},
                },
                {
                  label: "Users",
                  link: "/user-guide/instance/users",
                  translations: {},
                },
                {
                  label: "Pages",
                  link: "/user-guide/instance/pages",
                  translations: {},
                },
                {
                  label: "Settings",
                  link: "/user-guide/instance/settings",
                  translations: {},
                },
              ],
            },
            {
              label: "Manage your podcasts",
              translations: {},
              collapsed: true,
              items: [
                {
                  label: "Introduction",
                  link: "/user-guide/podcast/",
                },
                {
                  label: "Podcast dashboard",
                  link: "/user-guide/podcast/dashboard",
                  translations: {},
                },
                {
                  label: "Episodes",
                  link: "/user-guide/podcast/episodes",
                  translations: {},
                },

                {
                  label: "Analytics",
                  link: "/user-guide/podcast/analytics",
                  translations: {},
                },
                {
                  label: "Broadcasting",
                  link: "/user-guide/podcast/broadcast",
                  translations: {},
                },
                {
                  label: "Contributors",
                  link: "/user-guide/podcast/contributors",
                  translations: {},
                },
              ],
            },
            {
              label: "Website overview",
              link: "/user-guide/website/",
              translations: {},
            },
          ],
        },
      ],
      editLink: {
        baseUrl: "https://code.castopod.org/adaures/castopod/-/edit/main/docs/",
      },
    }),
  ],
});
