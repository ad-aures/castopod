const Clipboard = (): void => {
  const buttons: NodeListOf<HTMLButtonElement> | null =
    document.querySelectorAll("button[data-type='clipboard-copy']");

  if (buttons) {
    for (let i = 0; i < buttons.length; i++) {
      const button: HTMLButtonElement = buttons[i];
      const element: HTMLFormElement | null = document.querySelector(
        `[id="${button.dataset.clipboardTarget}"]`
      );
      if (element) {
        button.addEventListener("click", () => {
          element.select();
          element.setSelectionRange(0, element.value.length);
          document.execCommand("copy");
        });
      }
    }
  }
};

export default Clipboard;
