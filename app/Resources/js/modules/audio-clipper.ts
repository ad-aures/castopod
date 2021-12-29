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

interface EventElement {
  events: string[];
  onEvent: EventListener;
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

  @query(".slider__seeking-placeholder")
  _seekingNode!: HTMLDivElement;

  @query("#waveform")
  _waveformNode!: HTMLDivElement;

  @property({ type: Number, attribute: "start-time" })
  initStartTime = 0;

  @property({ type: Number, attribute: "duration" })
  initDuration = 10;

  @property({ type: Number, attribute: "min-duration" })
  minDuration = 5;

  @property({ type: Number, attribute: "volume" })
  initVolume = 0.5;

  @property({ type: Number, attribute: "height" })
  height = 100;

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
  _isLoading = false;

  @state()
  _seekingTime: number | null = null;

  @state()
  _wavesurfer!: WaveSurfer;

  _windowEvents: EventElement[] = [
    {
      events: ["load", "resize"],
      onEvent: () => {
        this._sliderWidth = this._sliderNode.clientWidth;
        this.setSegmentPosition();
      },
    },
  ];

  _documentEvents: EventElement[] = [
    {
      events: ["mouseup"],
      onEvent: () => {
        if (this._action !== null) {
          document.body.style.cursor = "";
          if (this._action === ACTIONS.Seek && this._seekingTime) {
            this._audio[0].currentTime = this._seekingTime;
            this._seekingTime = 0;
          }
          this._action = null;
        }
      },
    },
    {
      events: ["mousemove"],
      onEvent: (event: Event) => {
        if (this._action !== null) {
          this.updatePosition(event as MouseEvent);
        }
      },
    },
  ];

  _audioEvents: EventElement[] = [
    {
      events: ["play"],
      onEvent: () => {
        this._isPlaying = true;
      },
    },
    {
      events: ["pause"],
      onEvent: () => {
        this._isPlaying = false;
      },
    },
    {
      events: ["complete"],
      onEvent: () => {
        this._isLoading = false;
      },
    },
    {
      events: ["timeupdate"],
      onEvent: () => {
        // TODO: change this
        this._currentTime = this._audio[0].currentTime;
        if (this._currentTime > this._clip.endTime) {
          this.pause();
        } else if (this._currentTime < this._clip.startTime) {
          this._audio[0].currentTime = this._clip.startTime;
        } else {
          this.setCurrentTime(this._currentTime);
        }
      },
    },
  ];

  connectedCallback(): void {
    super.connectedCallback();

    this._clip = {
      startTime: this.initStartTime,
      endTime: this.initStartTime + this.initDuration,
    };
    this._volume = this.initVolume;
  }

  protected firstUpdated(): void {
    this._audioDuration = this._audio[0].duration;
    this._audio[0].volume = this._volume;
    this._audio[0].currentTime = this._clip.startTime;
    this._isLoading = true;

    this._wavesurfer = WaveSurfer.create({
      container: this._waveformNode,
      height: this.height,
      interact: false,
      barWidth: 4,
      barHeight: 1,
      barGap: 4,
      responsive: true,
      cursorColor: "transparent",
    });
    this._wavesurfer.load(this._audio[0].src);

    this.addEventListeners();
  }

  disconnectedCallback(): void {
    super.disconnectedCallback();

    this.removeEventListeners();
  }

  addEventListeners(): void {
    for (const event of this._windowEvents) {
      event.events.forEach((name) => {
        window.addEventListener(name, event.onEvent);
      });
    }

    for (const event of this._documentEvents) {
      event.events.forEach((name) => {
        document.addEventListener(name, event.onEvent);
      });
    }

    for (const event of this._audioEvents) {
      event.events.forEach((name) => {
        this._audio[0].addEventListener(name, event.onEvent);
      });
    }
  }

  removeEventListeners(): void {
    for (const event of this._windowEvents) {
      event.events.forEach((name) => {
        window.removeEventListener(name, event.onEvent);
      });
    }

    for (const event of this._documentEvents) {
      event.events.forEach((name) => {
        document.removeEventListener(name, event.onEvent);
      });
    }

    for (const event of this._audioEvents) {
      event.events.forEach((name) => {
        this._audio[0].removeEventListener(name, event.onEvent);
      });
    }
  }

  setSegmentPosition(): void {
    const startTimePosition = this.getPositionFromSeconds(this._clip.startTime);
    const endTimePosition = this.getPositionFromSeconds(this._clip.endTime);

    this._segmentNode.style.transform = `translateX(${startTimePosition}px)`;
    this._segmentContentNode.style.width = `${
      endTimePosition - startTimePosition
    }px`;
  }

  private getPositionFromSeconds(seconds: number) {
    return (seconds * this._sliderWidth) / this._audioDuration;
  }

  private getSecondsFromPosition(position: number) {
    return (this._audioDuration * position) / this._sliderWidth;
  }

  protected updated(
    _changedProperties: Map<string | number | symbol, unknown>
  ): void {
    if (_changedProperties.has("_clip")) {
      this.pause();
      this.setSegmentPosition();
      this._audio[0].currentTime = this._clip.startTime;
    }
    if (_changedProperties.has("_seekingTime")) {
      if (this._seekingTime) {
        this._audio[0].currentTime = this._seekingTime;
      }
    }
  }

  play(): void {
    this._audio[0].play();
  }

  pause(): void {
    this._audio[0].pause();
  }

  private updatePosition(event: MouseEvent): void {
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
        if (seconds < this._clip.startTime) {
          this._seekingTime = this._clip.startTime;
        } else if (seconds > this._clip.endTime) {
          this._seekingTime = this._clip.endTime;
        } else {
          this._seekingTime = seconds;
        }
        break;
      }
      default:
        break;
    }
  }

  goTo(event: MouseEvent): void {
    const cursorPosition =
      event.clientX -
      (this._sliderNode.getBoundingClientRect().left +
        document.documentElement.scrollLeft);

    const seconds = this.getSecondsFromPosition(cursorPosition);

    this._audio[0].currentTime = seconds;
  }

  setVolume(event: InputEvent): void {
    this._volume = parseFloat((event.target as HTMLInputElement).value);
    this._audio[0].volume = this._volume;
  }

  setCurrentTime(currentTime: number): void {
    const seekingTimePosition = this.getPositionFromSeconds(currentTime);
    const startTimePosition = this.getPositionFromSeconds(this._clip.startTime);
    const seekingTimeSegmentPosition = seekingTimePosition - startTimePosition;
    const seekingTimePercentage =
      (seekingTimeSegmentPosition / this._segmentContentNode.clientWidth) *
      this._segmentContentNode.clientWidth;
    this._progressNode.style.transform = `translateX(${seekingTimeSegmentPosition}px)`;
    this._seekingNode.style.transform = `scaleX(${seekingTimePercentage})`;
  }

  setAction(action: ACTIONS): void {
    switch (action) {
      case ACTIONS.StretchLeft:
      case ACTIONS.StretchRight:
        document.body.style.cursor = "grabbing";
        break;
      default:
        document.body.style.cursor = "default";
        break;
    }
    this._action = action;
  }

  private secondsToHHMMSS(seconds: number): string {
    return new Date(seconds * 1000).toISOString().substr(11, 8);
  }

  static styles = css`
    .slider-wrapper {
      position: relative;
      width: 100%;
      background-color: #0f172a;
    }

    .slider {
      position: absolute;
      z-index: 10;
      top: 0;
      left: 0;
      display: flex;
      align-items: center;
      height: 100%;
      width: 100%;
    }

    .slider__track-placeholder {
      width: 100%;
      height: 8px;
      background-color: #64748b;
    }

    .slider__segment--wrapper {
      position: absolute;
      height: 100%;
    }

    .slider__segment {
      position: relative;
      display: flex;
      height: 100%;
    }

    .slider__segment-content {
      background-color: rgba(255, 255, 255, 0.5);
      height: 100%;
      width: 1px;
      border: none;
    }

    .slider__seeking-placeholder {
      position: absolute;
      pointer-events: none;
      background-color: rgba(255, 255, 255, 0.5);
      height: 100%;
      width: 1px;
      transform-origin: left;
    }

    .slider__segment-progress-handle {
      position: absolute;
      width: 20px;
      height: 20px;
      top: -23px;
      left: -10px;
      background-color: #3b82f6;
      border-radius: 50%;
    }

    .slider__segment-progress-handle::after {
      position: absolute;
      content: "";
      width: 0px;
      height: 0px;
      bottom: -12px;
      left: 1px;
      border: 10px solid transparent;
      border-top-color: transparent;
      border-top-style: solid;
      border-top-width: 10px;
      border-top: 10px solid #3b82f6;
    }

    .slider__segment .slider__segment-handle {
      position: absolute;
      width: 1rem;
      height: 120%;
      background-color: #b91c1c;
      border: none;
      margin: auto 0;
      top: 0;
      bottom: 0;
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
      border-radius: 0.2rem 9999px 9999px 0.2rem;
    }

    .slider__segment .clipper__handle-right {
      right: -1rem;
      border-radius: 9999px 0.2rem 0.2rem 9999px;
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
      <div>${this._isLoading ? "loading..." : "not loading"}</div>
      <input
        type="range"
        id="volume"
        min="0"
        max="1"
        step="0.1"
        value="${this._volume}"
        @change="${this.setVolume}"
      />
      <div class="slider-wrapper" style="height:${this.height}">
        <div id="waveform"></div>
        <div class="slider" role="slider">
          <div class="slider__track-placeholder"></div>
          <div class="slider__segment--wrapper">
            <div
              class="slider__segment-progress-handle"
              @mousedown="${() => this.setAction(ACTIONS.Seek)}"
            ></div>
            <div class="slider__segment">
              <button
                class="slider__segment-handle clipper__handle-left"
                title="${this.secondsToHHMMSS(this._clip.startTime)}"
                @mousedown="${() => this.setAction(ACTIONS.StretchLeft)}"
              ></button>
              <div class="slider__seeking-placeholder"></div>
              <div
                class="slider__segment-content"
                @mousedown="${() => this.setAction(ACTIONS.Seek)}"
                @click="${(event: MouseEvent) => this.goTo(event)}"
              ></div>
              <button
                class="slider__segment-handle clipper__handle-right"
                title="${this.secondsToHHMMSS(this._clip.endTime)}"
                @mousedown="${() => this.setAction(ACTIONS.StretchRight)}"
              ></button>
            </div>
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
