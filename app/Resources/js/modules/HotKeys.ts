import { install } from "@github/hotkey";

const HotKeys = (): void => {
  const hotkeys: NodeListOf<HTMLElement> =
    document.querySelectorAll("[data-hotkey]");

  // Install all the hotkeys on the page
  for (let i = 0; i < hotkeys.length; i++) {
    const hotkey = hotkeys[i];
    install(hotkey);
  }
};

export default HotKeys;
