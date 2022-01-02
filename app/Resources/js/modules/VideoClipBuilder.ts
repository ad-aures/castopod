const VideoClipBuilder = (): void => {
  const form = document.querySelector("form[id=new-video-clip-form]");

  if (form) {
    const videoClipPreviewer = form?.querySelector("video-clip-previewer");

    if (videoClipPreviewer) {
      const themeOptions: NodeListOf<HTMLInputElement> = form.querySelectorAll(
        'input[name="theme"]'
      ) as NodeListOf<HTMLInputElement>;
      const formatOptions: NodeListOf<HTMLInputElement> = form.querySelectorAll(
        'input[name="format"]'
      ) as NodeListOf<HTMLInputElement>;

      const titleInput = form.querySelector(
        'input[name="label"]'
      ) as HTMLInputElement;
      if (titleInput) {
        videoClipPreviewer.setAttribute("title", titleInput.value || "");
        titleInput.addEventListener("input", () => {
          videoClipPreviewer.setAttribute("title", titleInput.value || "");
        });
      }

      let format = (
        form.querySelector('input[name="format"]:checked') as HTMLInputElement
      )?.value;
      videoClipPreviewer.setAttribute("format", format);
      const watchFormatChange = (event: Event) => {
        format = (event.target as HTMLInputElement).value;
        videoClipPreviewer.setAttribute("format", format);
      };
      for (let i = 0; i < formatOptions.length; i++) {
        formatOptions[i].addEventListener("change", watchFormatChange);
      }

      let theme = form
        .querySelector('input[name="theme"]:checked')
        ?.parentElement?.style.getPropertyValue("--color-accent-base");
      videoClipPreviewer.setAttribute("theme", theme || "");

      const watchThemeChange = (event: Event) => {
        theme =
          (
            event.target as HTMLInputElement
          ).parentElement?.style.getPropertyValue("--color-accent-base") ??
          theme;
        videoClipPreviewer.setAttribute("theme", theme || "");
      };
      for (let i = 0; i < themeOptions.length; i++) {
        themeOptions[i].addEventListener("change", watchThemeChange);
      }

      const durationInput = form.querySelector(
        'input[name="duration"]'
      ) as HTMLInputElement;
      if (durationInput) {
        videoClipPreviewer.setAttribute("duration", durationInput.value || "0");
        durationInput.addEventListener("change", () => {
          videoClipPreviewer.setAttribute(
            "duration",
            durationInput.value || "0"
          );
        });
      }
    }
  }
};

export default VideoClipBuilder;
