import { LitElement, TemplateResult } from "lit";
import { MarkdownPreview } from "./markdown-preview";
export declare class MarkdownWritePreview extends LitElement {
  for: string;
  _textarea: HTMLTextAreaElement | null;
  _markdownPreview: MarkdownPreview;
  _write: NodeListOf<HTMLButtonElement>;
  _preview: NodeListOf<HTMLButtonElement>;
  connectedCallback(): void;
  write(): void;
  preview(): void;
  render(): TemplateResult<1>;
}
