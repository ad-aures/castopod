import { css, html, LitElement, TemplateResult } from "lit";
import { customElement, property, queryAssignedNodes } from "lit/decorators.js";
import { styleMap } from "lit/directives/style-map.js";

enum VideoFormats {
  Landscape = "landscape",
  Portrait = "portrait",
  Squared = "squared",
}

const formatMap = {
  [VideoFormats.Landscape]: "16/9",
  [VideoFormats.Portrait]: "9/16",
  [VideoFormats.Squared]: "1/1",
};

@customElement("video-clip-previewer")
export class VideoClipPreviewer extends LitElement {
  @queryAssignedNodes("preview_image", true)
  _previewImage!: NodeListOf<HTMLImageElement>;

  @property()
  format: VideoFormats = VideoFormats.Landscape;

  @property()
  theme = "#009486";

  static styles = css`
    .video-background {
      display: grid;
      justify-items: center;
      align-items: center;
      background-color: black;
      width: 100%;
      aspect-ratio: 16 / 9;
    }

    .video-format {
      display: grid;
      align-items: center;
      justify-items: center;
      height: 100%;
    }
  `;

  render(): TemplateResult<1> {
    const styles = {
      aspectRatio: formatMap[this.format],
      backgroundColor: this.theme,
    };

    return html`<div class="video-background">
      <div class="video-format" style=${styleMap(styles)}>
        <slot name="preview_image"></slot>
      </div>
    </div>`;
  }
}
