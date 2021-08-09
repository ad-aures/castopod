import { css, html, LitElement, TemplateResult } from "lit";
import { customElement, property, state } from "lit/decorators.js";

@customElement("play-episode-button")
export class PlayEpisodeButton extends LitElement {
  @property()
  id = "0";

  @property()
  src = "";

  @property()
  mediaType = "";

  @property()
  title!: string;

  @property()
  podcast!: string;

  @property()
  imageSrc!: string;

  @property()
  playLabel!: string;

  @property()
  playingLabel!: string;

  @property()
  isPlaying!: boolean;

  @property()
  _castopodAudioPlayer!: HTMLDivElement;

  @property()
  _audio!: HTMLAudioElement;

  @state()
  _playbackSpeed = 1;

  @state()
  _events = [
    {
      name: "canplay",
      onEvent: (event: Event): void => {
        (event.target as HTMLAudioElement)?.play();
      },
    },
    {
      name: "play",
      onEvent: (): void => {
        this.isPlaying = true;
      },
    },
    {
      name: "pause",
      onEvent: (): void => {
        this.isPlaying = false;
      },
    },
    {
      name: "ratechange",
      onEvent: (event: Event): void => {
        this._playbackSpeed = (event.target as HTMLAudioElement)?.playbackRate;
        console.log(this._playbackSpeed);
      },
    },
  ];

  async connectedCallback(): Promise<void> {
    super.connectedCallback();

    await this._elementReady("div[id=castopod-audio-player]");
    await this._elementReady("div[id=castopod-audio-player] audio");

    this._castopodAudioPlayer = document.body.querySelector(
      "div[id=castopod-audio-player]"
    ) as HTMLDivElement;

    this._audio = this._castopodAudioPlayer.querySelector(
      "audio"
    ) as HTMLAudioElement;
  }

  private _elementReady(selector: string) {
    return new Promise((resolve) => {
      const element = document.querySelector(selector);
      if (element) {
        resolve(element);
      }
      new MutationObserver((_, observer) => {
        // Query for elements matching the specified selector
        Array.from(document.querySelectorAll(selector)).forEach((element) => {
          resolve(element);
          //Once we have resolved we don't need the observer anymore.
          observer.disconnect();
        });
      }).observe(document.documentElement, {
        childList: true,
        subtree: true,
      });
    });
  }

  play(): void {
    const currentlyPlayingEpisode = this._castopodAudioPlayer.dataset.episode;

    const isCurrentEpisode = currentlyPlayingEpisode === this.id;

    if (currentlyPlayingEpisode === "-1") {
      this._showPlayer();
    }

    if (isCurrentEpisode) {
      this._audio.play();
    } else {
      const playingEpisodeButton = document.querySelector(
        `play-episode-button[id="${currentlyPlayingEpisode}"]`
      ) as PlayEpisodeButton;
      if (playingEpisodeButton) {
        this._flushLastPlayButton(playingEpisodeButton);
      }

      this._loadEpisode();
    }
  }

  pause(): void {
    this._audio.pause();
  }

  private _showPlayer(): void {
    this._castopodAudioPlayer.style.display = "";
    document.body.style.paddingBottom = "52px";
  }

  private _flushLastPlayButton(playingEpisodeButton: PlayEpisodeButton): void {
    playingEpisodeButton.isPlaying = false;

    for (const event of playingEpisodeButton._events) {
      playingEpisodeButton._audio.removeEventListener(
        event.name,
        event.onEvent,
        false
      );
    }

    this._playbackSpeed = playingEpisodeButton._playbackSpeed;
  }

  private _loadEpisode(): void {
    this._castopodAudioPlayer.dataset.episode = this.id;

    this._audio.src = this.src;
    this._audio.load();
    this._audio.playbackRate = this._playbackSpeed;
    for (const event of this._events) {
      this._audio.addEventListener(event.name, event.onEvent, false);
    }

    const img: HTMLImageElement | null =
      this._castopodAudioPlayer.querySelector("img");

    if (img) {
      img.src = this.imageSrc;
      img.alt = this.title;
    }

    const episodeTitle: HTMLParagraphElement | null =
      this._castopodAudioPlayer.querySelector('p[id="castopod-player-title"]');

    if (episodeTitle) {
      episodeTitle.title = this.title;
      episodeTitle.innerHTML = this.title;
    }

    const podcastTitle: HTMLParagraphElement | null =
      this._castopodAudioPlayer.querySelector(
        'p[id="castopod-player-podcast"]'
      );

    if (podcastTitle) {
      podcastTitle.title = this.podcast;
      podcastTitle.innerHTML = this.podcast;
    }
  }

  static styles = css`
    button {
      background-color: #ffffff;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      padding: 0.25rem 0.5rem;
      font-size: 0.875rem;
      line-height: 1.25rem;
      font-weight: 600;
      border-width: 2px;
      border-style: solid;
      border-radius: 9999px;
      border-color: rgba(207, 247, 243, 1);

      box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    button:hover {
      border-color: #009486;
      background-color: #ebf8f8;
    }

    button:focus {
      background-color: #ebf8f8;
    }

    svg {
      font-size: 1.5rem;
      margin-right: 0.25rem;
      color: #009486;
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
    return html`<button @click="${this.isPlaying ? this.pause : this.play}">
      ${this.isPlaying
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
              </g></svg
            >${this.playingLabel}`
        : html`<svg
              viewBox="0 0 24 24"
              fill="currentColor"
              width="1em"
              height="1em"
            >
              <path fill="none" d="M0 0h24v24H0z" />
              <path
                d="M7.752 5.439l10.508 6.13a.5.5 0 0 1 0 .863l-10.508 6.13A.5.5 0 0 1 7 18.128V5.871a.5.5 0 0 1 .752-.432z"
              /></svg
            >${this.playLabel}`}
    </button>`;
  }
}
