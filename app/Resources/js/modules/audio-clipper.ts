import { css, html, LitElement, TemplateResult } from "lit";
import {
  customElement,
  property,
  query,
  queryAssignedNodes,
  state,
} from "lit/decorators.js";
import WaveSurfer from "wavesurfer.js";

enum ACTIONS {
  StretchLeft,
  StretchRight,
  Seek,
}

@customElement("audio-clipper")
export class AudioClipper extends LitElement {
  @queryAssignedNodes("audio", true)
  _audio!: NodeListOf<HTMLAudioElement>;

  @queryAssignedNodes("start_time", true)
  _startTimeInput!: NodeListOf<HTMLInputElement>;

  @queryAssignedNodes("duration", true)
  _durationInput!: NodeListOf<HTMLInputElement>;

  @query(".slider")
  _sliderNode!: HTMLDivElement;

  @query(".slider__segment--wrapper")
  _segmentNode!: HTMLDivElement;

  @query(".slider__segment-content")
  _segmentContentNode!: HTMLDivElement;

  @query(".slider__segment-progress-handle")
  _progressNode!: HTMLDivElement;

  @query("#waveform")
  _waveformNode!: HTMLDivElement;

  @property({ type: Number, attribute: "start-time" })
  startTime = 0;

  @property({ type: Number })
  duration = 10;

  @property({ type: Number, attribute: "min-duration" })
  minDuration = 5;

  @property({ type: Number, attribute: "volume" })
  initVolume = 0.5;

  @state()
  _isPlaying = false;

  @state()
  _clip = {
    startTime: 0,
    endTime: 0,
  };

  @state()
  _action: ACTIONS | null = null;

  @state()
  _audioDuration = 0;

  @state()
  _sliderWidth = 0;

  @state()
  _currentTime = 0;

  @state()
  _volume = 0.5;

  @state()
  _wavesurfer!: WaveSurfer;

  connectedCallback(): void {
    super.connectedCallback();

    console.log("connectedCallback_before");
    this._clip = {
      startTime: this.startTime,
      endTime: this.startTime + this.duration,
    };
    this._volume = this.initVolume;
    console.log("connectedCallback_after");
  }

  protected firstUpdated(): void {
    console.log("firstUpdate");
    this._audioDuration = this._audio[0].duration;
    this._audio[0].volume = this._volume;

    this._wavesurfer = WaveSurfer.create({
      container: this._waveformNode,
      interact: false,
      barWidth: 2,
      barHeight: 1,
      responsive: true,
    });
    this._wavesurfer.load(this._audio[0].src);

    window.addEventListener("load", () => {
      this._sliderWidth = this._sliderNode.clientWidth;
      this.setSegmentPosition();
    });
    window.addEventListener("resize", () => {
      this._sliderWidth = this._sliderNode.clientWidth;
      this.setSegmentPosition();
    });

    document.addEventListener("mouseup", () => {
      if (this._action !== null) {
        this._action = null;
      }
    });
    document.addEventListener("mousemove", (event: MouseEvent) => {
      if (this._action !== null) {
        this.updatePosition(event);
      }
    });

    this._audio[0].addEventListener("play", () => {
      this._isPlaying = true;
    });
    this._audio[0].addEventListener("pause", () => {
      this._isPlaying = false;
    });
    // this._audio[0].addEventListener("timeupdate", () => {
    //   this._currentTime = this._audio[0].currentTime;
    // });
  }

  disconnectedCallback(): void {
    console.log("disconnectedCallback");

    window.removeEventListener("load", () => {
      this._sliderWidth = this._sliderNode.clientWidth;
      this.setSegmentPosition();
    });
    window.removeEventListener("resize", () => {
      this._sliderWidth = this._sliderNode.clientWidth;
      this.setSegmentPosition();
    });

    document.removeEventListener("mouseup", () => {
      if (this._action !== null) {
        this._action = null;
      }
    });
    document.removeEventListener("mousemove", (event: MouseEvent) => {
      if (this._action !== null) {
        this.updatePosition(event);
      }
    });

    this._audio[0].removeEventListener("play", () => {
      this._isPlaying = true;
    });
    this._audio[0].removeEventListener("pause", () => {
      this._isPlaying = false;
    });
    // this._audio[0].removeEventListener("timeupdate", () => {
    //   this._currentTime = this._audio[0].currentTime;
    // });
  }

  setSegmentPosition(): void {
    const startTimePosition = this.getPositionFromSeconds(this._clip.startTime);
    const endTimePosition = this.getPositionFromSeconds(this._clip.endTime);

    this._segmentNode.style.transform = `translateX(${startTimePosition}px)`;
    this._segmentContentNode.style.width = `${
      endTimePosition - startTimePosition
    }px`;
  }

  getPositionFromSeconds(seconds: number) {
    return (seconds * this._sliderWidth) / this._audioDuration;
  }

  getSecondsFromPosition(position: number) {
    return (this._audioDuration * position) / this._sliderWidth;
  }

  protected updated(
    _changedProperties: Map<string | number | symbol, unknown>
  ): void {
    // console.log("updated", _changedProperties);

    if (_changedProperties.has("_clip")) {
      // console.log("CLIP", _changedProperties.get("_clip"));
      this.pause();
      this.setSegmentPosition();
      console.log(this._clip.startTime);
      this._audio[0].currentTime = 58;
      console.log(this._audio[0].currentTime);
    }
  }

  play(): void {
    this._audio[0].play();
    // setTimeout(() => {
    //   this.pause();
    //   this._audio[0].currentTime = this._clip.startTime;
    // }, (this._clip.endTime - this._clip.startTime) * 1000);
  }

  pause(): void {
    this._audio[0].pause();
  }

  updatePosition(event: MouseEvent): void {
    const cursorPosition =
      event.clientX -
      (this._sliderNode.getBoundingClientRect().left +
        document.documentElement.scrollLeft);

    const seconds = this.getSecondsFromPosition(cursorPosition);

    switch (this._action) {
      case ACTIONS.StretchLeft: {
        let startTime;
        if (seconds > 0) {
          if (seconds > this._clip.endTime - this.minDuration) {
            startTime = this._clip.endTime - this.minDuration;
          } else {
            startTime = seconds;
          }
        } else {
          startTime = 0;
        }
        this._clip = {
          startTime,
          endTime: this._clip.endTime,
        };
        break;
      }
      case ACTIONS.StretchRight: {
        let endTime;
        if (seconds < this._audioDuration) {
          if (seconds < this._clip.startTime + this.minDuration) {
            endTime = this._clip.startTime + this.minDuration;
          } else {
            endTime = seconds;
          }
        } else {
          endTime = this._audioDuration;
        }

        this._clip = {
          startTime: this._clip.startTime,
          endTime,
        };
        break;
      }
      case ACTIONS.Seek: {
        console.log("seeking");
        break;
      }
      default:
        break;
    }
  }

  setVolume(event: InputEvent): void {
    this._volume = parseFloat((event.target as HTMLInputElement).value);
    this._audio[0].volume = this._volume;
  }

  setCurrentTime(event: MouseEvent): void {
    const cursorPosition =
      event.clientX -
      (this._sliderNode.getBoundingClientRect().left +
        document.documentElement.scrollLeft);

    const seconds = this.getSecondsFromPosition(cursorPosition);
    this._audio[0].currentTime = seconds;
  }

  setAction(action: ACTIONS): void {
    this._action = action;
  }

  secondsToHHMMSS(seconds: number): string {
    return new Date(seconds * 1000).toISOString().substr(11, 8);
  }

  static styles = css`
    .slider {
      position: relative;
      height: 6rem;
      display: flex;
      align-items: center;
      width: 100%;
      background-color: #0f172a;
    }

    .slider__track-placeholder {
      width: 100%;
      height: 8px;
      background-color: #64748b;
    }

    .slider__segment--wrapper {
      position: absolute;
    }

    .slider__segment {
      position: relative;
      display: flex;
    }

    .slider__segment-content {
      background-color: rgba(255, 255, 255, 0.9);
      height: 4rem;
      width: 1px;
      border: none;
    }

    .slider__segment-progress-handle {
      position: absolute;
      width: 9px;
      height: 9px;
      margin-top: -9px;
      margin-left: -4px;
      background-color: #3b82f6;
      cursor: pointer;
    }

    .slider__segment .slider__segment-handle {
      position: absolute;
      cursor: pointer;
      width: 1rem;
      height: 100%;
      background-color: #b91c1c;
      border: none;
    }

    .slider__segment .slider__segment-handle::before {
      content: "";
      position: absolute;
      height: 3rem;
      width: 2px;
      background-color: #ffffff;
      margin: auto;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
    }

    .slider__segment .clipper__handle-left {
      left: -1rem;
      border-radius: 0.2rem 0 0 0.2rem;
    }

    .slider__segment .clipper__handle-right {
      right: -1rem;
      border-radius: 0 0.2rem 0.2rem 0;
    }
  `;

  render(): TemplateResult<1> {
    return html`
      <slot name="audio"></slot>
      <slot name="start_time"></slot>
      <slot name="duration"></slot>
      <div>${this.secondsToHHMMSS(this._clip.startTime)}</div>
      <div>${this.secondsToHHMMSS(this._currentTime)}</div>
      <div>${this.secondsToHHMMSS(this._clip.endTime)}</div>
      <input
        type="range"
        id="volume"
        min="0"
        max="1"
        step="0.1"
        value="${this._volume}"
        @change="${this.setVolume}"
      />
      <div id="waveform"></div>
      <div class="slider" role="slider">
        <div class="slider__track-placeholder"></div>
        <div class="slider__segment--wrapper">
          <div
            class="slider__segment-progress-handle"
            @mousedown="${() => this.setAction(ACTIONS.Seek)}"
          ></div>
          <!-- <div class="slider__segment-progress-handle-bar"></div> -->
          <div class="slider__segment">
            <button
              class="slider__segment-handle clipper__handle-left"
              title="${this.secondsToHHMMSS(this._clip.startTime)}"
              @mousedown="${() => this.setAction(ACTIONS.StretchLeft)}"
            ></button>
            <div
              class="slider__segment-content"
              @click="${this.setCurrentTime}"
            ></div>
            <button
              class="slider__segment-handle clipper__handle-right"
              title="${this.secondsToHHMMSS(this._clip.endTime)}"
              @mousedown="${() => this.setAction(ACTIONS.StretchRight)}"
            ></button>
          </div>
        </div>
      </div>
      <button @click="${this._isPlaying ? this.pause : this.play}">
        ${this._isPlaying
          ? html`<svg
              viewBox="0 0 24 24"
              fill="currentColor"
              width="1em"
              height="1em"
            >
              <g>
                <path fill="none" d="M0 0h24v24H0z" />
                <path d="M6 5h2v14H6V5zm10 0h2v14h-2V5z" />
              </g>
            </svg>`
          : html` <svg
              viewBox="0 0 24 24"
              fill="currentColor"
              width="1em"
              height="1em"
            >
              <path fill="none" d="M0 0h24v24H0z" />
              <path
                d="M7.752 5.439l10.508 6.13a.5.5 0 0 1 0 .863l-10.508 6.13A.5.5 0 0 1 7 18.128V5.871a.5.5 0 0 1 .752-.432z"
              />
            </svg>`}
      </button>
    `;
  }
}
