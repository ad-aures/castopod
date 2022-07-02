import { indentWithTab } from "@codemirror/commands";
import { xml } from "@codemirror/lang-xml";
import {
  defaultHighlightStyle,
  syntaxHighlighting,
} from "@codemirror/language";
import { Compartment, EditorState } from "@codemirror/state";
import { keymap } from "@codemirror/view";
import { basicSetup, EditorView } from "codemirror";
import { css, html, LitElement, TemplateResult } from "lit";
import { customElement, queryAssignedNodes, state } from "lit/decorators.js";
import prettifyXML from "xml-formatter";

const language = new Compartment();

@customElement("xml-editor")
export class XMLEditor extends LitElement {
  @queryAssignedNodes({ slot: "textarea" })
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

    let editorContents = "";
    if (this._textarea[0].value) {
      try {
        editorContents = prettifyXML(this._textarea[0].value, {
          indentation: "  ",
        });
      } catch (e) {
        // xml doesn't have a root node
        editorContents = prettifyXML(
          "<root>" + this._textarea[0].value + "</root>",
          {
            indentation: "  ",
          }
        );
        // remove root, unnecessary lines and indents
        editorContents = editorContents
          .replace(/^<root>/, "")
          .replace(/<\/root>$/, "")
          .replace(/^\s*[\r\n]/gm, "")
          .replace(/[\r\n] {2}/gm, "\r\n")
          .trim();
      }
    }

    this.editorState = EditorState.create({
      doc: editorContents,
      extensions: [
        basicSetup,
        keymap.of([indentWithTab]),
        language.of(xml()),
        minHeightEditor,
        syntaxHighlighting(defaultHighlightStyle),
      ],
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
