/**
 * TODO: refactor file
 */
let timeout: number | null = null;

const playSoundbite = (
  audioPlayer: HTMLAudioElement,
  startTime: number,
  duration: number
): void => {
  audioPlayer.currentTime = startTime;
  if (duration > 0) {
    audioPlayer.play();
    if (timeout) {
      clearTimeout(timeout);
      timeout = null;
    }
    timeout = window.setTimeout(() => {
      audioPlayer.pause();
      timeout = null;
    }, duration * 1000);
  }
};

const Soundbites = (): void => {
  const audioPlayer: HTMLAudioElement | null = document.querySelector("audio");

  if (audioPlayer) {
    const soundbiteButton: HTMLButtonElement | null = document.querySelector(
      "button[data-type='get-soundbite']"
    );
    if (soundbiteButton) {
      const startTimeField: HTMLInputElement | null = document.querySelector(
        `input[name="${soundbiteButton.dataset.startTimeFieldName}"]`
      );
      const durationField: HTMLInputElement | null = document.querySelector(
        `input[name="${soundbiteButton.dataset.durationFieldName}"]`
      );

      if (startTimeField && durationField) {
        soundbiteButton.addEventListener("click", () => {
          if (startTimeField.value === "") {
            startTimeField.value = (
              Math.round(audioPlayer.currentTime * 100) / 100
            ).toString();
          } else {
            durationField.value = (
              Math.round(
                (audioPlayer.currentTime - Number(startTimeField.value)) * 100
              ) / 100
            ).toString();
          }
        });
      }
    }

    const soundbitePlayButtons: NodeListOf<HTMLButtonElement> | null =
      document.querySelectorAll("button[data-type='play-soundbite']");
    if (soundbitePlayButtons) {
      for (let i = 0; i < soundbitePlayButtons.length; i++) {
        const soundbitePlayButton: HTMLButtonElement = soundbitePlayButtons[i];

        soundbitePlayButton.addEventListener("click", () => {
          // get values from inputs to play soundbite
          const startTime: HTMLInputElement | null | undefined =
            soundbitePlayButton.parentElement?.parentElement?.querySelector(
              'input[data-field-type="start_time"]'
            );
          const duration: HTMLInputElement | null | undefined =
            soundbitePlayButton.parentElement?.parentElement?.querySelector(
              'input[data-field-type="duration"]'
            );

          if (startTime && duration) {
            playSoundbite(
              audioPlayer,
              parseFloat(startTime.value),
              parseFloat(duration.value)
            );
          }
        });
      }
    }
  }
};

export default Soundbites;
