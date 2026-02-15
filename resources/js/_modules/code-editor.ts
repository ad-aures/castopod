import { indentWithTab } from "@codemirror/commands";
import { html as htmlLang } from "@codemirror/lang-html";
import { xml } from "@codemirror/lang-xml";
import {
  defaultHighlightStyle,
  syntaxHighlighting,
} from "@codemirror/language";
import { Compartment, EditorState, Extension } from "@codemirror/state";
import { keymap, ViewUpdate } from "@codemirror/view";
import { basicSetup, EditorView } from "codemirror";
import { prettify as prettifyHTML, minify as minifyHTML } from "htmlfy";
import { css, html, LitElement, TemplateResult } from "lit";
import {
  customElement,
  property,
  queryAssignedNodes,
  state,
} from "lit/decorators.js";
import xmlFormat from "xml-formatter";

const language = new Compartment();

@customElement("code-editor")
export class XMLEditor extends LitElement {
  @queryAssignedNodes({ slot: "textarea" })
  _textarea!: NodeListOf<HTMLTextAreaElement>;

  @property()
  lang = "html";

  @state()
  editorState!: EditorState;

  @state()
  editorView!: EditorView;

  _textareaEvents = [
    {
      events: ["focus", "invalid"],
      onEvent: (_: Event, editor: EditorView) => {
        // focus editor when textarea is focused or invalid
        editor.focus();
      },
    },
  ];

  firstUpdated(): void {
    const minHeightEditor = EditorView.baseTheme({
      ".cm-content, .cm-gutter": {
        minHeight: this._textarea[0].clientHeight + "px",
      },
    });

    const extensions: Extension[] = [
      basicSetup,
      keymap.of([indentWithTab]),
      minHeightEditor,
      syntaxHighlighting(defaultHighlightStyle),
      EditorView.updateListener.of((viewUpdate: ViewUpdate) => {
        if (viewUpdate.docChanged) {
          // Document changed, minify and update textarea value
          switch (this.lang) {
            case "xml":
              this._textarea[0].value = minifyXML(
                viewUpdate.state.doc.toString()
              );
              break;
            case "html":
              this._textarea[0].value = minifyHTML(
                viewUpdate.state.doc.toString()
              );
              break;
            default:
              this._textarea[0].value = viewUpdate.state.doc.toString();
              break;
          }
        }
      }),
    ];

    let editorContents = "";
    switch (this.lang) {
      case "xml":
        editorContents = formatXML(this._textarea[0].value);
        extensions.push(language.of(xml()));
        break;
      case "html":
        editorContents = prettifyHTML(this._textarea[0].value);
        extensions.push(language.of(htmlLang()));
        break;
      default:
        break;
    }

    this.editorState = EditorState.create({
      doc: editorContents,
      extensions: extensions,
    });

    this.editorView = new EditorView({
      state: this.editorState,
      root: this.shadowRoot as ShadowRoot,
      parent: this.shadowRoot as ShadowRoot,
    });

    // hide textarea
    this._textarea[0].style.position = "absolute";
    this._textarea[0].style.opacity = "0";
    this._textarea[0].style.zIndex = "-9999";
    this._textarea[0].style.pointerEvents = "none";

    for (const event of this._textareaEvents) {
      event.events.forEach((name) => {
        this._textarea[0].addEventListener(name, (e) =>
          event.onEvent(e, this.editorView)
        );
      });
    }
  }

  disconnectedCallback(): void {
    super.disconnectedCallback();

    for (const event of this._textareaEvents) {
      event.events.forEach((name) => {
        this._textarea[0].removeEventListener(name, (e) =>
          event.onEvent(e, this.editorView)
        );
      });
    }
  }

  static styles = css`
    .cm-editor {
      border-radius: 0.5rem;
      overflow: hidden;
      border: 3px solid hsl(var(--color-border-contrast));
      background-color: hsl(var(--color-background-elevated));
      transition-property:
        color,
        background-color,
        border-color,
        text-decoration-color,
        fill,
        stroke,
        opacity,
        box-shadow,
        transform,
        filter,
        backdrop-filter,
        -webkit-backdrop-filter;
      transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
      transition-duration: 150ms;
    }
    .cm-editor.cm-focused {
      outline: 2px solid transparent;
      box-shadow:
        0 0 0 2px hsl(var(--color-background-elevated)),
        0 0 0 calc(4px) hsl(var(--color-accent-base));
    }
    .cm-gutters {
      background-color: hsl(var(--color-background-elevated)) !important;
    }

    .cm-activeLine {
      background-color: hsla(
        var(--color-background-highlight) / 0.25
      ) !important;
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

function formatXML(contents: string) {
  if (contents === "") {
    return contents;
  }

  try {
    return xmlFormat(contents, {
      indentation: "  ",
    });
  } catch {
    // xml doesn't have a root node
    const editorContents = xmlFormat("<root>" + contents + "</root>", {
      indentation: "  ",
    });
    // remove root, unnecessary lines and indents
    return editorContents
      .replace(/^<root>/, "")
      .replace(/<\/root>$/, "")
      .replace(/^\s*[\r\n]/gm, "")
      .replace(/[\r\n] {2}/gm, "\r\n")
      .trim();
  }
}

function minifyXML(contents: string) {
  if (contents === "") {
    return contents;
  }

  try {
    return xmlFormat.minify(contents, {
      collapseContent: true,
    });
  } catch {
    const minifiedContent = xmlFormat.minify(`<root>${contents}</root>`, {
      collapseContent: true,
    });
    // remove root
    return minifiedContent.replace(/^<root>/, "").replace(/<\/root>$/, "");
  }
}
