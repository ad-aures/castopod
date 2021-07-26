const Clipboard = (): void => {
  const buttons: NodeListOf<HTMLButtonElement> | null =
    document.querySelectorAll("button[data-type='clipboard-copy']");

  if (buttons) {
    for (let i = 0; i < buttons.length; i++) {
      const button: HTMLButtonElement = buttons[i];
      const textArea: HTMLTextAreaElement | null = document.querySelector(
        `textarea[id="${button.dataset.clipboardTarget}"]`
      );
      if (textArea) {
        button.addEventListener("click", () => {
          textArea.select();
          textArea.setSelectionRange(0, textArea.value.length);
          document.execCommand("copy");
        });
      }
    }
  }
};

export default Clipboard;
