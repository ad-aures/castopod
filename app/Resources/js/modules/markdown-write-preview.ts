import { css, html, LitElement, TemplateResult } from "lit";
import { customElement, property, queryAssignedNodes } from "lit/decorators.js";
import { MarkdownPreview } from "./markdown-preview";

@customElement("markdown-write-preview")
export class MarkdownWritePreview extends LitElement {
  @property()
  for!: string;

  @property()
  _textarea: HTMLTextAreaElement | null = null;

  @property()
  _markdownPreview!: MarkdownPreview;

  @queryAssignedNodes("write", true)
  _write!: NodeListOf<HTMLButtonElement>;

  @queryAssignedNodes("preview", true)
  _preview!: NodeListOf<HTMLButtonElement>;

  connectedCallback(): void {
    super.connectedCallback();

    this._textarea = document.getElementById(this.for) as HTMLTextAreaElement;
    this._markdownPreview = document.querySelector(
      `markdown-preview[for=${this.for}]`
    ) as MarkdownPreview;
  }

  firstUpdated(): void {
    this.write();
  }

  write(): void {
    this._markdownPreview.hide();
    this._write[0].classList.add("active");
    this._preview[0].classList.remove("active");
  }

  preview(): void {
    this._markdownPreview.show();
    this._preview[0].classList.add("active");
    this._write[0].classList.remove("active");
  }

  static styles = css`
    ::slotted(button) {
      opacity: 0.5;
    }

    ::slotted(button.active) {
      position: relative;
      opacity: 1;
    }

    ::slotted(button.active)::after {
      content: "";
      position: absolute;
      bottom: -2px;
      left: 0;
      right: 0;
      width: 80%;
      height: 4px;
      margin: 0 auto;
      background-color: hsl(var(--color-accent-base));
      border-radius: 9999px;
    }
  `;

  render(): TemplateResult<1> {
    return html`<slot name="write" class="active" @click="${this.write}"></slot>
      <slot name="preview" @click="${this.preview}"></slot>`;
  }
}
