import { basicSetup } from "@codemirror/basic-setup";
import { xml } from "@codemirror/lang-xml";
import { EditorState } from "@codemirror/state";
import { EditorView } from "@codemirror/view";
import { css, html, LitElement, TemplateResult } from "lit";
import { customElement, queryAssignedNodes, state } from "lit/decorators.js";
import prettifyXML from "xml-formatter";

@customElement("xml-editor")
export class XMLEditor extends LitElement {
  @queryAssignedNodes("textarea", true)
  _textarea!: NodeListOf<HTMLTextAreaElement>;

  @state()
  editorState!: EditorState;

  @state()
  editorView!: EditorView;

  firstUpdated(): void {
    const minHeightEditor = EditorView.theme({
      ".cm-content, .cm-gutter": {
        minHeight: this._textarea[0].clientHeight + "px",
      },
    });

    this.editorState = EditorState.create({
      doc: this._textarea[0].value
        ? prettifyXML(this._textarea[0].value, {
            indentation: "  ",
          })
        : "",
      extensions: [basicSetup, xml(), minHeightEditor],
    });

    this.editorView = new EditorView({
      state: this.editorState,
      root: this.shadowRoot as ShadowRoot,
      parent: this.shadowRoot as ShadowRoot,
    });

    this._textarea[0].hidden = true;
    if (this._textarea[0].form) {
      this._textarea[0].form.addEventListener("submit", () => {
        this._textarea[0].value = this.editorView.state.doc.toString();
      });
    }
  }

  disconnectedCallback(): void {
    if (this._textarea[0].form) {
      this._textarea[0].form.removeEventListener("submit", () => {
        this._textarea[0].value = this.editorView.state.doc.toString();
      });
    }
  }

  static styles = css`
    .cm-editor {
      border-radius: 0.5rem;
      overflow: hidden;
      border: 3px solid hsl(var(--color-border-contrast));
      background-color: hsl(var(--color-background-elevated));
    }
    .cm-editor.cm-focused {
      outline: 2px solid transparent;
      box-shadow: 0 0 0 2px hsl(var(--color-background-elevated)),
        0 0 0 calc(4px) hsl(var(--color-accent-base));
    }
    .cm-gutters {
      background-color: hsl(var(--color-background-elevated)) !important;
    }

    .cm-activeLine {
      background-color: hsl(var(--color-background-highlight)) !important;
    }

    .cm-activeLineGutter {
      background-color: hsl(var(--color-background-highlight)) !important;
    }

    .ͼ4 .cm-line {
      caret-color: hsl(var(--color-text-base)) !important;
    }

    .ͼ1 .cm-cursor {
      border: none;
    }
  `;

  render(): TemplateResult<1> {
    return html`<slot name="textarea"></slot>`;
  }
}
