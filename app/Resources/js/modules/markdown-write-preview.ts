import { html, LitElement, TemplateResult } from "lit";
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

  write(): void {
    this._markdownPreview.hide();
    this._write[0].classList.add("font-semibold");
    this._preview[0].classList.remove("font-semibold");
  }

  preview(): void {
    this._markdownPreview.show();
    this._preview[0].classList.add("font-semibold");
    this._write[0].classList.remove("font-semibold");
  }

  render(): TemplateResult<1> {
    return html`<slot name="write" @click="${this.write}"></slot>
      <slot name="preview" @click="${this.preview}"></slot>`;
  }
}
