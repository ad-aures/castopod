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
import "./_modules/play-episode-button";

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
