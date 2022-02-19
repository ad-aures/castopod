import { defineConfig } from "vitepress";

export default defineConfig({
  title: "Castopod docs",
  description:
    "Get started with Castopod, install it, contribute and learn more!",
  srcDir: "src",

  head: [
    ["link", { rel: "icon", type: "image/x-icon", href: "/favicon.ico" }],
    ["meta", { name: "twitter:site", content: "@castopod" }],
    ["meta", { name: "twitter:card", content: "summary" }],
    [
      "meta",
      {
        name: "twitter:image",
        content: "https://docs.castopod.org/images/logo.png",
      },
    ],
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
