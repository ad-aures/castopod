import { defineConfig } from "vitepress";

export default defineConfig({
  title: "Castopod docs",
  description:
    "Check out the Castopod documentation! Install your own free & open-source podcast host, help make it better by contributing, or simply learn more about Castopod!",
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
          "Castopod mascot waving hello and hoding a browser showcasing the Castopod documentation.",
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

  themeConfig: {
    logo: "/images/castopod-icon.svg",
    lastUpdated: "Last Updated",
    repo: "https://code.castopod.org/ad-aures/castopod",
    docsDir: "docs/src",
    docsBranch: "develop",
    editLinks: true,
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
      "/": getGuideSidebar(),
    },
  },
});

function getGuideSidebar() {
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
