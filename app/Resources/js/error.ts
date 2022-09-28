import "@github/clipboard-copy-element";

document.addEventListener("clipboard-copy", function (event) {
  const button = event.target as HTMLButtonElement;
  button.classList.add(
    "[&>.copy-base]:hidden",
    "[&>.copy-success]:inline-flex"
  );
  setTimeout(() => {
    button.classList.remove(
      "[&>.copy-base]:hidden",
      "[&>.copy-success]:inline-flex"
    );
  }, 1000);
});
