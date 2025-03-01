import { css, html, LitElement, TemplateResult } from "lit";
import { customElement, property, state } from "lit/decorators.js";

@customElement("play-soundbite")
export class PlaySoundbite extends LitElement {
  @property({ attribute: "audio-src" })
  audioSrc!: string;

  @property({ type: Number, attribute: "start-time" })
  startTime!: number;

  @property({ type: Number })
  duration!: number;

  @property({ attribute: "play-label" })
  playLabel!: string;

  @property({ attribute: "playing-label" })
  playingLabel!: string;

  @state()
  _audio: HTMLAudioElement | null = null;

  @state()
  _isPlaying = false;

  @state()
  _isLoading = false;

  _audioEvents = [
    {
      name: "play",
      onEvent: () => {
        this._isPlaying = true;
      },
    },
    {
      name: "pause",
      onEvent: () => {
        this._isPlaying = false;
      },
    },
    {
      name: "timeupdate",
      onEvent: () => {
        if (this._audio) {
          if (this._audio.currentTime < this.startTime) {
            this._isLoading = true;
            this._audio.currentTime = this.startTime;
          } else if (this._audio.currentTime > this.startTime + this.duration) {
            this.stopSoundbite();
          } else {
            this._isLoading = false;
          }
        }
      },
    },
  ];

  playSoundbite() {
    if (this._audio === null) {
      this._audio = new Audio(this.audioSrc);
      for (const event of this._audioEvents) {
        this._audio.addEventListener(event.name, event.onEvent);
      }
    }

    this._audio.currentTime = this.startTime;
    this._audio.play();
  }

  stopSoundbite() {
    if (this._audio !== null) {
      this._audio.pause();
      this._audio.currentTime = this.startTime;
    }
  }

  disconnectedCallback(): void {
    if (this._audio) {
      for (const event of this._audioEvents) {
        this._audio.removeEventListener(event.name, event.onEvent);
      }
    }
  }

  static styles = css`
    button {
      background-color: hsl(var(--color-accent-base));
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      padding: 0.5rem;
      font-size: 0.875rem;
      border: 2px solid transparent;
      border-radius: 9999px;

      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    button:hover {
      background-color: hsl(var(--color-accent-hover));
    }

    button:focus {
      outline: none;
      box-shadow:
        0 0 0 2px hsl(var(--color-background-base)),
        0 0 0 4px hsl(var(--color-accent-base));
    }

    button.playing {
      background-color: hsl(var(--color-background-base));
      border: 2px solid hsl(var(--color-accent-base));
    }

    button.playing:hover {
      background-color: hsl(var(--color-background-elevated));
    }

    button.playing svg {
      color: hsl(var(--color-accent-base));
    }

    svg {
      color: hsl(var(--color-accent-contrast));
    }

    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }

    .animate-spin {
      animation: spin 3s linear infinite;
    }
  `;

  render(): TemplateResult<1> {
    return html`<button
      @click="${this._isPlaying ? this.stopSoundbite : this.playSoundbite}"
      title="${this._isPlaying ? this.playingLabel : this.playLabel}"
    >
      ${this._isLoading
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
              class="animate-spin"
              viewBox="0 0 24 24"
              fill="currentColor"
              width="1em"
              height="1em"
            >
              <g>
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M13 9.17A3 3 0 1 0 15 12V2.458c4.057 1.274 7 5.064 7 9.542 0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2c.337 0 .671.017 1 .05v7.12z"
                />
              </g>
            </svg>`
          : html`<svg
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
    </button>`;
  }
}
