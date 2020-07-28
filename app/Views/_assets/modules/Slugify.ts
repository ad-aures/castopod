// Original code from: https://gist.github.com/hagemann/382adfc57adbd5af078dc93feef01fe1
const slugify = (text: string) => {
  const a =
    "àáâäæãåāăąçćčđďèéêëēėęěğǵḧîïíīįìłḿñńǹňôöòóœøōõőṕŕřßśšşșťțûüùúūǘůűųẃẍÿýžźż·/_,:;";
  const b =
    "aaaaaaaaaacccddeeeeeeeegghiiiiiilmnnnnoooooooooprrsssssttuuuuuuuuuwxyyzzz------";
  const p = new RegExp(a.split("").join("|"), "g");

  return text
    .toString()
    .toLowerCase()
    .replace(/\s+/g, "-") // Replace spaces with -
    .replace(p, (c) => b.charAt(a.indexOf(c))) // Replace special characters
    .replace(/&/g, "-and-") // Replace & with 'and'
    .replace(/[^\w-]+/g, "") // Remove all non-word characters
    .replace(/--+/g, "-") // Replace multiple - with single -
    .replace(/^-+/, "") // Trim - from start of text
    .replace(/-+$/, ""); // Trim - from end of text
};

const Slugify = (): void => {
  const title: HTMLInputElement | null = document.querySelector(
    "input[data-slugify='title']"
  );
  const slug: HTMLInputElement | null = document.querySelector(
    "input[data-slugify='slug']"
  );

  if (title && slug) {
    title.addEventListener("input", () => {
      slug.value = slugify(title.value);
    });
  }
};

export default Slugify;
