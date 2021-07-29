import MarkdownToolbarElement from "@github/markdown-toolbar-element";
import { LitElement, TemplateResult } from "lit";
export declare class MarkdownPreview extends LitElement {
  for: string;
  _textarea: HTMLTextAreaElement;
  _markdownToolbar: MarkdownToolbarElement;
  _show: boolean;
  connectedCallback(): void;
  hide(): void;
  show(): void;
  markdownToHtml(): string;
  render(): TemplateResult<1>;
}
