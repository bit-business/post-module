// @ts-check
// Note: type annotations allow type checking and IDEs autocompletion

const lightCodeTheme = require("prism-react-renderer/themes/github");
const darkCodeTheme = require("prism-react-renderer/themes/dracula");

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: "Skijasi Post Module Documentation",
  tagline: "Skijasi post module official documentation",
  url: "https://skijasi-post.uatech.co.id",
  baseUrl: "/",
  onBrokenLinks: "throw",
  onBrokenMarkdownLinks: "warn",
  favicon: "img/favicon.ico",
  organizationName: "nadzorservera-croatia", // Usually your GitHub org/user name.
  projectName: "skijasi-post-module", // Usually your repo name.
  trailingSlash: false,

  i18n: {
    defaultLocale: "en",
    locales: ["en", "id"],
  },

  presets: [
    [
      "classic",
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          sidebarPath: require.resolve("./sidebars.js"),
          // Please change this to your repo.
          editUrl: "https://github.com/nadzorservera-croatia/skijasi-post-module/edit/main/website/",
          routeBasePath: "/",
        },
        blog: {
          showReadingTime: true,
          // Please change this to your repo.
          editUrl:
            "https://github.com/nadzorservera-croatia/skijasi-post-module/edit/main/website/blog/",
        },
        theme: {
          customCss: require.resolve("./src/css/custom.css"),
        },
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      navbar: {
        title: "Skijasi Post Module",
        logo: {
          alt: "Skijasi Post Module Logo",
          src: "img/skijasi-post-logo.png",
        },
        items: [
          // {
          //   type: "doc",
          //   docId: "introduction",
          //   position: "left",
          //   label: "Tutorial",
          // },
          
          {
            type: "localeDropdown",
            position: "right",
          },

          {
            href: "https://github.com/nadzorservera-croatia/skijasi-post-module",
            label: "GitHub",
            position: "right",
          },
        ],
      },
      footer: {
        style: "dark",
        links: [
          {
            title: "Learn",
            items: [
              {
                label: "Introduction",
                to: "/",
              },
              {
                label: "Installation",
                to: "/getting-started/installation",
              },
            ],
          },
          {
            title: "Community",
            items: [
              {
                label: "Facebook",
                href: "https://www.facebook.com/groups/skijasi",
              },
              {
                label: "Telegram",
                href: "https://t.me/skijasi_developers",
              },
            ],
          },
          {
            title: "More",
            items: [
              {
                label: "Donation",
                to: "https://opencollective.com/skijasi",
              },
            ],
          },
        ],
        copyright: `Copyright © ${new Date().getFullYear()} NADZORSERVERA. All right reserved`,
      },
      prism: {
        theme: lightCodeTheme,
        darkTheme: darkCodeTheme,
      },
    }),
};

module.exports = config;
