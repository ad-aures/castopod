import { css, html, LitElement, TemplateResult } from "lit";
import {
  customElement,
  property,
  queryAssignedNodes,
  state,
} from "lit/decorators.js";
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
  _image!: NodeListOf<HTMLImageElement>;

  @property()
  title = "";

  @property()
  format: VideoFormats = VideoFormats.Portrait;

  @property()
  theme = "173 44% 96%";

  @property({ type: Number })
  duration!: number;

  @state()
  _previewImage!: HTMLImageElement;

  protected firstUpdated(): void {
    this._previewImage = this._image[0].cloneNode(true) as HTMLImageElement;
    this._previewImage.classList.add("preview-bg");
  }

  private secondsToHHMMSS(seconds: number) {
    // Adapted from https://stackoverflow.com/a/34841026
    const h = Math.floor(seconds / 3600);
    const min = Math.floor(seconds / 60) % 60;
    const s = seconds % 60;

    return [h, min, s]
      .map((v) => (v < 10 ? "0" + v : v))
      .filter((v, i) => v !== "00" || i > 0)
      .join(":");
  }

  static styles = css`
    .metadata {
      position: absolute;
      top: 1rem;
      left: 1.5rem;
      color: #ffffff;
      display: flex;
      flex-direction: column;
    }

    .title {
      font-family: "Kumbh Sans";
      font-weight: 900;
      font-size: 1.5rem;
      text-shadow: 2px 3px 5px rgba(0, 0, 0, 0.5);
    }

    .duration {
      font-family: "Inter";
      font-weight: 600;
    }

    .preview-bg {
      position: absolute;
      background-color: red;
      width: 100%;
      object-fit: cover;
      filter: blur(30px);
      opacity: 0.5;
    }

    .video-background {
      position: relative;
      display: grid;
      justify-items: center;
      align-items: center;
      background-color: black;
      width: 100%;
      aspect-ratio: 16 / 9;
      border-radius: 0.75rem 0.75rem 0 0;
      overflow: hidden;
    }

    .video-format {
      z-index: 10;
      display: grid;
      align-items: center;
      justify-items: center;
      height: 100%;
      border: 4px solid hsl(0 0% 100% / 0.5);
      transition: 300ms ease-in-out aspect-ratio;
    }

    ::slotted(img) {
      border-radius: 0.5rem;
      box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1),
        0 2px 4px -2px rgb(0 0 0 / 0.1);
    }
  `;

  render(): TemplateResult<1> {
    const styles = {
      aspectRatio: formatMap[this.format],
      backgroundColor: `hsl(${this.theme})`,
    };

    return html`<div class="video-background">
      ${this._previewImage}
      <div class="video-format" style=${styleMap(styles)}>
        <div class="metadata">
          <span class="title">${this.title}</span>
          <time datetime="PT${this.duration}S" class="duration"
            >${this.secondsToHHMMSS(Math.floor(this.duration))}</time
          >
        </div>
        <slot name="preview_image"></slot>
      </div>
    </div>`;
  }
}
