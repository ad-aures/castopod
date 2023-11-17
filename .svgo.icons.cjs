module.exports = {
  plugins: [
    "removeXMLNS",
    "removeDimensions",
    "sortAttrs",
    {
      name: "addAttributesToSVGElement",
      params: {
        attributes: [
          { fill: "currentColor" },
          { width: "1em" },
          { height: "1em" },
        ],
      },
    },
  ],
};
