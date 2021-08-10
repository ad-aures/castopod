import "@github/clipboard-copy-element";
import { css, html, LitElement, TemplateResult } from "lit";
import {
  customElement,
  property,
  query,
  queryAssignedNodes,
  state,
} from "lit/decorators.js";

@customElement("permalink-edit")
export class PermalinkEdit extends LitElement {
  @queryAssignedNodes("domain", true)
  _domain!: NodeListOf<HTMLSpanElement>;

  @queryAssignedNodes("slug-input", true)
  _slugInput!: NodeListOf<HTMLInputElement>;

  @query("clipboard-copy")
  _clipboardCopy!: any;

  @property({ attribute: "edit-label" })
  editLabel = "Edit";

  @property({ attribute: "copy-label" })
  copyLabel = "Copy";

  @state()
  isEditable = false;

  @state()
  permalink = "";

  @state()
  slugInputEvents = [
    {
      name: "change",
      onEvent: (): void => {
        this.setPermalink();
      },
    },
    {
      name: "focus",
      onEvent: (): void => {
        this.editSlug();
      },
    },
    {
      name: "focusin",
      onEvent: (event: Event): void => {
        setTimeout(() => {
          (event.target as HTMLInputElement).selectionStart = (
            event.target as HTMLInputElement
          ).selectionEnd = 10000;
        }, 0);
      },
    },
    {
      name: "focusout",
      onEvent: (): void => {
        this.stopEdit();
      },
    },
  ];

  connectedCallback(): void {
    super.connectedCallback();
  }

  firstUpdated(): void {
    // set permalink value
    this.setPermalink();

    this._clipboardCopy.addEventListener("clipboard-copy", (event: Event) => {
      const notice = (event.target as HTMLDivElement).querySelector(
        ".notice"
      ) as HTMLSpanElement;
      if (notice) {
        notice.hidden = false;
        setTimeout(() => {
          notice.hidden = true;
        }, 1000);
      }
    });

    this._slugInput[0].readOnly = !this.isEditable;
    this.slugInputEvents.forEach((slugInputEvent) => {
      this._slugInput[0].addEventListener(
        slugInputEvent.name,
        slugInputEvent.onEvent
      );
    });
  }

  disconnectedCallback(): void {
    super.disconnectedCallback();

    this.slugInputEvents.forEach((slugInputEvent) => {
      this._slugInput[0].removeEventListener(
        slugInputEvent.name,
        slugInputEvent.onEvent
      );
    });

    this._clipboardCopy.removeEventListener(
      "clipboard-copy",
      (event: Event) => {
        const notice = (event.target as HTMLDivElement).querySelector(
          ".notice"
        ) as HTMLSpanElement;
        if (notice) {
          notice.hidden = false;
          setTimeout(() => {
            notice.hidden = true;
          }, 1000);
        }
      }
    );
  }

  editSlug(): void {
    this.isEditable = true;
    this._slugInput[0].readOnly = !this.isEditable;
    this._slugInput[0].focus();
  }

  stopEdit(): void {
    this.isEditable = false;
    this._slugInput[0].readOnly = !this.isEditable;
  }

  setPermalink(): void {
    this.permalink = this._domain[0].innerHTML + this._slugInput[0].value;
  }

  static styles = css`
    ::slotted(input[slot="slug-input"][readonly]) {
      background-color: transparent !important;
      border-color: transparent !important;
      padding-left: 0 !important;
      margin-left: -0.25rem !important;
      font-weight: 600;
    }

    ::slotted([slot="domain"]) {
      margin-right: 0.25rem;
    }

    button,
    clipboard-copy {
      background: transparent;
      border: none;
      padding: 0.25rem;
      cursor: pointer;
    }

    button svg,
    clipboard-copy svg {
      opacity: 0.6;
      font-size: 1.25rem;
    }

    button:hover svg,
    clipboard-copy:hover svg {
      opacity: 1;
    }

    clipboard-copy {
      position: relative;
    }

    .notice {
      position: absolute;
      background-color: black;
      color: #ffffff;
      bottom: -1rem;
      right: 0;
      font-size: 0.75rem;
      padding: 0 0.25rem;
    }
  `;

  render(): TemplateResult<1> {
    return html`<slot name="domain"></slot><slot name="slug-input"></slot>${this
        .isEditable
        ? ""
        : html`<button @click="${this.editSlug}" title="${this.editLabel}">
            <svg
              viewBox="0 0 24 24"
              fill="currentColor"
              width="1em"
              height="1em"
            >
              <g>
                <path fill="none" d="M0 0h24v24H0z" />
                <path
                  d="M7.243 18H3v-4.243L14.435 2.322a1 1 0 0 1 1.414 0l2.829 2.829a1 1 0 0 1 0 1.414L7.243 18zM3 20h18v2H3v-2z"
                />
              </g>
            </svg>
          </button> `}<clipboard-copy
        .value="${this.permalink}"
        title="${this.copyLabel}"
        ><svg viewBox="0 0 24 24" fill="currentColor" width="1em" height="1em">
          <g>
            <path fill="none" d="M0 0h24v24H0z" />
            <path
              d="M6 4v4h12V4h2.007c.548 0 .993.445.993.993v16.014a.994.994 0 0 1-.993.993H3.993A.994.994 0 0 1 3 21.007V4.993C3 4.445 3.445 4 3.993 4H6zm2-2h8v4H8V2z"
            />
          </g>
        </svg>
        <span class="notice" hidden>Copied!</span></clipboard-copy
      >`;
  }
}
