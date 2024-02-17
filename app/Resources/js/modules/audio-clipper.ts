import { css, html, LitElement, TemplateResult } from "lit";
import {
  customElement,
  property,
  query,
  queryAll,
  queryAssignedElements,
  state,
} from "lit/decorators.js";
import WaveSurfer, { WaveSurferOptions } from "wavesurfer.js";

enum ActionType {
  StretchLeft,
  StretchRight,
  Seek,
}

interface Action {
  type: ActionType;
  payload?: {
    offset: number;
  };
}

interface EventElement {
  events: string[];
  onEvent: EventListener;
}

@customElement("audio-clipper")
export class AudioClipper extends LitElement {
  @queryAssignedElements({ slot: "audio", flatten: true })
  _audio!: Array<HTMLAudioElement>;

  @queryAssignedElements({ slot: "start_time", flatten: true })
  _startTimeInput!: Array<HTMLInputElement>;

  @queryAssignedElements({ slot: "duration", flatten: true })
  _durationInput!: Array<HTMLInputElement>;

  @query(".slider")
  _sliderNode!: HTMLDivElement;

  @query(".slider__segment--wrapper")
  _segmentNode!: HTMLDivElement;

  @query(".slider__segment-content")
  _segmentContentNode!: HTMLDivElement;

  @query(".slider__segment-progress-handle--main")
  _progressNode!: HTMLDivElement;

  @query(".slider__segment-progress-handle--ghost")
  _progressGhostNode!: HTMLDivElement;

  @query(".slider__seeking-placeholder")
  _seekingNode!: HTMLDivElement;

  @query("#waveform")
  _waveformNode!: HTMLDivElement;

  @query(".buffering-bar")
  _bufferingBarNode!: HTMLCanvasElement;

  @queryAll(".slider__segment-handle")
  _segmentHandleNodes!: NodeListOf<HTMLButtonElement>;

  @property({ type: Number, attribute: "audio-duration" })
  audioDuration = 0;

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

  @property({ attribute: "trim-start-label" })
  trimStartLabel = "Trim start";

  @property({ attribute: "trim-end-label" })
  trimEndLabel = "Trim end";

  @state()
  _canInteract = false;

  @state()
  _isPlaying = false;

  @state()
  _clip = {
    startTime: 0,
    endTime: 0,
  };

  @state()
  _action: Action | null = null;

  @state()
  _sliderWidth = 0;

  @state()
  _currentTime = 0;

  @state()
  _volume = 0.5;

  @state()
  _seekingTime: number | null = null;

  @state()
  _wavesurfer!: WaveSurfer;

  @state()
  _isBuffering = false;

  _windowEvents: EventElement[] = [
    {
      events: ["load"],
      onEvent: () => {
        this._canInteract = true;
        this._sliderWidth = this._sliderNode.clientWidth;
        this.setSegmentPosition();
      },
    },
    {
      events: ["resize"],
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
          if (
            this._action.type === ActionType.Seek &&
            this._seekingTime !== null
          ) {
            this._audio[0].currentTime = this._seekingTime;
            this._seekingTime = null;
          }
          this._action = null;
        }
      },
    },
    {
      events: ["mousemove"],
      onEvent: (event: Event) => {
        this.updatePosition(event as MouseEvent);
      },
    },
  ];

  _audioEvents: EventElement[] = [
    {
      events: ["loadedmetadata"],
      onEvent: () => {
        this.audioDuration = this._audio[0].duration;
      },
    },
    {
      events: ["waiting"],
      onEvent: () => {
        this._isBuffering = true;
      },
    },
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
      events: ["progress"],
      onEvent: () => {
        const context = this._bufferingBarNode.getContext("2d");

        if (context) {
          context.fillStyle = "lightgray";
          context.fillRect(
            0,
            0,
            this._bufferingBarNode.width,
            this._bufferingBarNode.height
          );
          context.fillStyle = "#04AC64";

          const inc = this._bufferingBarNode.width / this.audioDuration;

          for (let i = 0; i < this._audio[0].buffered.length; i++) {
            const startX = this._audio[0].buffered.start(i) * inc;
            const endX = this._audio[0].buffered.end(i) * inc;
            const width = endX - startX;

            context.fillRect(startX, 0, width, this._bufferingBarNode.height);
            context.rect(startX, 0, width, this._bufferingBarNode.height);
          }
        }
      },
    },
    {
      events: ["timeupdate"],
      onEvent: () => {
        this._currentTime = this._audio[0].currentTime;
        if (this._currentTime > this._clip.endTime) {
          this.pause();
          this._audio[0].currentTime = this._clip.endTime;
        } else if (this._currentTime < this._clip.startTime) {
          this._audio[0].currentTime = this._clip.startTime;
        } else {
          this._isBuffering = false;
          this.setCurrentTime(this._currentTime);
        }
      },
    },
  ];

  _segmentHandleEvents: EventElement[] = [
    {
      events: ["mouseenter", "focus"],
      onEvent: (event: Event) => {
        const timeInfoElement = (
          event.target as HTMLButtonElement
        ).querySelector("span");
        if (timeInfoElement) {
          timeInfoElement.style.opacity = "1";
        }
      },
    },
    {
      events: ["mouseleave", "blur"],
      onEvent: (event: Event) => {
        const timeInfoElement = (
          event.target as HTMLButtonElement
        ).querySelector("span");
        if (timeInfoElement) {
          timeInfoElement.style.opacity = "0";
        }
      },
    },
  ];

  _sliderSegmentEvents: EventElement[] = [
    {
      events: ["hover"],
      onEvent: (event: Event) => {
        const ghostHandle = (event.target as HTMLDivElement).querySelector(
          ".segment"
        ) as HTMLDivElement;
        if (ghostHandle) {
          ghostHandle.style.opacity = "1";
          ghostHandle.style.transform = "translateX(50)";
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
    this._sliderWidth = this._sliderNode.clientWidth;
    this.setSegmentPosition();

    this._audio[0].volume = this._volume;
    this._startTimeInput[0].hidden = true;
    this._durationInput[0].hidden = true;

    this._wavesurfer = WaveSurfer.create({
      container: this._waveformNode,
      height: this.height,
      interact: false,
      barWidth: 2,
      barHeight: 1,
      responsive: true,
      waveColor: "hsl(0 5% 85%)",
      cursorColor: "transparent",
    } as WaveSurferOptions);
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

    for (const event of this._segmentHandleEvents) {
      event.events.forEach((name) => {
        for (let i = 0; i < this._segmentHandleNodes.length; i++) {
          this._segmentHandleNodes[i].addEventListener(name, event.onEvent);
        }
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

    for (const event of this._segmentHandleEvents) {
      event.events.forEach((name) => {
        for (let i = 0; i < this._segmentHandleNodes.length; i++) {
          this._segmentHandleNodes[i].addEventListener(name, event.onEvent);
        }
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
    return (seconds * this._sliderWidth) / this.audioDuration;
  }

  private getSecondsFromPosition(position: number) {
    return (this.audioDuration * position) / this._sliderWidth;
  }

  protected updated(
    _changedProperties: Map<string | number | symbol, unknown>
  ): void {
    if (_changedProperties.has("_clip")) {
      this.pause();
      this.setSegmentPosition();

      this._startTimeInput[0].value = this._clip.startTime.toString();
      this._durationInput[0].value = (
        this._clip.endTime - this._clip.startTime
      ).toFixed(3);
      this._durationInput[0].dispatchEvent(new Event("change"));
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
    if (this._action === null) {
      return;
    }

    const cursorPosition =
      event.clientX +
      (this._action.payload?.offset || 0) -
      (this._sliderNode.getBoundingClientRect().left +
        document.documentElement.scrollLeft);

    const seconds = this.getSecondsFromPosition(cursorPosition);

    switch (this._action.type) {
      case ActionType.StretchLeft: {
        let startTime = 0;
        if (seconds > 0) {
          if (seconds > this._clip.endTime - this.minDuration) {
            startTime = this._clip.endTime - this.minDuration;
          } else {
            startTime = seconds;
          }
        }
        this._clip = {
          startTime: parseFloat(startTime.toFixed(3)),
          endTime: this._clip.endTime,
        };
        break;
      }
      case ActionType.StretchRight: {
        let endTime;
        if (seconds < this.audioDuration) {
          if (seconds < this._clip.startTime + this.minDuration) {
            endTime = this._clip.startTime + this.minDuration;
          } else {
            endTime = seconds;
          }
        } else {
          endTime = this.audioDuration;
        }

        this._clip = {
          startTime: this._clip.startTime,
          endTime: parseFloat(endTime.toFixed(3)),
        };
        break;
      }
      case ActionType.Seek: {
        if (seconds < this._clip.startTime) {
          this._seekingTime = this._clip.startTime;
        } else if (seconds > this._clip.endTime) {
          this._seekingTime = this._clip.endTime;
        } else {
          this._seekingTime = parseFloat(seconds.toFixed(3));
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

  setAction(event: MouseEvent, action: Action): void {
    switch (action.type) {
      case ActionType.StretchLeft:
        action.payload = {
          offset:
            this._segmentHandleNodes[0].getBoundingClientRect().right -
            event.clientX,
        };
        break;
      case ActionType.StretchRight:
        action.payload = {
          offset:
            this._segmentHandleNodes[1].getBoundingClientRect().left -
            event.clientX,
        };
        break;
      default:
        break;
    }
    this._action = action;
  }

  private secondsToHHMMSS(seconds: number): string {
    return new Date(seconds * 1000).toISOString().substr(11, 8);
  }

  trim(side: "start" | "end") {
    if (side === "start") {
      this._clip = {
        startTime: parseFloat(this._audio[0].currentTime.toFixed(3)),
        endTime: this._clip.endTime,
      };
    } else {
      this._clip = {
        startTime: this._clip.startTime,
        endTime: this._currentTime,
      };
    }
  }

  static styles = css`
    .slider-wrapper {
      position: relative;
      width: 100%;
      background-color: #0f172a;
    }

    .buffering-bar {
      position: absolute;
      width: 100%;
      height: 4px;
      background-color: gray;
      bottom: -4px;
      left: 0;
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

    .slider__segment--wrapper {
      position: absolute;
      height: 100%;
    }

    .slider__segment {
      position: relative;
      display: flex;
      height: 120%;
      top: -10%;
    }

    .slider__segment-content {
      box-sizing: border-box;
      background-color: rgba(255, 255, 255, 0.5);
      height: 100%;
      width: 1px;
      border-top: 2px dashed #b91c1c;
      border-bottom: 2px dashed #b91c1c;
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
      top: -50%;
      left: -10px;
      margin-top: -2px;
      background-color: #3b82f6;
      border-radius: 50%;
      box-shadow: 0 0 0 2px #ffffff;
    }

    .slider__segment-progress-handle::after {
      position: absolute;
      content: "";
      width: 0px;
      height: 0px;
      bottom: -12px;
      left: 0;
      border: 10px solid transparent;
      border-top-color: transparent;
      border-top-style: solid;
      border-top-width: 10px;
      border-top: 10px solid #3b82f6;
    }

    .slider__segment-progress-handle--ghost {
      opacity: 0.5;
    }

    .slider__segment .slider__segment-handle {
      position: absolute;
      width: 1rem;
      height: 100%;
      background-color: #b91c1c;
      border: none;
      margin: auto 0;
      top: 0;
      bottom: 0;
    }

    .slider__segment .slider__segment-handle::before {
      content: "";
      position: absolute;
      height: 50%;
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

    .slider__segment .slider__segment-handle span {
      opacity: 0;
      pointer-events: none;
      position: absolute;
      left: -100%;
      top: -30%;
      background-color: #0f172a;
      color: #ffffff;
      padding: 0 0.25rem;
    }

    .slider__segment .clipper__handle-right {
      right: -1rem;
      border-radius: 0 0.2rem 0.2rem 0;
    }

    .toolbar {
      display: flex;
      align-items: center;
      padding: 0.5rem 0.5rem 0.25rem 0.5rem;
      justify-content: space-between;
      background-color: hsl(var(--color-background-elevated));
      box-shadow:
        0 1px 3px 0 rgb(0 0 0 / 0.1),
        0 1px 2px -1px rgb(0 0 0 / 0.1);
      border-radius: 0 0 0.75rem 0.75rem;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .toolbar__audio-controls {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .toolbar .toolbar__play-button {
      padding: 0.5rem;
      height: 32px;
      width: 32px;
      font-size: 1em;
    }

    .toolbar__trim-controls {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      flex-shrink: 0;
    }

    .toolbar button {
      cursor: pointer;
      background-color: hsl(var(--color-accent-base));
      color: hsl(var(--color-accent-contrast));
      border-radius: 9999px;
      border: none;
      padding: 0.25rem 0.5rem;
      box-shadow:
        0 1px 3px 0 rgb(0 0 0 / 0.1),
        0 1px 2px -1px rgb(0 0 0 / 0.1);
    }

    .toolbar button:hover {
      background-color: hsl(var(--color-accent-hover));
    }

    .toolbar button:focus {
      outline: 2px solid transparent;
      outline-offset: 2px;
      --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0
        var(--tw-ring-offset-width) var(--tw-ring-offset-color);
      --tw-ring-shadow: var(--tw-ring-inset) 0 0 0
        calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color);
      box-shadow:
        var(--tw-ring-offset-shadow),
        var(--tw-ring-shadow),
        0 0 rgba(0, 0, 0, 0);
      box-shadow:
        var(--tw-ring-offset-shadow),
        var(--tw-ring-shadow),
        0 0 rgba(0, 0, 0, 0);
      box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow),
        var(--tw-shadow, 0 0 rgba(0, 0, 0, 0));
      --tw-ring-offset-width: 2px;
      --tw-ring-opacity: 1;
      --tw-ring-color: hsl(var(--color-accent-base) / var(--tw-ring-opacity));
      --tw-ring-offset-color: hsl(var(--color-background-base));
    }

    .toolbar__trim-controls button {
      font-weight: 600;
      font-family:
        Inter,
        ui-sans-serif,
        system-ui,
        -apple-system,
        Segoe UI,
        Roboto,
        Ubuntu,
        Cantarell,
        Noto Sans,
        sans-serif,
        BlinkMacSystemFont,
        "Segoe UI",
        Roboto,
        "Helvetica Neue",
        Arial,
        "Noto Sans",
        sans-serif,
        "Apple Color Emoji",
        "Segoe UI Emoji",
        "Segoe UI Symbol",
        "Noto Color Emoji";
    }

    .animate-spin {
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(360deg);
      }
    }

    .volume {
      display: flex;
      font-size: 1.2rem;
      color: hsl(var(--color-accent-base));
      align-items: center;
      gap: 0.25rem;
    }

    .range-slider {
      accent-color: hsl(var(--color-accent-base));
      width: 100px;
    }

    time {
      font-size: 0.875rem;
      font-family: "Mono";
    }
  `;

  render(): TemplateResult<1> {
    return html`
      <slot name="audio"></slot>
      <slot name="start_time"></slot>
      <slot name="duration"></slot>
      <div class="slider-wrapper" style="height:${this.height}px">
        <div id="waveform"></div>
        <div class="slider" role="slider">
          <div class="slider__segment--wrapper">
            <div
              class="slider__segment-progress-handle slider__segment-progress-handle--main"
              @mousedown="${(event: MouseEvent) => {
                this.setAction(event, { type: ActionType.Seek });
              }}"
            ></div>
            <div
              class="slider__segment-progress-handle slider__segment-progress-handle--ghost"
              ?hidden=${true}
            ></div>
            <div class="slider__segment">
              <button
                class="slider__segment-handle clipper__handle-left"
                @mousedown="${(event: MouseEvent) =>
                  this.setAction(event, {
                    type: ActionType.StretchLeft,
                  })}"
              >
                <span>${this.secondsToHHMMSS(this._clip.startTime)}</span>
              </button>
              <div class="slider__seeking-placeholder"></div>
              <div
                class="slider__segment-content"
                @mousemove="${(event: MouseEvent) => {
                  const seekingTimeSegmentPosition =
                    event.clientX -
                    (event.target as HTMLDivElement).getBoundingClientRect()
                      .left;

                  this._progressGhostNode.hidden = false;
                  this._progressGhostNode.style.transform = `translateX(${seekingTimeSegmentPosition}px)`;
                }}"
                @mouseleave="${() => (this._progressGhostNode.hidden = true)}"
                @mousedown="${(event: MouseEvent) =>
                  this.setAction(event, { type: ActionType.Seek })}"
                @click="${(event: MouseEvent) => this.goTo(event)}"
              ></div>
              <button
                class="slider__segment-handle clipper__handle-right"
                @mousedown="${(event: MouseEvent) =>
                  this.setAction(event, { type: ActionType.StretchRight })}"
              >
                <span>${this.secondsToHHMMSS(this._clip.endTime)}</span>
              </button>
            </div>
          </div>
        </div>
        <canvas class="buffering-bar"></canvas>
      </div>
      <div class="toolbar">
        <div class="toolbar__audio-controls">
          <button
            class="toolbar__play-button"
            @click="${this._isPlaying ? this.pause : this.play}"
          >
            ${this._isBuffering || !this._canInteract
              ? html`<svg
                  class="animate-spin"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <circle
                    opacity="0.25"
                    cx="12"
                    cy="12"
                    r="10"
                    stroke="currentColor"
                    stroke-width="4"
                  ></circle>
                  <path
                    opacity="0.75"
                    fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                  ></path>
                </svg>`
              : this._isPlaying
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
          <div class="volume">
            <svg
              viewBox="0 0 24 24"
              fill="currentColor"
              width="1em"
              height="1em"
            >
              <g>
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M8.889 16H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h3.889l5.294-4.332a.5.5 0 0 1 .817.387v15.89a.5.5 0 0 1-.817.387L8.89 16zm9.974.591l-1.422-1.422A3.993 3.993 0 0 0 19 12c0-1.43-.75-2.685-1.88-3.392l1.439-1.439A5.991 5.991 0 0 1 21 12c0 1.842-.83 3.49-2.137 4.591z"
                />
              </g>
            </svg>
            <input
              class="range-slider"
              type="range"
              id="volume"
              min="0"
              max="1"
              step="0.1"
              value="${this._volume}"
              @change="${this.setVolume}"
            />
          </div>
          <time>${this.secondsToHHMMSS(this._currentTime)}</time>
        </div>
        <div class="toolbar__trim-controls">
          <button @click="${() => this.trim("start")}">
            ${this.trimStartLabel}
          </button>
          <button @click="${() => this.trim("end")}">
            ${this.trimEndLabel}
          </button>
        </div>
      </div>
    `;
  }
}
