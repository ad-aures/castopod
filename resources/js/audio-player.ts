import {
  VmAudio,
  VmCaptions,
  VmClickToPlay,
  VmControl,
  VmControls,
  VmCurrentTime,
  VmDefaultControls,
  VmDefaultSettings,
  VmDefaultUi,
  VmEndTime,
  VmFile,
  VmIcon,
  VmIconLibrary,
  VmLoadingScreen,
  VmMenu,
  VmMenuItem,
  VmMenuRadio,
  VmMenuRadioGroup,
  VmMuteControl,
  VmPlaybackControl,
  VmPlayer,
  VmScrubberControl,
  VmSettings,
  VmSettingsControl,
  VmSkeleton,
  VmSlider,
  VmSubmenu,
  VmTime,
  VmTimeProgress,
  VmTooltip,
  VmUi,
  VmVolumeControl,
} from "@vime/core";
import "@vime/core/themes/default.css";
import "@vime/core/themes/light.css";
import { html, render } from "lit";
import "./_modules/play-episode-button";

const player = html`<div
  id="castopod-audio-player"
  class="fixed bottom-0 left-0 flex flex-col w-full bg-elevated border-t border-subtle sm:flex-row z-50"
  data-episode="-1"
  style="display: none;"
>
  <div class="flex items-center">
    <img src="" alt="" class="h-[52px] w-[52px]" loading="lazy" />
    <div class="flex flex-col px-2">
      <p
        class="text-sm w-48 truncate font-semibold"
        title=""
        id="castopod-player-title"
      ></p>
      <p
        class="text-xs w-48 truncate"
        title=""
        id="castopod-player-podcast"
      ></p>
    </div>
  </div>
  <vm-player
    id="castopod-vm-player"
    theme="light"
    language="en"
    class="flex-1"
    icons="castopod-vm-player-icons"
    style="--vm-player-box-shadow:0; --vm-player-theme: hsl(var(--color-accent-base)); --vm-control-focus-color: hsl(var(--color-accent-contrast)); --vm-menu-item-focus-bg: hsl(var(--color-background-highlight));"
  >
    <vm-audio preload="none" id="testing-audio">
      <source src="" type="" />
    </vm-audio>
    <vm-ui>
      <vm-icon-library name="castopod-vm-player-icons"></vm-icon-library>
      <vm-controls full-width>
        <vm-playback-control></vm-playback-control>
        <vm-volume-control></vm-volume-control>
        <vm-current-time></vm-current-time>
        <vm-scrubber-control></vm-scrubber-control>
        <vm-end-time></vm-end-time>
        <vm-settings-control></vm-settings-control>
        <vm-default-settings></vm-default-settings>
      </vm-controls>
    </vm-ui>
  </vm-player>
</div>`;

render(player, document.body);

// Register Castopod's vm player icons library
const library: HTMLVmIconLibraryElement | null = document.querySelector(
  'vm-icon-library[name="castopod-vm-player-icons"]'
);
if (library) {
  library.resolver = (iconName) => `/assets/vm-player-icons/${iconName}.svg`;
}

// Vime elements for audio player
customElements.define("vm-player", VmPlayer);
customElements.define("vm-file", VmFile);
customElements.define("vm-audio", VmAudio);
customElements.define("vm-ui", VmUi);
customElements.define("vm-default-ui", VmDefaultUi);
customElements.define("vm-click-to-play", VmClickToPlay);
customElements.define("vm-captions", VmCaptions);
customElements.define("vm-loading-screen", VmLoadingScreen);
customElements.define("vm-default-controls", VmDefaultControls);
customElements.define("vm-default-settings", VmDefaultSettings);
customElements.define("vm-controls", VmControls);
customElements.define("vm-playback-control", VmPlaybackControl);
customElements.define("vm-volume-control", VmVolumeControl);
customElements.define("vm-scrubber-control", VmScrubberControl);
customElements.define("vm-current-time", VmCurrentTime);
customElements.define("vm-end-time", VmEndTime);
customElements.define("vm-settings-control", VmSettingsControl);
customElements.define("vm-time-progress", VmTimeProgress);
customElements.define("vm-control", VmControl);
customElements.define("vm-icon", VmIcon);
customElements.define("vm-icon-library", VmIconLibrary);
customElements.define("vm-tooltip", VmTooltip);
customElements.define("vm-mute-control", VmMuteControl);
customElements.define("vm-slider", VmSlider);
customElements.define("vm-time", VmTime);
customElements.define("vm-menu", VmMenu);
customElements.define("vm-menu-item", VmMenuItem);
customElements.define("vm-submenu", VmSubmenu);
customElements.define("vm-menu-radio-group", VmMenuRadioGroup);
customElements.define("vm-menu-radio", VmMenuRadio);
customElements.define("vm-settings", VmSettings);
customElements.define("vm-skeleton", VmSkeleton);
