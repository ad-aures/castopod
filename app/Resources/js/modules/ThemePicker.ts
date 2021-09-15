const ThemePicker = (): void => {
  const buttons: NodeListOf<HTMLButtonElement> | null =
    document.querySelectorAll("button[data-type='theme-picker']");
  const iframe: HTMLIFrameElement | null = document.querySelector(
    `iframe[id="embeddable_player"]`
  );
  const iframeTextArea: HTMLFormElement | null =
    document.querySelector(`[id="iframe"]`);
  const urlTextArea: HTMLFormElement | null =
    document.querySelector(`[id="url"]`);

  if (buttons && iframe && iframeTextArea && urlTextArea) {
    for (let i = 0; i < buttons.length; i++) {
      const button: HTMLButtonElement = buttons[i];
      const url: string | undefined = button.dataset.url;
      if (url) {
        button.addEventListener("click", () => {
          iframeTextArea.value = `<iframe width="100%" height="280" frameborder="0" scrolling="no" style="width: 100%; height: 280px;  overflow: hidden;" src="${url}"></iframe>`;
          urlTextArea.value = url;
          iframe.src = url;
        });
      }
    }
  }
};

export default ThemePicker;
