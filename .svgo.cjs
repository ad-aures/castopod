module.exports = {
  plugins: [
    {
      name: "removeViewBox",
      active: false,
    },
    "removeXMLNS",
    "removeDimensions",
    "sortAttrs",
    "prefixIds",
  ],
};
